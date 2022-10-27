@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-center">
    <h1 class="font-weight-bolder py-2">Shopping Cart</h1>
</div>

<div class="d-flex justify-content-left" style="margin-top: -70px">
    <div class="btn btn-dark mt-2 ml-5">
        <a href="{{ route('home') }}">
            <i class="fa fa-arrow-left fa-2x text-light">&nbsp;Back</i>
        </a>
    </div>
</div>
<hr>

<div class="container px-3 my-5 clearfix">
    <table class="table table-hover table-bordered table-sm-2 text-center mt-3">
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

                @foreach ($sub_category as $sub_cat)
                <td>{{ $sub_cat->sc_name }}</td>
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

</div>

<div class="d-flex col-lg-2">
    <button class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
        <i class="fas fa-minus"></i>
    </button>

    <input id="form1" min="0" name="quantity" value="2" type="number" class="form-control form-control-sm" />

    <button class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
        <i class="fas fa-plus"></i>
    </button>
</div>

@endsection