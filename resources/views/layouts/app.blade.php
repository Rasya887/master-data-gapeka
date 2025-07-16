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
            background-color: var(--kai-gray-light);
        }

        /* Navbar Styles */
        .navbar {
            background: linear-gradient(135deg, var(--kai-blue) 0%, var(--kai-dark-blue) 100%) !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15) !important;
            padding: 15px 0;
            border-bottom: 3px solid var(--kai-orange);
        }

        .navbar-brand {
            color: var(--kai-white) !important;
            font-weight: 700;
            font-size: 1.3rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .navbar-brand:hover {
            color: var(--kai-orange) !important;
        }

        .navbar-brand::before {
            content: '🚂';
            font-size: 1.5rem;
            margin-right: 5px;
        }

        .navbar-toggler {
            border: 2px solid var(--kai-orange);
            padding: 8px 12px;
            border-radius: 8px;
        }

        .navbar-toggler:focus {
            box-shadow: 0 0 0 2px rgba(255, 107, 53, 0.25);
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='%23FF6B35' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
            width: 1.5em;
            height: 1.5em;
        }

        .navbar-nav .nav-link {
            color: var(--kai-white) !important;
            font-weight: 500;
            font-size: 1rem;
            padding: 10px 20px !important;
            border-radius: 8px;
            transition: all 0.3s ease;
            margin: 0 5px;
        }

        .navbar-nav .nav-link:hover {
            background: rgba(255, 107, 53, 0.2);
            color: var(--kai-orange) !important;
            transform: translateY(-2px);
        }

        .dropdown-menu {
            background: var(--kai-white);
            border: 2px solid var(--kai-orange);
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            margin-top: 10px;
        }

        .dropdown-item {
            color: var(--kai-blue);
            font-weight: 500;
            padding: 12px 20px;
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background: var(--kai-orange);
            color: var(--kai-white);
        }

        .dropdown-toggle::after {
            color: var(--kai-orange);
            font-size: 0.8rem;
        }

        /* Main content adjustment */
        main {
            padding-top: 0 !important;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.1rem;
            }
            
            .navbar-nav .nav-link {
                margin: 5px 0;
            }
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Master Data Grafik Perjalanan Kereta
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side -->
                    <ul class="navbar-nav me-auto"></ul>
                    <!-- Right Side -->
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <!-- Dropdown User -->
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                   data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name ?? 'User' }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>