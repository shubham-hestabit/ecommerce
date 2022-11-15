<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    {{-- <title>{{ config('app.name') }}</title> --}}
    <title>Dashboard</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
        integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
        crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    @stack('third_party_stylesheets')

    @stack('page_css')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Main Header -->
        <nav class="main-header navbar navbar-expand navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="" role="button">
                        <i class="fas fa-bars"></i></a>
                </li>

                @if (auth()->user()->role_id == 1)
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="{{ route('home') }}" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="{{ url('category') }}" class="nav-link">Category</a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="{{ url('product') }}" class="nav-link">Products</a>
                    </li>
                @else
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="{{ url('product') }}" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="{{ route('orders') }}" class="nav-link">Your Orders</a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="{{ url('subscription') }}" class="nav-link">Subscription</a>
                    </li>
                @endif
            </ul>

            <!-- SEARCH FORM -->
            <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search"
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown user-menu">
                    <a href="" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        @if (Auth::user()->profile_pic == null)
                            <img src="{{ 'storage/user.png' }}" class="user-image img-circle elevation-2"
                                alt="User Image">
                        @else
                            <img src="{{ '/storage/user-images/' . auth()->user()->profile_pic }}"
                                class="user-image img-circle elevation-2" alt="User Image">
                        @endif
                        <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- User image -->
                        <li class="user-header bg-primary">
                            @if (Auth::user()->profile_pic == null)
                                <img src="{{ 'storage/user.png' }}" class="user-image img-circle elevation-2"
                                    alt="User Image">
                            @else
                                <img src="{{ '/storage/user-images/' . auth()->user()->profile_pic }}"
                                    class="user-image img-circle elevation-2" alt="User Image">
                            @endif
                            @php
                                $view_date = Auth::user()->created_at;
                                $date = date('d-M-y h:i:s A', strtotime($view_date));
                            @endphp
                            <p>{{ Auth::user()->name }}<small>Member since: {{ $date }}</small></p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <a href="{{ route('user-profile') }}" class="btn btn-default btn-flat">Profile</a>
                            <a href="" class="btn btn-default btn-flat float-right"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Sign out
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>

        <!-- Left side column. contains the logo and sidebar -->
        @include('layouts.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>

        <!-- Main Footer -->
        <footer class="main-footer fixed-bottom">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.0.5
            </div>
            <strong>Copyright &copy; 2014-2022 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved.
        </footer>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>

    @stack('third_party_scripts')

    @stack('page_scripts')
</body>

</html>
