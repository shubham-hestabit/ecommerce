<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use PDF;

class PaymentController extends Controller
{
    public function index(){

        $cartItems = \Cart::session(Auth::user()->id)->getContent();

        return view('layouts.ecommerce.payment', compact('cartItems'));
    }

    public function payment(Request $request) {

        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        
        $customer = Customer::create(array(
            'name' => $request->name,
            'description' => 'Customer Info',
            'email' => $request->email,
            'source' => $request->stripeToken,
            'address' => [
                'state' => $request->state,
                'city' => $request->city,
                'country' => 'US', 
                'line1' => $request->address, 
                'postal_code' => $request->zipcode, 
                ]
            ));
            
            try {
                Charge::create (array (
                    'amount' => $request->total * 100,
                    'currency' => 'usd',
                    'customer' =>  $customer['id'],
                    'description' => 'Payment Recieved.',
                    'shipping' => [
                        'name' => $request->name,
                        'address' => [
                            'state' => $request->state,
                            'city' => $request->city,
                            'country' => 'US', 
                            'line1' => $request->address, 
                            'postal_code' => $request->zipcode, 
                        ],
                    ]
                ));
                session()->flash('success', 'Payment Done Successfully !');
                // return back();
                return $this->paymentInvoice($request);

            } catch(\Exception $e){
                session()->flash('error', $e->getMessage());
                return back();
            }
        }

    public function paymentInvoice($request)
    {
        $cartItems = \Cart::session(Auth::user()->id)->getContent();

        $data = [
            'cart' => $cartItems,
            'date' => date('d-M-Y'),
            'billing_address' => [
                'name' => $request->name,
                'line1' => $request->address, 
                'city' => $request->city,
                'state' => $request->state,
                'country' => 'US', 
                'postal_code' => $request->zipcode, 
            ],
            'shipping_address' => [
                'name' => $request->name,
                'line1' => $request->address, 
                'city' => $request->city,
                'state' => $request->state,
                'country' => 'US', 
                'postal_code' => $request->zipcode, 
            ],
            'payment_details' => [
                'card_num' => $request->cardNumber,
                'email' => $request->email,
            ],
            'sub_total' => $request->subTotal,
            'shipping' => $request->shipping,
            'total_amount' => $request->total,
        ];
          
        $pdf = PDF::loadView('invoices', $data);
        $pdfName = $request->name . 'pdf';
        return $pdf->stream($pdfName);
    }
}