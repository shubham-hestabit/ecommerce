@extends('layouts.app')

@section('content')

<h1 class="d-flex justify-content-center py-4 font-weight-bolder">Update a Product</h1>
<div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="card bg-info text-white" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center text-dark">
                <form method="post" action="{{ url('/product-update/'. $id) }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">

                    <div class="form-outline form-white mb-4">
                        <label class="text-lg">Enter Product Name</label>
                        <input type="text" name="p_name" class="form-control form-control-lg text-dark">
                    </div>

                    <div class="form-outline form-white mb-4">
                        <label class="text-lg">Give Product Image</label>
                        <input type="file" name="p_image" class="form-control form-control-lg text-dark">
                    </div>

                    <div class="form-outline form-white mb-4">
                        <label class="text-lg">Enter Product Details</label>
                        <input type="text" name="p_details" class="form-control form-control-lg text-dark">
                    </div>

                    <div class="form-outline form-white mb-4">
                        <label class="text-lg">Enter Product Price</label>
                        <input type="text" name="p_price" class="form-control form-control-lg text-dark">
                    </div>

                    <button class="btn btn-outline-dark btn-lg px-5 mt-3" type="submit">Add</button>

                    <a class="btn btn-outline-dark btn-lg px-3 mt-3 ml-5"
                        href="{{ url('/sub-category-list/{cat_id}') }}">
                        <i class="fa fa-chevron-circle-left">&ensp;Go Back</i></a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection