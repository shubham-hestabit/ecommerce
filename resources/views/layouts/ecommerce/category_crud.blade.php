@extends('layouts.app')

@section('content')

<div class="col-sm-5 mt-2 ml-5">
    <form method="post" action="/category-insert" novalidate>
        @csrf
        <label>Enter a Category</label>
        <input type="text" class="form-control" id="c_name">

        <!-- <label>Enter Category Image</label>
        <input type="file" class="form-control"> -->

        <div class="mt-4 text-center">
            <input type="submit" value="Submit" class="btn btn-success col-sm-4">
        </div>
    </form>
</div>

<table class="table table-sm-2 text-center mt-5">
    <thead>
        <tr>
            <th>Category ID</th>
            <th>Category Name</th>
            <th>Category Image</th>
            <th>Category Editing</th>
            <th>View Sub Category</th>
        </tr>
    </thead>
    <tbody class="text-center">
        @foreach ($cat_all as $category)
        <tr>
            <td>{{ $category->c_id }}</td>
            <td>{{ $category->c_name }}</td>
            <td>image</td>
            <td>
                <a href="{{ route('categories') }}">
                    <i class="fa fa-edit fa-2x text-dark"></i>
                </a>

                <a href="{{ route('categories') }}">
                    <i class="fa fa-trash fa-2x text-danger ml-4"></i>
                </a>
            </td>
            <td>
                <a href="{{ route('categories') }}">
                    <i class="fa fa-eye fa-2x text-info ml-4"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection