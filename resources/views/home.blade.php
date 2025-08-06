<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Bundle JS (include Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
    
    <style> 
        :root {
            --kai-orange: #FF6B35;
            --kai-blue: #1E3A8A;
            --kai-light-blue: #3B82F6;
            --kai-dark-blue: #1E40AF;
            --kai-white: #FFFFFF;
            --kai-gray-light: #F8FAFC;
            --kai-gray-medium: #E2E8F0;
            --kai-shadow: rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Nunito', sans-serif;
            background: url('/images/fotokai5.jpg') no-repeat center center fixed;
            background-size: cover;
            background-attachment: fixed; /* penting */
            margin: 0;
            padding: 0;
            height: 100vh;
            overflow-x: hidden;
        }

        /* Top left hamburger menu */
        .sidebar-toggle {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1040;
            background: rgba(255, 255, 255, 0.95);
            border: none;
            color: var(--kai-blue);
            font-size: 1.2rem;
            cursor: pointer;
            padding: 12px;
            border-radius: 12px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            position: relative;
            width: 50px;
            height: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 4px;
        }

        /* Top right logo */
        .logo {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1040;
            color: var(--kai-blue);
            font-weight: 700;
            font-size: 2rem;
            display: flex;
            align-items: center;
            text-decoration: none;
            background: rgba(255, 255, 255, 0.95);
            padding: 10px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .logo:hover {
            color: var(--kai-orange);
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.15);
        }

        .logo::before {
            content: '🚂';
            font-size: 2rem;
        }

        .sidebar-toggle:hover {
            background: var(--kai-orange);
            color: var(--kai-white);
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(255, 107, 53, 0.3);
        }

        /* Hamburger lines */
        .hamburger-line {
            width: 24px;
            height: 2px;
            background: currentColor;
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        .sidebar-toggle:hover .hamburger-line {
            background: var(--kai-white);
        }

        .sidebar-toggle.active .hamburger-line:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }

        .sidebar-toggle.active .hamburger-line:nth-child(2) {
            opacity: 0;
        }

        .sidebar-toggle.active .hamburger-line:nth-child(3) {
            transform: rotate(-45deg) translate(7px, -6px);
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: -320px;
            width: 320px;
            height: 100vh;
            background: linear-gradient(180deg, var(--kai-blue) 0%, var(--kai-dark-blue) 100%);
            box-shadow: 2px 0 20px rgba(0, 0, 0, 0.15);
            transition: left 0.3s ease;
            z-index: 1050;
            overflow-y: auto;
        }

        .sidebar.active {
            left: 0;
        }

        .sidebar-header {
            padding: 20px;
            background: rgba(255, 107, 53, 0.1);
            border-bottom: 2px solid var(--kai-orange);
        }

        .sidebar-header h4 {
            color: var(--kai-white);
            font-weight: 600;
            margin: 0;
            font-size: 1.1rem;
        }

        .sidebar-close {
            position: absolute;
            top: 15px;
            right: 15px;
            background: none;
            border: none;
            color: var(--kai-white);
            font-size: 1.5rem;
            cursor: pointer;
            padding: 5px;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .sidebar-close:hover {
            background: rgba(255, 107, 53, 0.2);
            color: var(--kai-orange);
        }

        .sidebar-menu {
            padding: 20px 0;
        }

        .sidebar-menu-item {
            display: block;
            padding: 15px 25px;
            color: var(--kai-white);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }

        .sidebar-menu-item:hover {
            background: rgba(255, 107, 53, 0.1);
            color: var(--kai-orange);
            border-left-color: var(--kai-orange);
            text-decoration: none;
        }

        .sidebar-menu-item i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .sidebar-section {
            padding: 10px 25px;
            color: var(--kai-orange);
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid rgba(255, 107, 53, 0.3);
            margin-bottom: 10px;
        }

        .sidebar-profile {
            padding: 20px 25px;
            border-top: 1px solid rgba(255, 107, 53, 0.3);
            margin-top: 20px;
        }

        .sidebar-profile .profile-info {
            color: var(--kai-white);
            margin-bottom: 15px;
        }

        .sidebar-profile .profile-name {
            font-weight: 600;
            font-size: 1.1rem;
        }

        .sidebar-profile .profile-role {
            font-size: 0.9rem;
            color: var(--kai-gray-medium);
        }

        .sidebar-profile .logout-btn {
            background: var(--kai-orange);
            color: var(--kai-white);
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
        }

        .sidebar-profile .logout-btn:hover {
            background: #e55a2b;
            transform: translateY(-2px);
        }

        /* Sidebar Overlay */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1045;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .sidebar-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        /* Main content adjustment */
        main {
            padding-top: 20px !important;
            transition: margin-left 0.3s ease;
            min-height: 100vh;
            margin: 80px 0px 0px 0px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .logo {
                font-size: 1.5rem;
                padding: 8px;
            }
            
            .logo::before {
                font-size: 1.5rem;
            }
            
            .sidebar {
                width: 300px;
            }

            .sidebar-toggle {
                top: 15px;
                left: 15px;
            }

            main {
                margin: 80px 0px 0px 0px;
            }
        }

        @media (max-width: 576px) {
            .logo {
                top: 15px;
                right: 15px;
                font-size: 1.3rem;
                padding: 6px;
            }

            .logo::before {
                font-size: 1.3rem;
            }

            .sidebar-toggle {
                top: 15px;
                left: 15px;
                width: 45px;
                height: 45px;
                padding: 10px;
            }

            .hamburger-line {
                width: 20px;
            }

            main {
                margin: 70px 5px 5px 5px;
            }
        }
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