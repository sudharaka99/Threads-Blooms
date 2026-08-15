<header class="admin-navbar">

    <div class="admin-navbar-left">

        <button
            class="sidebar-toggle"
            onclick="openSidebar()"
        >
            <i class="fa-solid fa-bars"></i>
        </button>

        <div>

            <span class="admin-page-small">
                Threads & Blooms
            </span>

            <h1>
                @yield('page-title', 'Dashboard')
            </h1>

        </div>

    </div>


    <div class="admin-navbar-right">

        {{-- Store Link --}}
        <a
            href="{{ url('/') }}"
            target="_blank"
            class="view-store"
        >
            <i class="fa-solid fa-store"></i>
            <span>View Store</span>
        </a>


        {{-- Notifications --}}
        <button class="admin-notification">

            <i class="fa-regular fa-bell"></i>

            <span>3</span>

        </button>


        {{-- User --}}
        <div class="admin-user-menu">

            <button
                class="admin-user"
                onclick="toggleUserMenu()"
            >

                <div class="admin-avatar">
                    <i class="fa-solid fa-user"></i>
                </div>

                <div class="admin-user-info">

                    <strong>
                        {{ auth()->user()->name ?? 'Administrator' }}
                    </strong>

                    <span>
                        Administrator
                    </span>

                </div>

                <i class="fa-solid fa-chevron-down"></i>

            </button>


            <div class="admin-user-dropdown">

                <a href="#">
                    <i class="fa-regular fa-user"></i>
                    My Profile
                </a>

                <a href="#">
                    <i class="fa-solid fa-gear"></i>
                    Settings
                </a>

                <hr>

                <form
                    method="POST"
                    action="{{ route('logout') }}"
                >
                    @csrf

                    <button type="submit">

                        <i class="fa-solid fa-arrow-right-from-bracket"></i>

                        Logout

                    </button>

                </form>

            </div>

        </div>

    </div>

</header>