<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class CartController extends Controller
{
    public function cartList()
    {
        $cartItems = \Cart::session(Auth::user()->id)->getContent();
        
        return view('layouts.ecommerce.add_to_cart', compact('cartItems'));
    }

    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->p_id);
        $id = md5($product->p_id);
        \Cart::session(Auth::user()->id)->add([
            'id' => $id,
            'name' => $request->p_name,
            'price' => $request->p_price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'image' => $request->p_image,
                'details' => $request->p_details,
            ),
            'AssociatedModel' => $product,
        ]);
        session()->flash('success', 'Product Added to Cart Successfully !');

        return redirect('/product');

    }

    public function updateCart(Request $request)
    {
        \Cart::session(Auth::user()->id)->update(
            $request->id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->quantity
                ],
            ]
        );

        session()->flash('success', 'Cart Item Updated Successfully !');

        return redirect()->route('cart-list');
    }

    public function removeCart(Request $request)
    {
        \Cart::session(Auth::user()->id)->remove($request->id);

        session()->flash('success', 'Cart Item Removed Successfully !');

        return redirect()->route('cart-list');
    }

    public function clearAllCart()
    {
        \Cart::session(Auth::user()->id)->clear();

        session()->flash('success', 'All Cart Items Clear Successfully !');

        return redirect()->route('cart-list');
    }
}