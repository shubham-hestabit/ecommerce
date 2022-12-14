@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-around">
    <div class="btn btn-dark mt-2 ml-5">
        <a href="{{ url('category') }}"><i class="fa fa-arrow-left fa-2x text-light">&nbsp;Back</i></a>
    </div>

    <h1 class="font-weight-bolder">Sub Categories</h1>

    <div class="btn btn-success mt-2 ml-5">
        <a href="{{ url('/sub-category/create/'. $id) }}"><i class="fa fa-plus fa-2x text-light">&nbsp;Add</i></a>
    </div>
</div>

<table class="table table-hover table-bordered table-sm-2 text-center mt-3">
    <thead class="thead-dark">
        <tr>
            <th>Sub Category ID</th>
            <th>Sub Category Name</th>
            <th>Sub Category Image</th>
            <th>Main Category Name</td>
            <th>Update</th>
            <th>Delete</th>
            <th>View Products</th>
        </tr>
    </thead>
    <tbody class="text-center">
        @foreach ($sub_category as $sub_cat)
        <tr>
            <th>{{ $sub_cat->sc_id }}</th>
            <td>{{ $sub_cat->sc_name }}</td>
            <td>
                <img src="{{ '/storage/sub-category-images/' . $sub_cat->sc_image }}" alt="SubCategory-image"
                    height="70">
            </td>

            @foreach ($category_name as $cat)
            <td>{{ $cat->c_name }}</td>
            @endforeach

            <td>
                <a href="{{ url('/sub-category/'. $sub_cat->sc_id .'/edit') }}">
                    <i class="fa fa-edit fa-2x text-dark ml-1"></i>
                </a>
            </td>
            <td>
                <form method="post" action="{{ url('/sub-category/'. $sub_cat->sc_id) }}">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" style="border:none; background:transparent;">
                        <i class="fa fa-trash fa-2x text-danger ml-1"></i>
                    </button>
                </form>
            </td>
            <td>
                <a href="{{ url('/product/'. $sub_cat->sc_id) }}">
                    <i class="fa fa-eye fa-2x text-primary ml-2"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection