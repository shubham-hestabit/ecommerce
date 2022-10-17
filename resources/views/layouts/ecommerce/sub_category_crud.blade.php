@extends('layouts.app')

@section('content')

<div class="container">
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
</div>

</ @endsection