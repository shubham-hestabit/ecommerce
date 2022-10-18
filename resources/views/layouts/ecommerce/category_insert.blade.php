@extends('layouts.app')

@section('content')

<div class="container py-5 h-100">
    <div class="row d-flex py-5 mt-5 justify-content-center align-items-center h-100">
        <div class="card bg-info text-white" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">
                <form method="post" action="/category-insert" enctype="multipart/form-data">

                    <div class="form-outline form-white mb-4">
                        <label class="text-lg">Enter a Category</label>
                        <input type="text" name="c_name" class="form-control form-control-lg text-primary">
                    </div>

                    <div class="form-outline form-white mb-5">
                        <label class="text-lg">Enter Category Image</label>
                        <input type="file" name="c_image" class="form-control form-control-lg text-primary">
                    </div>

                    <button class="btn btn-outline-light btn-lg px-5" type="submit">Add</button>
                    <a class="btn btn-outline-light btn-lg px-3 ml-5" href="/categories">
                        <i class="fa fa-chevron-circle-left">&ensp;Go Back</i></a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection