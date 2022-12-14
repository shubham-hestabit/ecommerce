<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\Item;
use Stripe\Stripe;
use Stripe\StripeClient;
use Stripe\Customer;
use Stripe\Charge;
use PDF;

class PaymentController extends Controller
{
    public function index()
    {
        $cartItems = \Cart::session(Auth::user()->id)->getContent();

        return view('layouts.ecommerce.payment.payment', compact('cartItems'));
    }

    public function paymentDone(Request $request)
    {
        $cartItems = \Cart::session(Auth::user()->id)->getContent();

        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $customer = Customer::create([
            'name' => $request->name,
            'description' => 'Customer Info',
            'email' => $request->email,
            'source' => $request->stripeToken,
            'address' => [
                'city' => $request->city,
                'country' => $request->country,
                'line1' => $request->address,
                'postal_code' => $request->zipcode,
            ],
        ]);

        try {
            $charge = Charge::create([
                'amount' => $request->total * 100,
                'currency' => 'usd',
                'customer' => $customer['id'],
                'description' => 'Payment Recieved.',
                'shipping' => [
                    'name' => $request->name,
                    'address' => [
                        'city' => $request->city,
                        'country' => $request->country,
                        'line1' => $request->address,
                        'postal_code' => $request->zipcode,
                    ],
                ],
            ]);

            $stripeClient = new StripeClient(env('STRIPE_SECRET_KEY'));
            $stripeClient->charges->retrieve($charge->id);

            $order = new Order();
            $order->charge_id = $charge->id;
            $order->user_id = Auth::user()->id;
            $order->save();

            foreach ($cartItems as $item) {
                Item::create([
                    'order_id' => $order->order_id,
                    'name' => $item->name,
                    'image' => $item->attributes->image ?? 'NOT AVAILABLE',
                    'details' => $item->attributes->details,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                ]);
            }

            session()->flash('success', 'Payment Done Successfully!!');

            Mail::send(
                'layouts.ecommerce.payment.order_mail',
                [
                    'cartItems' => $cartItems, 'order_id' => $order->order_id,
                    'shipping' => $charge['shipping'], 'total_amount' => (($charge['amount']) / 100),

                ],
                function ($message) use ($request) {
                    $message->to($request->email);
                    $message->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'));
                    $message->subject('Order Confirmation');
                }
            );

            if ($charge->status == 'succeeded') {
                // \Cart::session(Auth::user()->id)->clear();
            } elseif ($charge->status == 'failed') {
                session()->flash('error', 'Payment failed!!');
            }
            $order_id = $order->order_id;
            return view('layouts.ecommerce.payment.thankyou', compact('order_id'));
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return back();
        }
    }

    public function paymentRefund($id)
    {
        try {
            $item = Item::with('orders')->findOrFail($id);
            $item->update([
                'is_returned' => true,
            ]);
            $charge_id = $item->orders->charge_id;

            $stripeClient = new StripeClient(env('STRIPE_SECRET_KEY'));
            $stripeClient->refunds->create(['charge' => $charge_id]);
            return redirect('orders');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return back();
        }
    }

    public function paymentInvoice($id)
    {
        $order = Order::findOrFail($id);
        $stripeClient = new StripeClient(env('STRIPE_SECRET_KEY'));
        $charge = $stripeClient->charges->retrieve($order['charge_id'])->toArray();

        session()->put('charge', $charge);
        $items = Item::where('order_id', $order->order_id)->get();

        $subTotal = 0;
        foreach ($items as $item) {
            $subTotal += $item->quantity * $item->price;
        }

        $data = [
            'orderNum' => $order->order_id,
            'cartItems' => $items,
            'date' => $order->created_at->format('d-M-Y'),
            'time' => $order->created_at->format('h:i:s a'),
            'billing_address' => $charge['shipping'], //$charge['billing_details'],
            'shipping_address' => $charge['shipping'],
            'payment_details' => $charge['payment_method_details'],
            'sub_total' => $subTotal,
            'shipping_charge' => $charge['amount'] / 100 < 500 ? ($shipping_charge = 50) : ($shipping_charge = 0),
            'total_amount' => $charge['amount'] / 100,
        ];

        $pdf = PDF::loadView('layouts.ecommerce.invoice.billing_invoice', $data);
        $pdfName = Auth::user()->name . '.pdf';
        return $pdf->stream($pdfName);
    }
}
