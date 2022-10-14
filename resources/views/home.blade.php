@extends('layouts.app')

@section('content')
{{--<div class="container-fluid">
    <h1 class="text-black-50">You are logged in!</h1>
</div>--}}

<div class="small-box bg-info">
    <div class="inner">
        <h3>{{ $cat_count }}</h3>
        <p>Total Categories</p>
    </div>
    <div class="icon">
        <i class="fas fa-store"></i>
    </div>
    @foreach ($cat_all as $category)

    <!-- <ul class="inner">
        <li>
            <p>Category ID: {{ $category->c_id }}</p>
        </li>
        <li>
            <p>Category Name: {{ $category->c_name }}</p>
        </li>
    <ul> -->
            <!-- <hr> -->

            @endforeach

            <a href="#" class="small-box-footer"> More info <i class="fas fa-arrow-circle-right"></i>
            </a>
</div>


<div class="small-box bg-success">
    <div class="inner">
        <h3>{{ $sub_cat_count }}</h3>
        <p>Total Sub Categories</p>
    </div>
    <div class="icon">
        <i class="fa fa-list-alt"></i>
    </div>
    @foreach ($sub_cat_all as $subcategory)

    <!-- <p>Category ID: {{ $subcategory->sc_id }}</p>
    <p>Category Name: {{ $subcategory->sc_name }}</p>
    <hr> -->

    @endforeach

    <a href="#" class="small-box-footer"> More info <i class="fas fa-arrow-circle-right"></i>
    </a>
</div>


<div class="small-box bg-danger">
    <div class="inner">
        <h3>{{ $product_count }}</h3>
        <p>Total Products</p>
    </div>
    <div class="icon">
        <i class="fas fa-shopping-cart"></i>
    </div>
    @foreach ($product_all as $product)
    <!-- 
    <p>Product ID: {{ $product->p_id }}</p>
    <p>Product Name: {{ $product->p_name }}</p>
    <p>Product Details: {{ $product->p_details }}</p>
    <p>Product Price: {{ $product->p_price }}</p>
    <hr> -->

    @endforeach

    <a href="#" class="small-box-footer"> More info <i class="fas fa-arrow-circle-right"></i>
    </a>
</div>


@endsection