{{-- resources/views/partials/navbar.blade.php --}}
<header class="navbar">
    <div class="nav-container">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="Threads & Blooms" class="logo-image">
        </a>

        {{-- Navigation Links --}}
        <nav class="nav-links" id="navLinks">
            <a href="{{ route('home') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a>
            <a href="{{ route('products.index') }}" class="{{ request()->is('products*') ? 'active' : '' }}">Products</a>
            <a href="{{ route('customize.create') }}" class="{{ request()->is('customize') ? 'active' : '' }}">Customize</a>
            <a href="{{ route('about') }}" class="{{ request()->is('about') ? 'active' : '' }}">About Us</a>
            <a href="{{ route('contact.create') }}" class="{{ request()->is('contact') ? 'active' : '' }}">Contact</a>

            {{-- Mobile Auth Links --}}
            @auth
                @php($userDashboardRoute = Auth::user()->is_admin ? route('admin.dashboard') : route('profile.edit'))
                <a href="{{ $userDashboardRoute }}">Dashboard</a>
                <a href="{{ route('profile.edit') }}">Profile</a>
                <a href="{{ route('orders.index') }}">Orders</a>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">
                    Logout
                </a>
                <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @endauth
        </nav>

        {{-- Icons & Auth Buttons --}}
        <div class="nav-icons">
            <a href="{{ route('search') }}" class="nav-icon">
                <i class="fa-solid fa-magnifying-glass"></i>
            </a>
            <a href="{{ route('wishlist.index') }}" class="nav-icon">
                <i class="fa-regular fa-heart"></i>
            </a>
            <a href="{{ route('cart.index') }}" class="nav-icon">
                <i class="fa-solid fa-bag-shopping"></i>
                <span class="cart-count">{{ session('cart_count', 0) }}</span>
            </a>

            {{-- Desktop Auth Buttons --}}
            <div class="auth-buttons">
                @auth
                    <div class="user-menu">
                        <button class="btn-user" onclick="toggleUserMenu()">
                            <i class="fa-regular fa-user"></i>
                            <span>{{ Auth::user()->name }}</span>
                            <i class="fa-solid fa-chevron-down"></i>
                        </button>
                        <div class="user-dropdown" id="userDropdown">
                            <a href="{{ Auth::user()->is_admin ? route('admin.dashboard') : route('profile.edit') }}">
                                <i class="fa-regular fa-user"></i> Dashboard
                            </a>
                            <a href="{{ route('profile.edit') }}">
                                <i class="fa-regular fa-address-card"></i> Profile
                            </a>
                            <a href="{{ route('orders.index') }}">
                                <i class="fa-regular fa-receipt"></i> Orders
                            </a>
                            <hr>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa-solid fa-right-from-bracket"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline btn-small">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-small">Register</a>
                @endauth
            </div>
        </div>

        {{-- Mobile Menu Toggle --}}
        <div class="mobile-menu" onclick="toggleMenu()">
            <i class="fa-solid fa-bars"></i>
        </div>

    </div>
</header>