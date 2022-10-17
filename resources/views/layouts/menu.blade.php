<!-- need to remove -->

<li class="nav-item">

    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>

    <a href="{{ route('categories') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fa fa-list"></i>
        <p>Category</p>
    </a>

    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fa fa-list-alt"></i>
        <p>Sub Category</p>
    </a>

    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fa fa-product-hunt"></i>
        <p>Products</p>
    </a>

</li>