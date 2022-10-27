@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-center">
    <h1 class="font-weight-bolder py-2">Products</h1>
</div>

<div class="d-flex justify-content-left" style="margin-top: -70px">
    <div class="btn btn-dark mt-2 ml-5">
        <a href="{{ route('home') }}">
            <i class="fa fa-arrow-left fa-2x text-light">&nbsp;Back</i>
        </a>
    </div>
</div>
<hr>

@foreach ($products as $product)
<div class="container py-2 w-25 float-left">
    <div class="card card-body bg-secondary">
        <img src="{{ '/storage/product-images/' . $product->p_image }}" alt="Products-image" height="250">
        <h5 class="card-text text-center my-2">{{ $product->p_name }}</h5>
        <p class="card-text text-center">{{ $product->p_details }}</p>
        <p class="card-text text-center">Price:&nbsp;&nbsp;<i class="fa fa-rupee">{{ $product->p_price }}</i></p>
        <a href="{{ url('/cart') }}" class="btn btn-primary">Add to Cart</a>
    </div>
</div>
@endforeach

@endsection