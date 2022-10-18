@extends('layouts.app')

@section('content')

<!-- <div class="col-sm-4 mt-2 ml-5">
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
</div> -->

<table class="table table-sm-2 text-center mt-5">
    <thead>
        <tr>
            <th>Category ID</th>
            <th>Category Name</th>
            <th>Category Image</th>
            <th>Add Category</th>
            <th>View Sub Category</th>
        </tr>
    </thead>
    <tbody class="text-center">
        @foreach ($cat_all as $category)
        <tr>
            <td>{{ $category->c_id }}</td>
            <td>{{ $category->c_name }}</td>
            <td>{{ $category->c_image }}</td>
            <td>
                <img src="storage/.{{ $category->c_image }}" alt="category-image" height="70">
            </td>
            <td>
                <a href="{{ route('d') }}"><span class="btn btn-danger mb-1 col-sm-3">Add</span></a>

                <a href="{{ route('categories') }}">
                    <i class="fa fa-edit fa-2x text-dark ml-4"></i>
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