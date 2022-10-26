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

<table class="table table-hover table-bordered table-sm-2 text-center mt-3">
    <thead class="thead-dark">
        <tr>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Product Image</th>
            <th>Product Details</th>
            <th>Product Price</th>
    </thead>
    <tbody class="text-center">
        @foreach ($products as $product)
        <tr>
            <th>{{ $product->p_id }}</th>
            <td>{{ $product->p_name }}</td>
            <td>
                <img src="{{ '/storage/product-images/' . $product->p_image }}" alt="Products-image" height="70">
            </td>
            <td>{{ $product->p_details }}</td>
            <td>{{ $product->p_price }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection