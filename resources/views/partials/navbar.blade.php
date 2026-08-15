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
        </nav>

        {{-- Icons --}}
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
        </div>

        {{-- Mobile Menu --}}
        <div class="mobile-menu" onclick="toggleMenu()">
            <i class="fa-solid fa-bars"></i>
        </div>

    </div>
</header>