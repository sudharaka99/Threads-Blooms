<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Threads & Blooms')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" media="print" onload="this.media='all'">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
    @stack('styles')
</head>
<body>
    @include('partials.top-bar')
    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    <!-- Scripts -->
    <script>
        // ==============================
        // NAVBAR FUNCTIONS
        // ==============================
        
        // Toggle mobile menu
        function toggleMenu() {
            const navLinks = document.getElementById('navLinks');
            if (navLinks) {
                navLinks.classList.toggle('show');
            }
        }

        // Toggle user dropdown
        function toggleUserMenu() {
            const dropdown = document.getElementById('userDropdown');
            if (dropdown) {
                dropdown.classList.toggle('show');
            }
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const userMenu = document.querySelector('.user-menu');
            if (userMenu && !userMenu.contains(event.target)) {
                const dropdown = document.getElementById('userDropdown');
                if (dropdown) {
                    dropdown.classList.remove('show');
                }
            }
        });

        // Close mobile menu when clicking a link
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.nav-links a').forEach(link => {
                link.addEventListener('click', () => {
                    const navLinks = document.getElementById('navLinks');
                    if (navLinks && navLinks.classList.contains('show')) {
                        navLinks.classList.remove('show');
                    }
                });
            });
        });

        // Close dropdown on escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                const dropdown = document.getElementById('userDropdown');
                if (dropdown) {
                    dropdown.classList.remove('show');
                }
            }
        });
    </script>
    @stack('scripts')
</body>
</html>