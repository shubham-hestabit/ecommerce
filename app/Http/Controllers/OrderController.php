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
        // try{
            $user_id = Auth::user()->id;
            $order = Order::where('user_id', $user_id)->find($user_id);
            $items = Item::get();
            return view('orders', compact('items', 'order'));
        // }
        // catch(\Exception $e){
        //     session()->flash('error', $e->getMessage());
        //     return view('orders');
        // }
    }

}
