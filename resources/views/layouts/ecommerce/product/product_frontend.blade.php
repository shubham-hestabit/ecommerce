@extends('layouts.app')
@section('content')

<div class="d-flex justify-content-around">
    <div class="btn btn-dark mt-2 ml-5">
        <a href="{{ route('home') }}"><i class="fa fa-arrow-left fa-2x text-light"> Back</i></a>
    </div>

    <h1 class="font-weight-bolder">Products</h1>

    <div class="btn btn-info mt-2 ml-5">
        <a href="{{ url('/cart') }}"><i class="fa fa-shopping-cart fa-2x text-light"> View Cart&nbsp;</i><span
                class="badge badge-pill badge-danger">{{ Cart::getTotalQuantity() }}</span></a>
    </div>
</div>
<hr>


@foreach ($products as $product)
<div class="container py-2 w-25 float-left">
    <div class="card card-body border border-secondary">
        <img src="{{ '/storage/product-images/' . $product->p_image }}" alt="Products-image" height="250"
            class="border border-dark">
        <h5 class="card-text text-bold text-center my-2">{{ $product->p_name }}</h5>
        <h5 class="card-text text-center">{{ $product->p_details }}</h5>
        <h5 class="card-text text-center">Price: <i class="fa fa-rupee"> <b>{{ $product->p_price }}</b></i>
        </h5>
        <div class="text-center">
            <form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{ $product->p_id }}" name="p_id">
                <input type="hidden" value="{{ $product->p_name }}" name="p_name">
                <input type="hidden" value="{{ $product->p_details }}" name="p_details">
                <input type="hidden" value="{{ $product->p_price }}" name="p_price">
                <input type="hidden" value="{{ $product->p_image }}" name="p_image">
                <input type="hidden" value="1" name="quantity">
                <button class="btn btn-primary w-50">Add To Cart</button>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection