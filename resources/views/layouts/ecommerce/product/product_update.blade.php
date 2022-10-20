@extends('layouts.app')

@section('content')

<h1 class="d-flex justify-content-center py-4 font-weight-bolder">Update a Product</h1>
<div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="card bg-info text-white" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center text-dark">
                <form method="post" action="{{ url('/product/'. $id) }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">

                    <div class="form-outline form-white mb-4">
                        <label class="text-lg">Enter Product Name</label>
                        <input type="text" name="p_name" class="form-control form-control-lg text-dark"
                            value="{{old ('p_name') }}">
                        @error('p_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-outline form-white mb-4">
                        <label class="text-lg">Enter Product Image</label>
                        <input type="file" name="p_image" class="form-control form-control-lg text-dark">
                        @error('p_image')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-outline form-white mb-4">
                        <label class="text-lg">Enter Product Details</label>
                        <input type="text" name="p_details" class="form-control form-control-lg text-dark"
                            value="{{old ('p_details') }}">
                        @error('p_details')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-outline form-white mb-4">
                        <label class="text-lg">Enter Product Price</label>
                        <input type="text" name="p_price" class="form-control form-control-lg text-dark"
                            value="{{old ('p_price') }}">
                        @error('p_price')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button class="btn btn-outline-dark btn-lg px-5 mt-3" type="submit">Add</button>

                    <a class="btn btn-outline-dark btn-lg px-3 mt-3 ml-5" href="{{ url()->previous() }}">
                        <i class="fa fa-chevron-circle-left">&ensp;Go Back</i>
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection