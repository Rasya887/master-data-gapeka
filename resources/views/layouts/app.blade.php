<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Vite assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>

    <style>
        /* ...your CSS as is... */
    </style>
</head>

<body>
    <div id="app">
        <!-- Sidebar Overlay -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <a class="logo" href="https://www.kai.id/" target="_blank"></a>
        <button class="sidebar-toggle" id="sidebarToggle">
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
        </button>

        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <h4>Menu Navigation</h4>
                <button class="sidebar-close" id="sidebarClose">×</button>
            </div>
            
            @auth
                <div class="sidebar-menu">
                    <div class="sidebar-section">Admin Management</div>
                    <a href="{{ url('/users') }}" class="sidebar-menu-item">
                        <i>👥</i> Manajemen Users
                    </a>
                    <a href="{{ url('/roles') }}" class="sidebar-menu-item">
                        <i>🔐</i> Manajemen Roles
                    </a>
                    <a href="{{ url('/menus') }}" class="sidebar-menu-item">
                        <i>📋</i> Manajemen Menus
                    </a>
                    
                    <div class="sidebar-section">Master Data</div>
                    <a href="{{ route('daop.index') }}" class="sidebar-menu-item">
                        <i>🚄</i> Master Daop
                    </a>
                    <a href="{{ route('stasiun.index') }}" class="sidebar-menu-item">
                        <i>🏢</i> Master Stasiun
                    </a>
                    <a href="{{ route('jarak.index') }}" class="sidebar-menu-item">
                        <i>📏</i> Master Jarak
                    </a>
                </div>

                <div class="sidebar-profile">
                    <div class="profile-info">
                        <div class="profile-name">{{ Auth::user()->name ?? 'User' }}</div>
                        <div class="profile-role">Administrator</div>
                    </div>
                    <button class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </button>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            @else
                <div class="sidebar-menu">
                    <div class="sidebar-section">Authentication</div>
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="sidebar-menu-item">
                            <i>🔑</i> Login
                        </a>
                    @endif
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="sidebar-menu-item">
                            <i>📝</i> Register
                        </a>
                    @endif
                </div>
            @endauth
        </div>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarClose = document.getElementById('sidebarClose');
            const sidebar = document.getElementById('sidebar');
            const sidebarOverlay = document.getElementById('sidebarOverlay');

            function openSidebar() {
                sidebar.classList.add('active');
                sidebarOverlay.classList.add('active');
                sidebarToggle.classList.add('active');
                document.body.style.overflow = 'hidden';
            }

            function closeSidebar() {
                sidebar.classList.remove('active');
                sidebarOverlay.classList.remove('active');
                sidebarToggle.classList.remove('active');
                document.body.style.overflow = 'auto';
            }

            sidebarToggle.addEventListener('click', openSidebar);
            sidebarClose.addEventListener('click', closeSidebar);
            sidebarOverlay.addEventListener('click', closeSidebar);

            // Close sidebar when clicking outside
            document.addEventListener('click', function(event) {
                if (!sidebar.contains(event.target) && !sidebarToggle.contains(event.target) && sidebar.classList.contains('active')) {
                    closeSidebar();
                }
            });

            // Close sidebar on escape key
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape' && sidebar.classList.contains('active')) {
                    closeSidebar();
                }
            });
        });
    </script>
</body>
</html>