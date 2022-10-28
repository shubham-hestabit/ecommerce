<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cartList()
    {
        $cartItems = \Cart::getContent();
        // dd($cartItems);
        return view('layouts.add_to_cart', compact('cartItems'));
    }

    public function addToCart(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'p_name' => 'required|regex:/^[0-9a-zA-ZÑñ\s]+$/',
            'p_details' => 'required|regex:/^[0-9a-zA-ZÑñ\s]+$/',
            'p_price' => 'required|numeric',
            'p_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        \Cart::add([
            'p_id' => $request->p_id,
            'p_name' => $request->p_name,
            'p_details' => $request->p_details,
            'p_price' => $request->p_price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'p_image' => $request->p_image,
            )
        ]);
        session()->flash('success', 'Product is Added to Cart Successfully !');

        return redirect()->route('cart.list');
    }

    public function updateCart(Request $request)
    {
        \Cart::update(
            $request->id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->quantity
                ],
            ]
        );

        session()->flash('success', 'Item Cart is Updated Successfully !');

        return redirect()->route('cart.list');
    }

    public function removeCart(Request $request)
    {
        \Cart::remove($request->id);
        session()->flash('success', 'Item Cart Remove Successfully !');

        return redirect()->route('cart.list');
    }

    public function clearAllCart()
    {
        \Cart::clear();

        session()->flash('success', 'All Item Cart Clear Successfully !');

        return redirect()->route('cart.list');
    }
}
