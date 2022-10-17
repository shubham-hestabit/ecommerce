<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sub Categories Dashboard</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
        integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
        crossorigin="anonymous" />

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <style>
    .container {
        max-width: 400px;
        margin: 0px 0px;
        font-family: sans-serif;
    }

    .container1 {
        margin: 150px 350px;
    }

    .container2 {
        margin-left: 1100px;
        margin-top: -780px;
    }

    h2 {
        text-align: center
    }

    form {
        border: 1px solid #1A33FF;
        background: #9348;
        padding: 40px 50px 45px;
    }

    .form-control:focus {
        border-color: #000;
        box-shadow: none;
    }

    .error {
        color: red;
        font-weight: 400;
        display: block;
        padding: 6px 0;
        font-size: 14px;
    }

    .form-control.error {
        border-color: red;
        padding: .375rem .75rem;
    }
    </style>

    @stack('third_party_stylesheets')

    @stack('page_css')
</head>

<body>

    <div class="container1">
        <div class="container mt-5">
            <h2>Insert New Sub Category</h2>
            <form method="post" action="/sub-category-insert" novalidate>
                @csrf
                <div class="form-group mb-2">
                    <label>Enter Sub Category Name</label>
                    <input type="text" class="form-control" name="sc_name">

                    <label>Enter Category ID</label>
                    <input type="number" class="form-control" name="id">
                </div>

                <div class="d-grid mt-4">
                    <input type="submit" value="Submit" class="btn btn-success btn-block">
                </div>
            </form>
        </div>

        <div class="container mt-5">
            <h2>Update a Sub Category</h2>
            <form method="post" action="/sub-category-update" novalidate>
                @csrf
                <div class="form-group mb-2">
                    <label>Enter Sub Category ID</label>
                    <input type="number" class="form-control" name="id">

                    <label>Enter Sub Category Name</label>
                    <input type="text" class="form-control" name="sc_name">
                </div>

                <div class="d-grid mt-3">
                    <input type="submit" value="Submit" class="btn btn-success btn-block">
                </div>
            </form>
        </div>
    </div>

    <div class="container2">
        <div class="container mb-5">
            <h2>View a Sub Category</h2>
            <form method="post" action="/sub-category-read" novalidate>
                @csrf
                <div class="form-group mb-2">
                    <label>Enter Sub Category ID</label>
                    <input type="number" class="form-control" name="id">
                </div>

                <div class="d-grid mt-3">
                    <input type="submit" value="Submit" class="btn btn-success btn-block">
                </div>
            </form>
        </div>

        <div class="container mb-5">
            <h2>Delete a Sub Category</h2>
            <form method="post" action="/sub-category-delete" novalidate>
                @csrf
                <div class="form-group mb-2">
                    <label>Enter Sub Category ID</label>
                    <input type="number" class="form-control" name="id">
                </div>

                <div class="d-grid mt-3">
                    <input type="submit" value="Submit" class="btn btn-success btn-block">
                </div>
            </form>
        </div>
    </div>

</body>

</html>