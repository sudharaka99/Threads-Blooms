<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Admin Dashboard') | Threads & Blooms
    </title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap"
        rel="stylesheet"
    >

    {{-- Font Awesome --}}
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

    {{-- Admin CSS --}}
    <link
        rel="stylesheet"
        href="{{ asset('css/admin.css') }}"
    >

    @stack('styles')
</head>

<body class="admin-body">

    {{-- Sidebar --}}
    @include('admin.partials.sidebar')

    {{-- Main Area --}}
    <div class="admin-main">

        {{-- Top Navigation --}}
        @include('admin.partials.navbar')

        {{-- Page Content --}}
        <main class="admin-content">

            @if(session('success'))
                <div class="admin-alert success">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>{{ session('success') }}</span>
                    <button type="button" onclick="this.parentElement.remove()">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div class="admin-alert error">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <span>{{ session('error') }}</span>
                    <button type="button" onclick="this.parentElement.remove()">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            @endif

            @yield('content')

        </main>

        {{-- Footer --}}
        @include('admin.partials.footer')

    </div>

    {{-- Mobile Overlay --}}
    <div
        class="sidebar-overlay"
        id="sidebarOverlay"
        onclick="closeSidebar()"
    ></div>

    <script>
        function openSidebar() {
            document.querySelector('.admin-sidebar')
                .classList.add('show');

            document.querySelector('.sidebar-overlay')
                .classList.add('show');
        }

        function closeSidebar() {
            document.querySelector('.admin-sidebar')
                .classList.remove('show');

            document.querySelector('.sidebar-overlay')
                .classList.remove('show');
        }

        function toggleUserMenu() {
            document
                .querySelector('.admin-user-dropdown')
                .classList.toggle('show');
        }

        document.addEventListener('click', function(event) {

            const userMenu = document.querySelector('.admin-user-menu');

            if (userMenu && !userMenu.contains(event.target)) {

                document
                    .querySelector('.admin-user-dropdown')
                    ?.classList.remove('show');

            }

        });
    </script>

    @stack('scripts')

</body>
</html>