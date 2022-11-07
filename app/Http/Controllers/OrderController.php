<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Item;

class OrderController extends Controller
{
    public function orders()
    {
        $order = Order::latest()->first();
        $items = Item::where('order_id', $order->order_id)->get();
        return view('orders', compact('items'));
    }

}
