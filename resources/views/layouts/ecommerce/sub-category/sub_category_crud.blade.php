@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-around">
    <div class="btn btn-dark mt-2 ml-5">
        <a href="{{ url('/category') }}"><i class="fa fa-arrow-left fa-2x text-light">&nbsp;Back</i></a>
    </div>

    <h1 class="font-weight-bolder">Sub Categories</h1>
    
    <div class="btn btn-success mt-2 ml-5">
        <a href="{{ Route('sc-create', $cat_id ) }}"><i class="fa fa-plus fa-2x text-light">&nbsp;Add</i></a>
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
            <th>View Products</th>
        </tr>
    </thead>
    <tbody class="text-center">
        @foreach ($sub_category as $sub_category)
        <tr>
            <td>{{ $sub_category->sc_id }}</td>
            <td>{{ $sub_category->sc_name }}</td>
            <td>
                <img src="{{ '/storage/sub-category-images/' . $sub_category->sc_image }}" alt="SubCategory-image"
                    height="70">
            </td>
            <td>
                <a href="{{ url('/sub-category-edit/'. $sub_category->sc_id) }}">
                    <i class="fa fa-edit fa-2x text-dark ml-1"></i>
                </a>
            </td>
            <td>
                <form method="post" action="{{ url('/sub-category-delete/'. $sub_category->sc_id) }}">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" style="border:none; background:transparent;">
                        <i class="fa fa-trash fa-2x text-danger ml-1"></i>
                    </button>
                </form>
            </td>
            <td>
                <a href="{{ url('/product/'. $sub_category->sc_id) }}">
                    <i class="fa fa-eye fa-2x text-primary ml-2"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection