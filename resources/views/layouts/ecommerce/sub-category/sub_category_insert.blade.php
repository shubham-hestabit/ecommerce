@extends('layouts.app')

@section('content')

<h1 class="d-flex justify-content-center py-5 font-weight-bolder">Add New Sub Category</h1>
<div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">
                <form method="post" action="{{ url('/sub-category') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-outline form-white mb-4">
                        <label class="text-lg">Enter a Sub Category</label>
                        <input type="text" name="sc_name" class="form-control form-control-lg text-dark" value="{{old ('sc_name') }}">
                        @error('sc_name')
                        <span class="text-light">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <input type="hidden" name="c_id" value="{{ $id }}">

                    <div class="form-outline form-white mb-5">
                        <label class="text-lg">Enter Sub Category Image</label>
                        <input type="file" name="sc_image" class="form-control form-control-lg text-dark">
                        @error('sc_image')
                        <span class="text-light">{{ $message }}</span>
                        @enderror
                    </div>

                    <button class="btn btn-outline-light btn-lg px-5" type="submit">Add</button>
                    
                    <a class="btn btn-outline-light btn-lg px-3 ml-5" href="{{ url('/sub-category/'. $id) }}">
                        <i class="fa fa-chevron-circle-left">&ensp;Go Back</i></a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection