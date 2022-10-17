@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm mt-5">
            <div class="container mt-5 ">
                <h2>Insert New Category</h2>
                <form method="post" action="/category-insert" novalidate>
                    @csrf
                    <div class="form-group mt-4">
                        <label>Enter Category Name</label>
                        <input type="text" class="form-control" name="c_name">
                    </div>

                    <div class="d-grid text-center">
                        <input type="submit" value="Submit" class="btn btn-primary col-sm-5">
                    </div>
                </form>
            </div>

            <div class="container mt-5">
                <h2>Update a Category</h2>
                <form method="post" action="/category-update" novalidate>
                    @csrf
                    <div class="form-group mt-4">
                        <label>Enter Category ID</label>
                        <input type="number" class="form-control" name="id">

                        <label>Enter Category Name</label>
                        <input type="text" class="form-control" name="c_name">
                    </div>

                    <div class="d-grid text-center">
                        <input type="submit" value="Submit" class="btn btn-primary col-sm-5">
                    </div>
                </form>
            </div>
        </div>

        <div class="col-sm mt-5">
            <div class="container mt-5 ml-5">
                <h2>View a Category</h2>
                <form method="post" action="/category-read" novalidate>
                    @csrf
                    <div class="form-group mt-4">
                        <label>Enter Category ID</label>
                        <input type="number" class="form-control" name="id">
                    </div>

                    <div class="d-grid text-center">
                        <input type="submit" value="Submit" class="btn btn-primary col-sm-5">
                    </div>
                </form>
            </div>

            <div class="container mt-5 ml-5">
                <h2>Delete a Category</h2>
                <form method="post" action="/category-delete" novalidate>
                    @csrf
                    <div class="form-group mt-4">
                        <label>Enter Category ID</label>
                        <input type="number" class="form-control" name="id">
                    </div>

                    <div class="d-grid text-center">
                        <input type="submit" value="Submit" class="btn btn-primary col-sm-5">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection