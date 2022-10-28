@extends('layouts.app')

@section('content')

<div class="container px-3 py-5 clearfix">
    <!-- Shopping cart table -->
    <div class="card">
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
                            <th>Total</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartItems as $item)
                        <tr>
                            <td width="160">
                                <img src="{{ $item->p_image }}" class="d-block ml-3" alt="" height=100 />
                            </td>
                            <td width="300">
                                <div class="media align-middle p-4">
                                    <div class="media-body">
                                        <a href="#" class="d-block text-dark">{{ $item->p_name }}</a>
                                        <small>
                                            <span class="text-muted">Ships from: </span> india
                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center align-middle p-4">{{ $item->p_price }}</td>
                            <td class="text-center align-middle p-4" width="125">
                                <input type="number" class="form-control text-center" value="1">
                            </td>
                            <td class="text-center align-middle p-4">{{ $item->p_price }}</td>
                            <td class="text-center align-middle">
                                <form method="post" action="">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
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
                    <label class="text-muted font-weight-normal">Promocode</label>
                    <input type="text" placeholder="ABC" class="form-control">
                </div>
                <div class="d-flex">
                    <div class="text-right mt-4 mr-5">
                        <label class="text-muted font-weight-normal m-0">Discount</label>
                        <div class="text-large"><strong>$20</strong></div>
                    </div>
                    <div class="text-right mt-4">
                        <label class="text-muted font-weight-normal m-0">Total price</label>
                        <div class="text-large"><strong>$1164.65</strong></div>
                    </div>
                </div>
            </div>

            <a href="{{ url('/product') }}"
                class="fa fa-cart-plus btn btn-lg btn-warning float-left mt-2">&nbsp;&nbsp;Back to
                Shopping</a>
            <a href="{{ url('/product') }}"
                class="fa fa-card btn btn-lg btn-primary float-right mt-2">&nbsp;&nbsp;Checkout</a>

        </div>
    </div>
</div>


<main class="my-8">
    <div class="container px-6 mx-auto">
        <div class="flex justify-center my-6">
            <div class="flex flex-col w-full p-8 text-gray-800 bg-white shadow-lg pin-r pin-y md:w-4/5 lg:w-4/5">
                @if ($message = Session::get('success'))
                <div class="p-4 mb-3 bg-green-400 rounded">
                    <p class="text-green-800">{{ $message }}</p>
                </div>
                @endif
                <h3 class="text-3xl text-bold">Cart List</h3>
                <div class="flex-1">
                    <table class="w-full text-sm lg:text-base" cellspacing="0">
                        <thead>
                            <tr class="h-12 uppercase">
                                <th class="hidden md:table-cell"></th>
                                <th class="text-left">Name</th>
                                <th class="pl-5 text-left lg:text-right lg:pl-0">
                                    <span class="lg:hidden" title="Quantity">Qtd</span>
                                    <span class="hidden lg:inline">Quantity</span>
                                </th>
                                <th class="hidden text-right md:table-cell"> price</th>
                                <th class="hidden text-right md:table-cell"> Remove </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartItems as $item)
                            <tr>
                                <td class="hidden pb-4 md:table-cell">
                                    <a href="#">
                                        <img src="{{ '/storage/product-images/' . $item->p_image }}"
                                            alt="Products-image" height="250" class="border border-dark">

                                    </a>
                                </td>
                                <td>
                                    <a href="#">
                                        <p class="mb-2 md:ml-4">{{ $item->p_name }}</p>

                                    </a>
                                </td>
                                <td class="justify-center mt-6 md:justify-end md:flex">
                                    <div class="h-10 w-28">
                                        <div class="relative flex flex-row w-full h-8">

                                            <form action="{{ route('cart.update') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="p_id" value="{{ $item->p_id}}">
                                                <input type="number" name="quantity" value="{{ $item->quantity }}"
                                                    class="w-6 text-center bg-gray-300" />
                                                <button type="submit"
                                                    class="px-2 pb-2 ml-2 text-white bg-blue-500">update</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                                <td class="hidden text-right md:table-cell">
                                    <span class="text-sm font-medium lg:text-base">
                                        ${{ $item->p_price }}
                                    </span>
                                </td>
                                <td class="hidden text-right md:table-cell">
                                    <form action="{{ route('cart.remove') }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{ $item->p_id }}" name="p_id">
                                        <button class="px-4 py-2 text-white bg-red-600">x</button>
                                    </form>

                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div>
                        Total: ${{ Cart::getTotal() }}
                    </div>
                    <div>
                        <form action="{{ route('cart.clear') }}" method="POST">
                            @csrf
                            <button class="px-6 py-2 text-red-800 bg-red-300">Remove All Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection