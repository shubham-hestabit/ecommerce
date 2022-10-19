@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-center">
    <div class="btn btn-danger col-sm-3 mt-2 mr-5">
        <a href="category/create"><i class="fa fa-plus fa-2x text-light">&ensp;Add a Category</i></a>
    </div>

    <div class="btn btn-info col-sm-3 mt-2 ml-5">
        <a href="{{ route('sub-categories') }}"><i class="fa fa-eye fa-2x text-light">&ensp;View Sub Categories</i></a>
    </div>
</div>

<table class="table table-sm-2 text-center mt-3">
    <thead>
        <tr>
            <th>Category ID</th>
            <th>Category Name</th>
            <th>Category Image</th>
            <th>Update</th>
            <th>Delete</th>
            <th>Add Sub Category</th>
        </tr>
    </thead>
    <tbody class="text-center">
        @foreach ($cat_all as $category)

        <tr>
            <td>{{ $category->c_id }}</td>
            <td>{{ $category->c_name }}</td>
            <td>
                <img src="{{ '/storage/category-images/' . $category->c_image }}" alt="category-image" height="70">
            </td>
            <td>
                <a href="/category/{{$category->c_id}}/edit">
                    <i class="fa fa-edit fa-2x text-dark ml-1"></i>
                </a>
            </td>
            <td>
                <form method="post" action="/category/{{$category->c_id}}">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" style="border:none">
                        <i class="fa fa-trash fa-2x text-danger ml-1"></i>
                    </button>
                </form>
            </td>
            <td>
                <a href="/sub-category/create">
                    <i class="fa fa-plus fa-2x text-success ml-4"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection