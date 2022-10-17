@extends('layouts.app')

@section('content')

<table class="table table-sm-2 text-center">
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