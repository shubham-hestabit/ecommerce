<li class="nav-item">

    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>

    <a href="{{ url('/category') }}" class="nav-link {{ Request::is('category') ? 'active' : '' }}">
        <i class="nav-icon fa fa-list"></i>
        <p>Category</p>
    </a>

</li>