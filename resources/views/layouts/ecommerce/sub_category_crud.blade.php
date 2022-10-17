@extends('layouts.app')

@section('content')

<table class="table table-sm-2 text-center">
    <thead>
        <tr>
            <th>Sub Category ID</th>
            <th>Sub Category Name</th>
            <th>Sub Category Image</th>
            <th>Sub Category Editing</th>
            <th>View Products</th>
        </tr>
    </thead>
    <tbody class="text-center">
        @foreach ($sub_cat_all as $sub_category)
        <tr>
            <td>{{ $sub_category->sc_id }}</td>
            <td>{{ $sub_category->sc_name }}</td>
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