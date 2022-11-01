@extends('layouts.app')

@section('content')

<h1 class="d-flex justify-content-center py-5 font-weight-bolder">Add New Category</h1>
<div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">
                <form method="post" action="/category" enctype="multipart/form-data">
                    @csrf
                    <div class="form-outline form-white mb-4">
                        <label class="text-lg">Enter a Category</label>
                        <input type="text" name="c_name" class="form-control form-control-lg text-primary"
                            value="{{old ('c_name') }}">
                        @error('c_name')
                        <span class="text-light">{{ "$message" }}</span>
                        @enderror
                    </div>

                    <div class="form-outline form-white mb-5">
                        <label class="text-lg">Enter Category Image</label>
                        <input type="file" name="c_image" class="form-control form-control-lg">
                        @error('c_image')
                        <span class="text-light">{{ $message }}</span>
                        @enderror
                    </div>

                    <button class="btn btn-outline-light btn-lg px-5" type="submit">Add</button>

                    <a class="btn btn-outline-light btn-lg px-3 ml-5" href="{{ url('/category') }}">
                        <i class="fa fa-chevron-circle-left">&ensp;Go Back</i></a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection