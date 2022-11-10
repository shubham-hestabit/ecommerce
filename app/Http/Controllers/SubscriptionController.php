<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\StripeClient;

class SubscriptionController extends Controller
{
    public function index()
    {
        $amount = 50;
        session()->put('amount', $amount);
        $date = date('d-m-y h:i a', strtotime('30 days'));
        return view('layouts.ecommerce.subscription.subscription', compact('amount', 'date'));
    }

    public function subPayment()
    {
        $amount = session()->get('amount');
        return view('layouts.ecommerce.subscription.subscription_payment', compact('amount'));
    }

    public function addSubscription()
    {
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $user = User::findOrFail(Auth::user()->id);
        $stripeClient = new StripeClient(env('STRIPE_SECRET_KEY'));

        $product = $stripeClient->products->create(['name' => 'Premium']);

        $price = $stripeClient->plans->create([
            'amount' => 30,
            'currency' => 'usd',
            'interval' => 'month',
            'product' => $product->id,
        ]);

        $customer = Customer::create([
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
        ]);

        $subscribe = $stripeClient->subscriptions->create([
            'customer' => $customer->id,
            'items' => ['price' => $price->id],
        ]);

        if (!$subscribe->status == 'active') {
            session()->flash('error', 'Subscription failed!!');
        }
        $user->update([
            'is_subscribed' => true,
            'subscription_id' => $subscribe->id,
        ]);

        session()->flash('success', 'Subscription Done Successfully!!');

        return redirect('subscription');
    }

    public function cancelSubscription()
    {
        $user = User::findOrFail(Auth::user()->id);

        $stripeClient = new StripeClient(env('STRIPE_SECRET_KEY'));

        $stripeClient->subscriptions->cancel($user->subscription_id, []);

        $user->update([
            'is_subscribed' => false,
            'subscription_id' => null,
        ]);

        return back();
    }
}
