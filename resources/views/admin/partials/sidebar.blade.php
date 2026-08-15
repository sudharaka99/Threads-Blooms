<aside class="admin-sidebar">

    {{-- Logo --}}
    <div class="admin-sidebar-logo">
        <a href="{{ route('admin.dashboard') }}" class="logo-link">
            <img
                src="{{ asset('images/logo.png') }}"
                alt="Threads & Blooms"
                class="sidebar-logo-img"
            >
        </a>

        <button
            class="sidebar-close"
            onclick="closeSidebar()"
            aria-label="Close sidebar"
        >
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

    {{-- Navigation --}}
    <div class="sidebar-label">
        MAIN MENU
    </div>

    <nav class="admin-menu">

        <a
            href="{{ route('admin.dashboard') }}"
            class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
        >
            <i class="fa-solid fa-gauge-high"></i>
            <span>Dashboard</span>
        </a>

        <a
            href="{{ route('admin.products.index') }}"
            class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}"
        >
            <i class="fa-solid fa-shirt"></i>
            <span>Products</span>
        </a>

        <a
            href="{{ route('admin.categories.index') }}"
            class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}"
        >
            <i class="fa-solid fa-layer-group"></i>
            <span>Categories</span>
        </a>

        <a
            href="{{ route('admin.orders.index') }}"
            class="{{ request()->routeIs('admin.orders.*') ? 'active' : '' }}"
        >
            <i class="fa-solid fa-bag-shopping"></i>
            <span>Orders</span>
            <span class="menu-badge">5</span>
        </a>

        <a
            href="{{ route('admin.users.index') }}"
            class="{{ request()->routeIs('admin.customers.*') ? 'active' : '' }}"
        >
            <i class="fa-solid fa-users"></i>
            <span>Customers</span>
        </a>

        <a
            href="{{ route('admin.custom-orders.index') }}"
            class="{{ request()->routeIs('admin.custom-orders.*') ? 'active' : '' }}"
        >
            <i class="fa-solid fa-wand-magic-sparkles"></i>
            <span>Custom Orders</span>
        </a>

        <div class="sidebar-label">
            MANAGEMENT
        </div>

        <a
            href="{{ route('admin.reports.sales') }}"
            class="{{ request()->routeIs('admin.reports') ? 'active' : '' }}"
        >
            <i class="fa-solid fa-chart-line"></i>
            <span>Reports</span>
        </a>

        <a
            href="#"
            class="{{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}"
        >
            <i class="fa-regular fa-star"></i>
            <span>Reviews</span>
        </a>

        <a
            href="{{ route('admin.users.index') }}"
            class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}"
        >
            <i class="fa-solid fa-user-shield"></i>
            <span>Admin Users</span>
        </a>

        <div class="sidebar-label">
            SYSTEM
        </div>

        <a
            href="#"
            class="{{ request()->routeIs('admin.settings') ? 'active' : '' }}"
        >
            <i class="fa-solid fa-gear"></i>
            <span>Settings</span>
        </a>

    </nav>

    {{-- Sidebar Bottom --}}
    <div class="sidebar-bottom">

        <div class="handmade-message">
            <i class="fa-solid fa-heart"></i>
            <div>
                <strong>Made with Love</strong>
                <span>Bloom in every stitch</span>
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="sidebar-logout">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                <span>Logout</span>
            </button>
        </form>

    </div>

</aside>