<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Item;
use PDF;

class OrderController extends Controller
{
    public function orders()
    {
        try {
            $orders = Order::with('items')->where('user_id', Auth::user()->id)->get();
            return view('layouts.ecommerce.invoice.orders', compact('orders'));
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return view('layouts.ecommerce.invoice.orders');
        }
    }

    public function orderInvoice($id)
    {
        $item = Item::with('orders')->findOrFail($id);
        $charge = session()->get('charge');

        $data = [
            'itemId' => $item->orders->order_id,
            'orderedItems' => $item,
            'date' => $item->created_at->format('d-M-Y'),
            'time' => $item->created_at->format('h:i:s a'),
            'billing_address' => $charge['shipping'], //$charge['billing_details'],
            'shipping_address' => $charge['shipping'],
            'total_amount' => $item->quantity * $item->price,
        ];

        $pdf = PDF::loadView('layouts.ecommerce.invoice.item_invoice', $data);
        $pdfName = $item->name . '.pdf';
        return $pdf->stream($pdfName);
    }
}
