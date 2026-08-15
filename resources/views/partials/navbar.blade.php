{{-- resources/views/partials/navbar.blade.php --}}
<header class="navbar">
    <div class="nav-container">

        {{-- Logo --}}
        <a href="{{ url('/') }}" class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="Threads & Blooms" class="logo-image">
        </a>

        {{-- Navigation Links --}}
        <nav class="nav-links" id="navLinks">
            <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a>
            <a href="{{ url('/products') }}" class="{{ request()->is('products*') ? 'active' : '' }}">Products</a>
            <a href="{{ url('/customize') }}" class="{{ request()->is('customize') ? 'active' : '' }}">Customize</a>
            <a href="{{ url('/about') }}" class="{{ request()->is('about') ? 'active' : '' }}">About Us</a>
            <a href="{{ url('/contact') }}" class="{{ request()->is('contact') ? 'active' : '' }}">Contact</a>
            
            {{-- Mobile Auth Links --}}
            @auth
                <a href="{{ url('/dashboard') }}">Dashboard</a>
                <a href="{{ url('/profile') }}">Profile</a>
                <a href="{{ url('/orders') }}">Orders</a>
                <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">
                    Logout
                </a>
                <form id="logout-form-mobile" action="{{ url('/logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
<<<<<<< HEAD
            @else
                <!-- <a href="{{ url('/login') }}" class="{{ request()->is('login') ? 'active' : '' }}">Login</a>
                <a href="{{ url('/register') }}" class="{{ request()->is('register') ? 'active' : '' }}">Register</a> -->
=======
>>>>>>> cb58fcc1804d4939c7229b6f9db74be83122b6f5
            @endauth
        </nav>

        {{-- Icons & Auth Buttons --}}
        <div class="nav-icons">
            <a href="{{ url('/search') }}" class="nav-icon">
                <i class="fa-solid fa-magnifying-glass"></i>
            </a>
            <a href="{{ url('/wishlist') }}" class="nav-icon">
                <i class="fa-regular fa-heart"></i>
            </a>
            <a href="{{ url('/cart') }}" class="nav-icon">
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
                            <a href="{{ url('/dashboard') }}">
                                <i class="fa-regular fa-user"></i> Dashboard
                            </a>
                            <a href="{{ url('/profile') }}">
                                <i class="fa-regular fa-address-card"></i> Profile
                            </a>
                            <a href="{{ url('/orders') }}">
                                <i class="fa-regular fa-receipt"></i> Orders
                            </a>
                            <hr>
                            <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa-solid fa-right-from-bracket"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ url('/login') }}" class="btn btn-outline btn-small">Login</a>
                    <a href="{{ url('/register') }}" class="btn btn-primary btn-small">Register</a>
                @endauth
            </div>
        </div>

        {{-- Mobile Menu Toggle --}}
        <div class="mobile-menu" onclick="toggleMenu()">
            <i class="fa-solid fa-bars"></i>
        </div>

    </div>
</header>