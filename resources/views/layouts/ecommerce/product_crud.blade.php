@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm mt-5">
            <div class="container mt-4">
                <h2>Insert New Product</h2>
                <form method="post" action="/product-insert" novalidate>
                    @csrf
                    <div class="form-group mt-4">
                        <label>Enter Product Name</label>
                        <input type="text" class="form-control" name="p_name">

                        <label>Enter Product Details</label>
                        <input type="text" class="form-control" name="p_details">

                        <label>Enter Product Price</label>
                        <input type="text" class="form-control" name="p_price">

                        <label>Enter Product ID</label>
                        <input type="number" class="form-control" name="sc_id">
                    </div>

                    <div class="d-grid text-center">
                        <input type="submit" value="Submit" class="btn btn-danger col-sm-5">
                    </div>
                </form>
            </div>

            <div class="container mt-5">
                <h2>View a Product</h2>
                <form method="post" action="/product-read" novalidate>
                    @csrf
                    <div class="form-group mt-4">
                        <label>Enter Product ID</label>
                        <input type="number" class="form-control" name="id">
                    </div>

                    <div class="d-grid text-center">
                        <input type="submit" value="Submit" class="btn btn-danger col-sm-5">
                    </div>
                </form>
            </div>
        </div>
        <div class="col-sm mt-5">
            <div class="container mt-5 ml-5">
                <h2>Update a Product</h2>
                <form method="post" action="/product-update" novalidate>
                    @csrf
                    <div class="form-group mt-4">
                        <label>Enter Product ID</label>
                        <input type="number" class="form-control" name="id">

                        <label>Enter Product Name</label>
                        <input type="text" class="form-control" name="p_name">

                        <label>Enter Product Details</label>
                        <input type="text" class="form-control" name="p_details">
                    </div>

                    <div class="d-grid text-center">
                        <input type="submit" value="Submit" class="btn btn-danger col-sm-5">
                    </div>
                </form>
            </div>

            <div class="container mt-5 ml-5">
                <h2>Delete a Product</h2>
                <form method="post" action="/product-delete" novalidate>
                    @csrf
                    <div class="form-group mt-4">
                        <label>Enter Product ID</label>
                        <input type="number" class="form-control" name="id">
                    </div>

                    <div class="d-grid text-center">
                        <input type="submit" value="Submit" class="btn btn-danger col-sm-5">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection