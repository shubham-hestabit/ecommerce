<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\StripeClient;
use Stripe\Stripe;
use Stripe\Error\Card;
use Stripe\Customer;
use Stripe\Charge;

class PaymentController extends Controller
{
    public function index(){
        $cartItemsPrice = \Cart::session(Auth::user()->id)->getContent();
        return view('layouts.ecommerce.payment', compact('cartItemsPrice'));
    }

    public function payment(Request $request) {
        // dd($request->all());
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        
        $customer = Customer::create(array(
          'name' => $request->name,
          'description' => 'Customer Info',
          'email' => $request->email,
          'source' => $request->stripeToken,
           "address" => [
            "state" => $request->state,
            "city" => $request->city,
            "country" => "US", 
            "line1" => $request->address, 
            "postal_code" => $request->zipcode, 
            ]
        ));

        try {
            Charge::create ( array (
                "amount" => $request->total * 100,
                "currency" => "usd",
                "customer" =>  $customer["id"],
                "description" => "Payment Recieved."
            ) );
            session()->flash('success', 'Payment done Successfully !');
            return back();

        } catch (\Exception $e ) {
            session()->flash('fail', 'sjcsjds');
            return back();
        }
    }
}