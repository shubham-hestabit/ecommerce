@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-center">
    <h1 class="font-weight-bolder py-2">Categories</h1>
</div>

<div class="d-flex justify-content-left" style="margin-top: -70px">
    <div class="btn btn-success mt-2 ml-5">
        <a href="category/create"><i class="fa fa-plus fa-2x text-light">&nbsp;Add</i></a>
    </div>
</div>

<table class="table table-hover table-bordered table-sm-2 text-center mt-3">
    <thead class="thead-dark">
        <tr>
            <th>Category ID</th>
            <th>Category Name</th>
            <th>Category Image</th>
            <th>Update</th>
            <th>Delete</th>
            <th>View Sub Category</th>
        </tr>
    </thead>
    <tbody class="text-center">
        @foreach ($category as $cat)

        <tr>
            <th>{{ $cat->c_id }}</th>
            <td>{{ $cat->c_name }}</td>
            <td>
                <img src="{{ '/storage/category-images/' . $cat->c_image }}" alt="category-image" height="70">
            </td>
            <td>
                <a href="{{ url('/category/'. $cat->c_id. '/edit') }}">
                    <i class="fa fa-edit fa-2x text-dark ml-1"></i>
                </a>
            </td>
            <td>
                <form method="post" action="{{ url('/category/'. $cat->c_id) }}">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" style="border:none; background:transparent;">
                        <i class="fa fa-trash fa-2x text-danger ml-1"></i>
                    </button>
                </form>
            </td>
            <td>
                <a href="{{ url('/sub-category/'.$cat->c_id) }}">
                    <i class="fa fa-eye fa-2x text-primary"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection