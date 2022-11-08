<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Order;
use Stripe\StripeClient;

class SubscriptionController extends Controller
{
    public function index()
    {
        return view('subscription');
    }

    public function addSubscription()
    {
        $user_id = Auth::user()->id;
        $stripeClient = new StripeClient(env('STRIPE_SECRET_KEY'));

        $orders = Order::where('user_id', $user_id)->get();
        foreach ($orders as $order) {
            $charge = $stripeClient->charges->retrieve($order['charge_id']);
        }

        $items = Item::where('order_id', $order['order_id'])->get();
        foreach ($items as $item) {
            $product = $stripeClient->products->create(['name' => $item->name]);
            $price = $stripeClient->prices->create([
                'unit_amount' => $item->price * 100,
                'currency' => 'usd',
                'recurring' => ['interval' => 'month'],
                'product' => $product->id,
            ]);
        }

        $stripeClient->subscriptions->create([
            'customer' => $charge->customer,
            'items' => [
                ['price' => $price->id]
            ],
        ]);

        session()->flash('success', 'Subscription Done Successfully!!');
        
        return view('subscription');
    }

    public function cancelSubscription()
    {
        $stripeClient = new StripeClient(env('STRIPE_SECRET_KEY'));

        $stripeClient->subscriptions->cancel('sub_1M1rXE2eZvKYlo2C0raBIAbM', []);
    }
}
