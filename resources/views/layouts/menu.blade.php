<li class="nav-item">

    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>

    <a href="{{ url('category') }}" class="nav-link {{ Request::is('category') ? 'active' : '' }}">
        <i class="nav-icon fa fa-list"></i>
        <p>Category</p>
    </a>

    <a href="{{ url('product') }}" class="nav-link {{ Request::is('product') ? 'active' : '' }}">
        <i class="nav-icon fa fa-product-hunt"></i>
        <p>Products</p>
    </a>

    <a href="{{ url('orders') }}" class="nav-link {{ Request::is('orders') ? 'active' : '' }}">
        <i class="nav-icon fas fa-shopping-bag"></i>
        <p>Your Orders</p>
    </a>

</li>