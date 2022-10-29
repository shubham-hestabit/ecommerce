@extends('layouts.app')

@section('content')

<div class="container px-3 py-5 clearfix">
    <div class="card">
        @if ($message = Session::get('success'))
        <div class="p-4 rounded">
            <p class="alert alert-info">{{ $message }}</p>
        </div>
        @endif
        <div class="card-header text-center">
            <h1 class="font-weight-bold">Shopping Cart</h1>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered m-0">
                    <thead>
                        <tr class="text-center">
                            <th>Product Image</th>
                            <th>Product Name &amp; Details</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Sub Total</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartItems as $item)
                        <tr>
                            <td width="160">
                                <img src="{{ '/storage/product-images/' . $item->attributes->image }}"
                                    class="d-block border border-secondary" alt="" height=100 />
                            </td>
                            <td width="300">
                                <div class="media align-middle p-4">
                                    <div class="media-body">
                                        <a href="#" class="d-block text-dark">{{ $item->name }}</a>
                                        <small>
                                            <span class="text-muted">{{ $item->details }}</span> india
                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center align-middle p-4"><i class="fa fa-rupee"></i> {{ $item->price }}</td>
                            <td class="text-center align-middle p-4" width="110">
                                <div class="d-flex">
                                    <form action="{{ route('cart.update') }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{ $item->id }}" name="id">
                                        <input type="number" class="form-control text-center"
                                            value="{{ $item->quantity }}" name="quantity" min="1" max="999">
                                        <button class="px-2 ml-1 mt-2 text-white bg-blue" type="submit">Update</button>
                                    </form>
                                </div>
                            </td>
                            <td class="text-center align-middle p-4"><i class="fa fa-rupee"></i>
                                {{ Cart::getSubTotal() }}
                            </td>
                            <td class="text-center align-middle">
                                <form action="{{ url('/remove') }}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{ $item->id }}" name="id">
                                    <button type="submit" style="border:none; background:transparent;">
                                        <i class="fa fa-trash fa-2x text-danger ml-1"></i>
                                    </button>
                                </form></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- / Shopping cart table -->

            <div class="d-flex flex-wrap justify-content-between align-items-center pb-4">
                <div class="mt-4">
                    <label class="text-muted font-weight-bold">Promocode</label>
                    <input type="text" placeholder="X387HW" class="form-control w-75">
                </div>
                <div class="d-flex">
                    <div class="text-right mt-4 mr-5">
                        @php
                        $discount = (Cart::getTotal() * 5)/100;
                        @endphp
                        <label class="text-muted font-weight-bold m-0">Discount</label>
                        <h5 class="text-large"><b><i class="fa fa-rupee"></i> {{$discount}}</b></h5>
                    </div>
                    <div class="text-right mt-4">
                        <label class="text-muted font-weight-bold m-0">Total Price</label>
                        <h4 class="text-large"><b><i class="fa fa-rupee"></i> {{ Cart::getTotal() }}</b></h4>
                    </div>
                </div>
            </div>

            <a href="{{ url('/product') }}"
                class="fa fa-cart-plus btn btn-lg btn-warning float-left mt-2">&nbsp;&nbsp;Back to
                Shopping</a>
            <a href="{{ url('/payment') }}"
                class="fa fa-credit-card btn btn-lg btn-success float-right mt-2">&nbsp;&nbsp;Checkout</a>
        </div>
    </div>
</div>

@endsection