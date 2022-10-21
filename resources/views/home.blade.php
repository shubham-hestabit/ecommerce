@extends('layouts.app')

@section('content')

<div class="container-fluid py-2">
    <div class="small-box bg-info col-sm-4">
        <div class="inner">
            <h3>{{ $cat_count }}</h3>
            <p>Total Categories</p>
        </div>
        <div class="icon">
            <i class="fas fa-store"></i>
        </div>
        <a href="#" class="small-box-footer"> More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>


    <div class="small-box bg-success col-sm-4">
        <div class="inner">
            <h3>{{ $sub_cat_count }}</h3>
            <p>Total Sub Categories</p>
        </div>
        <div class="icon">
            <i class="fa fa-list-alt"></i>
        </div>
        <a href="#" class="small-box-footer"> More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>


    <div class="small-box bg-danger col-sm-4">
        <div class="inner">
            <h3>{{ $product_count }}</h3>
            <p>Total Products</p>
        </div>
        <div class="icon">
            <i class="fas fa-shopping-cart"></i>
        </div>
        <a href="#" class="small-box-footer"> More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>

@endsection