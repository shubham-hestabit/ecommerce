<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('home') }}" class="brand-link">
        <!-- <img src="https://assets.infyom.com/logo/blue_logo_150x150.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span> -->
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTzDHPihbUCvrHPS-HeWgxhYcVXK4jV9MiZ1Q&usqp=CAU"
            alt="AdminLTE Logo" class="brand-image img-circle elevation-3">

        <span class="brand-text font-weight-light">E-Commerce</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @include('layouts.menu')
            </ul>
        </nav>
    </div>

</aside>