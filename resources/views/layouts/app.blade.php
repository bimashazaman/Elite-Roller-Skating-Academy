<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Roller Skating Academy') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            padding-top: 80px;
            /* Add padding to prevent content overlap */
            background-color: #f8f9fa;
        }

        .navbar {
            transition: all 0.3s ease;
            padding: 1rem 0;
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: #2c3e50 !important;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .navbar-brand:hover {
            background: rgba(0, 0, 0, 0.05);
        }

        .nav-link {
            color: #2c3e50 !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            margin: 0 0.25rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link:hover {
            background: rgba(0, 0, 0, 0.05);
            transform: translateY(-1px);
        }

        .nav-link.active {
            background: #4682B4;
            color: white !important;
        }

        .nav-link.active:hover {
            background: #3a6d96;
        }

        .navbar-toggler {
            border: none;
            padding: 0.5rem;
            border-radius: 8px;
            background: rgba(0, 0, 0, 0.05);
        }

        .navbar-toggler:focus {
            box-shadow: none;
            background: rgba(0, 0, 0, 0.1);
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%280, 0, 0, 0.55%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        .dropdown-menu {
            border: none;
            border-radius: 12px;
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.1);
            padding: 1rem 0;
            margin-top: 1rem;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
        }

        .dropdown-item {
            padding: 0.7rem 1.5rem;
            font-weight: 500;
            color: #2c3e50;
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background: rgba(70, 130, 180, 0.1);
            color: #4682B4;
            transform: translateX(5px);
        }

        .dropdown-item i {
            margin-right: 0.5rem;
            font-size: 1.1rem;
        }

        /* Admin specific styles */
        .admin-nav .nav-link {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.95rem;
        }

        .admin-nav .nav-link i {
            font-size: 1.2rem;
        }

        /* Alert styles */
        .alert {
            border: none;
            border-radius: 12px;
            padding: 1rem 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
        }

        .alert-danger {
            background: #f8d7da;
            color: #721c24;
        }

        /* Container padding for admin pages */
        .admin-container {
            padding-top: 2rem;
            padding-bottom: 4rem;
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 0.5rem 0;
            }

            .navbar-brand {
                font-size: 1.3rem;
            }

            .nav-link {
                padding: 0.7rem 1rem !important;
            }

            .dropdown-menu {
                margin-top: 0.5rem;
                box-shadow: none;
            }
        }

        /* Footer Styles */
        .footer {
            border-top: 1px solid rgba(0, 0, 0, 0.05);
        }

        .footer h5 {
            color: #2c3e50;
            margin-bottom: 1.5rem;
            position: relative;
        }

        .footer .social-links a {
            font-size: 1.2rem;
            transition: all 0.3s ease;
        }

        .footer .social-links a:hover {
            color: #4682B4 !important;
            transform: translateY(-3px);
        }

        .footer ul li a {
            transition: all 0.3s ease;
            display: inline-block;
        }

        .footer ul li a:hover {
            color: #4682B4 !important;
            transform: translateX(5px);
        }

        .footer .bi {
            transition: all 0.3s ease;
        }

        .footer ul li:hover .bi {
            color: #4682B4;
        }
    </style>
    @stack('styles')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Roller Skating Academy') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('blogs.index') ? 'active' : '' }}"
                                href="{{ route('blogs.index') }}">
                                <i class="bi bi-book"></i> {{ __('Blogs') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admission.create') ? 'active' : '' }}"
                                href="{{ route('admission.create') }}">
                                <i class="bi bi-person-plus"></i> {{ __('Admission') }}
                            </a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}"
                                        href="{{ route('login') }}">
                                        <i class="bi bi-box-arrow-in-right"></i> {{ __('Login') }}
                                    </a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}"
                                        href="{{ route('register') }}">
                                        <i class="bi bi-person-plus"></i> {{ __('Register') }}
                                    </a>
                                </li>
                            @endif
                        @else
                            @if (auth()->user()->is_admin)
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                                        href="{{ route('admin.dashboard') }}">
                                        <i class="bi bi-speedometer2"></i> {{ __('Admin Dashboard') }}
                                    </a>
                                </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right"></i> {{ __('Logout') }}
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

        <main>
            @if (session('success'))
                <div class="container mt-4">
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="container mt-4">
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="footer mt-5 py-5 bg-white shadow-sm">
            <div class="container">
                <div class="row">
                    <!-- Academy Info -->
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <h5 class="fw-bold mb-3">{{ config('app.name', 'Roller Skating Academy') }}</h5>
                        <p class="text-muted">Empowering skaters with world-class training and facilities since 2020.
                            Join us in the journey of becoming a professional skater.</p>
                        <div class="social-links">
                            <a href="#" class="me-3 text-dark"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="me-3 text-dark"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="me-3 text-dark"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="text-dark"><i class="bi bi-youtube"></i></a>
                        </div>
                    </div>
                    <!-- Quick Links -->
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <h5 class="fw-bold mb-3">Quick Links</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="{{ route('blogs.index') }}"
                                    class="text-decoration-none text-muted">Blogs</a></li>
                            <li class="mb-2"><a href="{{ route('admission.create') }}"
                                    class="text-decoration-none text-muted">Admission</a></li>
                            <li class="mb-2"><a href="#" class="text-decoration-none text-muted">About Us</a>
                            </li>
                            <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Contact</a>
                            </li>
                        </ul>
                    </div>
                    <!-- Contact Info -->
                    <div class="col-lg-4">
                        <h5 class="fw-bold mb-3">Contact Us</h5>
                        <ul class="list-unstyled text-muted">
                            <li class="mb-2"><i class="bi bi-geo-alt me-2"></i>123 Skating Street, City, Country
                            </li>
                            <li class="mb-2"><i class="bi bi-envelope me-2"></i>info@rollerskating.com</li>
                            <li class="mb-2"><i class="bi bi-telephone me-2"></i>+1 234 567 890</li>
                        </ul>
                    </div>
                </div>
                <hr class="my-4">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start">
                        <p class="text-muted mb-0">&copy; {{ date('Y') }}
                            {{ config('app.name', 'Roller Skating Academy') }}. All rights reserved.</p>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <a href="#" class="text-muted text-decoration-none me-3">Privacy Policy</a>
                        <a href="#" class="text-muted text-decoration-none">Terms of Service</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>

</html>
