@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-around">
    <div class="btn btn-dark mt-2 ml-5">
        <a href="{{ url('/sub-category-list/{cat_id}') }}">
            <i class="fa fa-arrow-left fa-2x text-light">&nbsp;Back</i>
        </a>
    </div>

    <h1 class="font-weight-bolder">Products</h1>

    <div class="btn btn-success mt-2 ml-5">
        <a href="{{ url('/product/create/'. $product_id) }}"><i class="fa fa-plus fa-2x text-light">&nbsp;Add</i></a>
    </div>
</div>

<table class="table table-sm-2 text-center mt-3">
    <thead>
        <tr>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Product Image</th>
            <th>Product Details</th>
            <th>Product Price</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody class="text-center">
        @foreach ($product_all as $products)
        <tr>
            <td>{{ $products->p_id }}</td>
            <td>{{ $products->p_name }}</td>
            <td>
                <img src="{{ '/storage/product-images/' . $products->p_image }}" alt="Products-image" height="70">
            </td>
            <td>{{ $products->p_details }}</td>
            <td>{{ $products->p_price }}</td>
            <td>
                <a href="{{ url('/product-edit/'. $products->p_id) }}">
                    <i class="fa fa-edit fa-2x text-dark ml-1"></i>
                </a>
            </td>
            <td>
                <form method="post" action="{{ url('/product-delete/'. $products->p_id) }}">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" style="border:none; background:transparent;">
                        <i class="fa fa-trash fa-2x text-danger ml-1"></i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection