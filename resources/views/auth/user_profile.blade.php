@extends('layouts.app')

@section('content')
    <style>
        .user-profile {
            margin: 0 0 1rem 0;
            padding-bottom: 1rem;
            text-align: center;
        }

        .user-profile .user-avatar img {
            width: 200px;
            height: 200px;
            border: 1px solid rgb(5, 0, 0);
            -webkit-border-radius: 100px;
            -moz-border-radius: 100px;
            border-radius: 100px;
        }

        #file {
            display: none;
        }
    </style>
    <div class="container py-3">
        <div class="row gutters justify-content-center">
            <div class="col-xl-9 col-lg-9">
                <div class="card">
                    <div class="card-body">
                        <div class="row gutters">
                            <div class="col-md-7">
                                <div class="user-profile">
                                    <div class="user-avatar float-right">
                                        <div class="profile-pic">
                                            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135768.png"
                                                alt="ProfilePicture" id="output" width="200" />
                                            <h5 class="user-name mt-2">{{ Auth::user()->name }}</h5>
                                            <h6 class="user-email">{{ Auth::user()->email }}</h6>
                                            <label class="label btn btn-primary" for="file">
                                                <span class="fa fa-fw fa-camera"></span>
                                                <span>Change Image</span>
                                            </label>
                                            <input id="file" type="file" onchange="loadFile(event)" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mb-2 text-primary">Personal Details</h6>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="fullName">Full Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter full name">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="eMail">Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Enter email id">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" name="phone"
                                        placeholder="Enter phone number">
                                </div>
                            </div>
                        </div>
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mt-3 mb-2 text-primary">Address</h6>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="street">Street</label>
                                    <input type="name" class="form-control" name="street" placeholder="Enter Street">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="name" class="form-control" name="city" placeholder="Enter City">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <input type="text" class="form-control" name="state" placeholder="Enter State">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="zipCode">Zip Code</label>
                                    <input type="text" class="form-control" name="zipCode" placeholder="Zip Code">
                                </div>
                            </div>
                        </div>
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="text-right">
                                    <button type="button" id="submit" name="submit"
                                        class="btn btn-secondary">Cancel</button>
                                    <button type="button" id="submit" name="submit"
                                        class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var loadFile = function(event) {
            var image = document.getElementById("output");
            image.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
@endsection
