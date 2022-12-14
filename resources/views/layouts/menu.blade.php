<li class="nav-item">
    @if (auth()->user()->role_id == 1)
        <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
            <i class="nav-icon fas fa-home"></i>
            <p>Home</p>
        </a>

        <a href="{{ url('category') }}" class="nav-link {{ Request::is('category') ? 'active' : '' }}">
            <i class="nav-icon fa fa-list"></i>
            <p>Category</p>
        </a>
    @endif

    <a href="{{ url('product') }}" class="nav-link {{ Request::is('product') ? 'active' : '' }}">
        <i class="nav-icon fas fa-shopping-cart"></i>
        <p>Products</p>
    </a>

    <a href="{{ url('orders') }}" class="nav-link {{ Request::is('orders') ? 'active' : '' }}">
        <i class="nav-icon fas fa-shopping-bag"></i>
        <p>Your Orders</p>
    </a>

    <a href="{{ url('subscription') }}" class="nav-link {{ Request::is('subscription') ? 'active' : '' }}">
        <i class="nav-icon fa fa-bell"></i>
        <p>Subscription</p>
    </a>
</li>
