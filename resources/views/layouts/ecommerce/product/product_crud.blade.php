@extends('layouts.app')

@section('content')

<table class="table table-sm-2 text-center">
    <thead>
        <tr>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Product Image</th>
            <th>Product Details</th>
            <th>Product Price</th>
            <th>Product Editing</th>
        </tr>
    </thead>
    <tbody class="text-center">
        @foreach ($product_all as $products)
        <tr>
            <td>{{ $products->p_id }}</td>
            <td>{{ $products->p_name }}</td>
            <td>
            <img src="{{ '/storage/product-images/' . $products->p_image }}" alt="Products-image"
                    height="70">
            </td>
            <td>{{ $products->p_details }}</td>
            <td>{{ $products->p_price }}</td>
            <td>
                <a href="{{ url('/category') }}">
                    <i class="fa fa-edit fa-2x text-dark"></i>
                </a>

                <a href="{{ url('/category') }}">
                    <i class="fa fa-trash fa-2x text-danger ml-4"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection