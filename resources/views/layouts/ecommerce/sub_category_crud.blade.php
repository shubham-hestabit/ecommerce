@extends('layouts.app')

@section('content')

<!-- <div class="container">
    <div class="row">
        <div class="col-sm mt-5">
            <div class="container mt-5">
                <h2>Insert New Sub Category</h2>
                <form method="post" action="/sub-category-insert" novalidate>
                    @csrf
                    <div class="form-group mt-4">
                        <label>Enter Sub Category Name</label>
                        <input type="text" class="form-control" name="sc_name">

                        <label>Enter Category ID</label>
                        <input type="number" class="form-control" name="c_id">
                    </div>

                    <div class="d-grid text-center">
                        <input type="submit" value="Submit" class="btn btn-success col-sm-5">
                    </div>
                </form>
            </div>

            <div class="container mt-5">
                <h2>View a Sub Category</h2>
                <form method="post" action="/sub-category-read" novalidate>
                    @csrf
                    <div class="form-group mt-4">
                        <label>Enter Sub Category ID</label>
                        <input type="number" class="form-control" name="id">
                    </div>

                    <div class="d-grid text-center">
                        <input type="submit" value="Submit" class="btn btn-success col-sm-5">
                    </div>
                </form>
            </div>
        </div>
        <div class="col-sm mt-5">
            <div class="container mt-5 ml-5">
                <h2>Update a Sub Category</h2>
                <form method="post" action="/sub-category-update" novalidate>
                    @csrf
                    <div class="form-group mt-4">
                        <label>Enter Sub Category ID</label>
                        <input type="number" class="form-control" name="id">

                        <label>Enter Sub Category Name</label>
                        <input type="text" class="form-control" name="sc_name">
                    </div>

                    <div class="d-grid text-center">
                        <input type="submit" value="Submit" class="btn btn-success col-sm-5">
                    </div>
                </form>
            </div>

            <div class="container mt-5 ml-5">
                <h2>Delete a Sub Category</h2>
                <form method="post" action="/sub-category-delete" novalidate>
                    @csrf
                    <div class="form-group mt-4">
                        <label>Enter Sub Category ID</label>
                        <input type="number" class="form-control" name="id">
                    </div>

                    <div class="d-grid text-center">
                        <input type="submit" value="Submit" class="btn btn-success col-sm-5">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> -->

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
            <td>{{ $category->sc_id }}</td>
            <td>{{ $category->sc_name }}</td>
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

</ @endsection