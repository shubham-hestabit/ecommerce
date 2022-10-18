@extends('layouts.app')

@section('content')

<div class="col-sm-4 mt-2 ml-5">
    <form method="post" action="/category-insert" enctype=multipart/form-data>
        @csrf
        <label>Enter a Category</label>
        <input type="text" name="c_name" class="form-control">

        <label>Enter Category Image</label>
        <input type="file" name="c_image" class="form-control">

        <div class="mt-4 text-center">
            <input type="submit" value="Add" class="btn btn-success col-sm-3">
        </div>
    </form>
</div>

@endsection