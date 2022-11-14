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
            border: 1px solid black;
            -webkit-border-radius: 100px;
            -moz-border-radius: 100px;
            border-radius: 100px;
        }

        #file {
            display: none;
        }
    </style>
    @if ($message = Session::get('success'))
        <div class="alert alert-success" id="msg">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block" id="msg">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <script>
        setTimeout(function() {
            $("#msg").hide();
        }, 7000);
    </script>
    <div class="container py-3">
        <div class="row gutters justify-content-center">
            <div class="col-xl-9 col-lg-9">
                <form action="{{ route('update-user-profile') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card border border-dark">
                        <div class="card-body">
                            <div class="row gutters">
                                <div class="col-md-7">
                                    <div class="user-profile">
                                        <div class="user-avatar float-right">
                                            <div class="profile-pic">
                                                @if (Auth::user()->profile_pic == null)
                                                    <img src="{{ 'storage/user.png' }}" id="user_img" alt="ProfilePicture"
                                                        class="user-image img-circle elevation-2" />
                                                @else
                                                    <img src="{{ '/storage/user-images/' . Auth::user()->profile_pic }}"
                                                        class="user-image img-circle elevation-2" id="user_img"
                                                        alt="ProfilePicture">
                                                @endif
                                                <h5 class="user-name mt-2">{{ $user->name }}</h5>
                                                <h6 class="user-email">{{ $user->email }}</h6>
                                                <label class="label btn btn-primary" for="file">
                                                    <span class="fa fa-fw fa-camera"></span>
                                                    <span>Change Image</span>
                                                </label>
                                                <input id="file" type="file" name="user_img"
                                                    onchange="loadFile(event)" />
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
                                        <input type="text" class="form-control" name="name"
                                            value="{{ $user->name }}" placeholder="Enter full name">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="eMail">Email</label>
                                        <input type="email" class="form-control" name="email"
                                            value="{{ $user->email }}" placeholder="Enter email id">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" class="form-control" name="phone" pattern="[0-9]*"
                                            maxlength="10" value="{{ $user->phone }}" placeholder="Enter phone number">
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
                                        <input type="name" class="form-control" name="street"
                                            value="{{ $userAddress->street }}" placeholder="Enter Street">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <input type="name" class="form-control" name="city"
                                            value="{{ $userAddress->city }}" placeholder="Enter City">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="state">State</label>
                                        <input type="text" class="form-control" name="state"
                                            value="{{ $userAddress->state }}" placeholder="Enter State">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="zipCode">Zip Code</label>
                                        <input type="text" class="form-control" name="zipCode" pattern="[0-9]*"
                                            maxlength="6" value="{{ $userAddress->zipcode }}" placeholder="Zip Code">
                                    </div>
                                </div>
                            </div>
                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="text-right">
                                        @if (Auth::user()->role_id == 1)
                                            <a class="btn btn-secondary" href="{{ url('/home') }}">Cancel</a>
                                        @else
                                            <a class="btn btn-secondary" href="{{ url('/product') }}">Cancel</a>
                                        @endif
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        var loadFile = function(event) {
            var image = document.getElementById("user_img");
            image.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
@endsection
