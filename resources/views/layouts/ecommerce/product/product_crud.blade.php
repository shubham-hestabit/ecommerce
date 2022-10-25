@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-center">
    <h1 class="font-weight-bolder py-2">Products</h1>
</div>

<div class="d-flex justify-content-left" style="margin-top: -70px">
    <div class="btn btn-dark mt-2 ml-5">
        <a href="{{ url()->previous() }}">
            <i class="fa fa-arrow-left fa-2x text-light">&nbsp;Back</i>
        </a>
    </div>

    @if ( url()->current() == 'http://127.0.0.1:8000/product')
    @php
    $link = "/product";
    @endphp
    @elseif ( url()->current() == 'http://127.0.0.1:8000/product/'.$id)
    @php
    $link = '/product/create/'.$id
    @endphp
    <div class="btn btn-success mt-2 ml-5">
        <a href="{{ $link }}"><i class="fa fa-plus fa-2x text-light">&nbsp;Add</i></a>
    </div>
    @endif

</div>

<table class="table table-bordered table-sm-2 text-center mt-3">
    <thead class="thead-dark">
        <tr>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Product Image</th>
            <th>Product Details</th>
            <th>Product Price</th>
            <th>Sub Category Name</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
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
            <td>{{ $product->sc_id }}</td>

            @foreach ($sub_category as $sub_cat)
            <td>{{ $sub_cat->sc_id }}</td>
            @endforeach

            <td>
                <a href="{{ url('/product/'. $product->p_id .'/edit/') }}">
                    <i class="fa fa-edit fa-2x text-dark ml-1"></i>
                </a>
            </td>
            <td>
                <form method="post" action="{{ url('/product/'. $product->p_id) }}">
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