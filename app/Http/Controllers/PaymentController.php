<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
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

        return view('layouts.ecommerce.payment', compact('cartItems'));
    }

    public function payment(Request $request)
    {

        $cartItems = \Cart::session(Auth::user()->id)->getContent();

        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $customer = Customer::create(array(
            'name' => $request->name,
            'description' => 'Customer Info',
            'email' => $request->email,
            'source' => $request->stripeToken,
            'address' => [
                'city' => $request->city,
                'country' => $request->country,
                'line1' => $request->address,
                'postal_code' => $request->zipcode,
            ]
        ));

        try {
            $charge = Charge::create(array(
                'amount' => $request->total * 100,
                'currency' => 'usd',
                'customer' =>  $customer['id'],
                'description' => 'Payment Recieved.',
                'shipping' => [
                    'name' => $request->name,
                    'address' => [
                        'city' => $request->city,
                        'country' => $request->country,
                        'line1' => $request->address,
                        'postal_code' => $request->zipcode,
                    ],
                ]
            ));

            $stripeClient = new StripeClient(env('STRIPE_SECRET_KEY'));
            $stripeClient->charges->retrieve($charge->id);

            $order = new Order();
            $order->product_details = json_encode($cartItems);
            $order->charge_id = $charge->id;
            $order->user_id = Auth::user()->id;
            $order->save();

            session()->flash('success', 'Payment Done Successfully !');
            $order_id = $order->order_id;
            return view('thankyou', compact('order_id'));

        } catch (\Exception $e) {
            dd($e->getMessage());
            session()->flash('error', $e->getMessage());
            return back();
        }
    }

    public function paymentInvoice($id)
    {
        $order = Order::findOrFail($id);
        $stripeClient = new StripeClient(env('STRIPE_SECRET_KEY'));
        $charge = $stripeClient->charges->retrieve($order['charge_id'])->toArray();
        $billing = $charge['shipping'];

        $subTotal = 0;
        foreach (json_decode($order['product_details']) as $items){
            $subTotal += $items->quantity * $items->price;
        }

        $data = [
            'orderNum' => $order->order_id,
            'cartItems' => json_decode($order->product_details),
            'date' => date('d-M-Y'),
            'time' => date('h:i:s a'),
            'billing_address' => $billing,
            'shipping_address' => $charge['shipping'],
            'payment_details' => $charge['payment_method_details'],
            'sub_total' => $subTotal,
            'shipping_charge' =>  ((($charge['amount'] / 100) < 500) ? $shipping_charge=50 : $shipping_charge=0),
            'total_amount' => (($charge['amount'] / 100)),
        ];

        $pdf = PDF::loadView('invoices', $data);
        $pdfName = Auth::user()->name . '.pdf';
        return $pdf->stream($pdfName);
    }
}
