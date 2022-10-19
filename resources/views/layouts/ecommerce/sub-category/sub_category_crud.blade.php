@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-center">
    <div class="btn btn-primary col-sm-3 mt-2 mr-5">
        <a href="{{route('categories')}}"><i class="fa fa-eye fa-2x text-light">&ensp;View Categories</i></a>
    </div>

    <div class="btn btn-danger col-sm-3 mt-2">
        <a href="/sub-category/create"><i class="fa fa-plus fa-2x text-light">&ensp;Add a Sub Category</i></a>
    </div>

    <div class="btn btn-info col-sm-3 mt-2 ml-5">
        <a href="{{route('categories')}}"><i class="fa fa-eye fa-2x text-light">&ensp;View Products</i></a>
    </div>
</div>

<table class="table table-sm-2 text-center mt-3">
    <thead>
        <tr>
            <th>Sub Category ID</th>
            <th>Sub Category Name</th>
            <th>Sub Category Image</th>
            <th>Update</th>
            <th>Delete</th>
            <th>Add Products</th>
        </tr>
    </thead>
    <tbody class="text-center">
        @foreach ($sub_cat_all as $sub_category)
        <tr>
            <td>{{ $sub_category->sc_id }}</td>
            <td>{{ $sub_category->sc_name }}</td>
            <td>
                <img src="{{ '/storage/sub-category-images/' . $sub_category->sc_image }}" alt="category-image"
                    height="70">
            </td>
            <td>
                <a href="/sub-category/{{$sub_category->sc_id}}/edit">
                    <i class="fa fa-edit fa-2x text-dark"></i>
                </a>
            </td>
            <td>
                <a href="{{ route('categories') }}">
                    <i class="fa fa-trash fa-2x text-danger ml-4"></i>
                </a>
            </td>
            <td>
                <a href="{{ route('categories') }}">
                    <i class="fa fa-plus fa-2x text-success ml-4"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection