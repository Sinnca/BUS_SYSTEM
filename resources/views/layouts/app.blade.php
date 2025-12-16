
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Home') - MoveON | Premium Bus Travel</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(250, 245, 255, 0.9) 50%, rgba(99, 102, 241, 0.1) 100%);
            overflow-x: hidden;
            
        }
        body::before {
        content: '';
        position: absolute;
        top: 40%;
       right: 0%;
        width: 125%;
        height: 100%;
        background: radial-gradient(circle, rgba(104, 49, 233, 0.15) );
        animation: rotate 20s linear infinite;
        overflow: hidden;
        z-index: -1;
        }

        
   @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

        /* Premium Dark Navbar */
        .navbar-premium {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.4);
            padding: 1.2rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(139, 92, 246, 0.2);
        }

        .navbar-brand-premium {
            font-size: 1.75rem;
            font-weight: 900;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.3s ease;
            letter-spacing: -0.5px;
        }

        .navbar-brand-premium:hover {
            transform: translateY(-2px);
            color: white;
        }

        .brand-icon {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.3rem;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.4);
        }

        .brand-text {
            background: linear-gradient(135deg, #ffffff 0%, #e0e7ff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .navbar-nav {
            gap: 8px;
        }

        .nav-link-premium {
            color: rgba(255, 255, 255, 0.8) !important;
            font-weight: 600;
            padding: 0.7rem 1.3rem !important;
            border-radius: 10px;
            transition: all 0.3s ease;
            position: relative;
            font-size: 0.95rem;
        }

        .nav-link-premium:hover {
            color: white !important;
            background: rgba(99, 102, 241, 0.15);
            transform: translateY(-1px);
        }

        .nav-link-premium.active {
            color: white !important;
            background: rgba(99, 102, 241, 0.2);
            box-shadow: 0 0 20px rgba(99, 102, 241, 0.3);
        }

        .nav-link-premium.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 30px;
            height: 3px;
            background: linear-gradient(90deg, #6366f1, #8b5cf6);
            border-radius: 3px 3px 0 0;
        }

        .nav-link-premium i {
            margin-right: 6px;
            font-size: 1rem;
        }

        .btn-login-premium {
            background: transparent;
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
            padding: 0.65rem 1.8rem;
            border-radius: 10px;
            font-weight: 700;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .btn-login-premium:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.5);
            color: white;
            transform: translateY(-2px);
        }

        .btn-register-premium {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            color: white;
            border: none;
            padding: 0.65rem 1.8rem;
            border-radius: 10px;
            font-weight: 700;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
            font-size: 0.95rem;
        }

        .btn-register-premium:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(99, 102, 241, 0.6);
            background: linear-gradient(135deg, #7c3aed 0%, #a855f7 100%);
        }

        .dropdown-menu-premium {
            background: #1e293b;
            border: 1px solid rgba(139, 92, 246, 0.2);
            border-radius: 14px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
            padding: 0.75rem;
            margin-top: 0.5rem; 
        }

        .dropdown-item-premium {
            border-radius: 8px;
            padding: 0.7rem 1rem;
            font-weight: 600;
            transition: all 0.2s ease;
            color: rgba(255, 255, 255, 0.8);
        }

        .dropdown-item-premium:hover {
            background: rgba(99, 102, 241, 0.2);
            color: white;
        }

        .dropdown-item-premium i {
            margin-right: 10px;
            width: 20px;
        }

        .user-dropdown-toggle {
            background: rgba(99, 102, 241, 0.15);
            padding: 0.6rem 1.3rem;
            border-radius: 10px;
            color: white !important;
            font-weight: 700;
            transition: all 0.3s ease;
            border: 1px solid rgba(99, 102, 241, 0.3);
        }

        .user-dropdown-toggle:hover {
            background: rgba(99, 102, 241, 0.25);
            border-color: rgba(99, 102, 241, 0.5);
        }

        .user-dropdown-toggle::after {
            margin-left: 10px;
        }

        /* Navbar Toggler for Mobile */
        .navbar-toggler {
            border: 2px solid rgba(255, 255, 255, 0.3);
            padding: 0.5rem 0.75rem;
            border-radius: 8px;
        }

        .navbar-toggler:focus {
            box-shadow: 0 0 0 0.2rem rgba(99, 102, 241, 0.3);
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 255, 255, 0.8)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* Alert Messages */
        .alert-modern {
            border: none;
            border-radius: 14px;
            padding: 1.2rem 1.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            gap: 15px;
            font-weight: 500;
        }

        .alert-modern i {
            font-size: 1.5rem;
        }

        .alert-success-modern {
            background: linear-gradient(135deg, #059669 0%, #10b981 100%);
            color: white;
            border-left: 4px solid #34d399;
        }

        .alert-danger-modern {
            background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
            color: white;
            border-left: 4px solid #f87171;
        }

        .btn-close-modern {
            background: transparent;
            border: none;
            font-size: 1.5rem;
            color: white;
            opacity: 0.7;
            cursor: pointer;
            transition: opacity 0.2s;
        }

        .btn-close-modern:hover {
            opacity: 1;
        }

        /* Footer */
        .footer-modern {
            background: linear-gradient(135deg, #0f172a 0%, #020617 100%);
            color: white;
            padding: 60px 0 30px;
            margin-top: 100px;
            border-top: 1px solid rgba(139, 92, 246, 0.2);
        }

        .footer-brand {
            font-size: 2rem;
            font-weight: 900;
            margin-bottom: 15px;
        }

        .footer-tagline {
            color: rgba(255, 255, 255, 0.6);
            font-size: 1.1rem;
            margin-bottom: 30px;
        }

        .footer-links {
            display: flex;
            gap: 30px;
            margin-bottom: 30px;
        }

        .footer-link {
            color: rgba(255, 255, 255, 0.6);
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .footer-link:hover {
            color: #a855f7;
        }

        .footer-social {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
        }

        .social-icon {
            width: 45px;
            height: 45px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .social-icon:hover {
            background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(99, 102, 241, 0.4);
            border-color: transparent;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 30px;
            margin-top: 40px;
            text-align: center;
            color: rgba(255, 255, 255, 0.4);
        }

        .footer-bottom a {
            color: #a855f7;
            text-decoration: none;
        }

        .footer-bottom a:hover {
            color: #c084fc;
        }

        /* Card Styles */
        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
            background: #1e293b;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.5);
        }

        /* Main Content */
        main {
            min-height: calc(100vh - 400px);
        }

        h1, h2, h3, h4, h5, h6 {
            color: white;
        }

        @media (max-width: 991px) {
            .navbar-brand-premium {
                font-size: 1.5rem;
            }

            .brand-icon {
                width: 40px;
                height: 40px;
                font-size: 1.1rem;
            }

            .nav-link-premium {
                padding: 0.7rem 1rem !important;
                margin: 0.2rem 0;
            }

            .footer-links {
                flex-direction: column;
                gap: 15px;
            }

            .navbar-nav {
                gap: 4px;
                margin-top: 1rem;
            }

            .btn-login-premium,
            .btn-register-premium {
                width: 100%;
                margin-top: 0.5rem;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
<!-- Premium Dark Navbar -->
<nav class="navbar navbar-expand-lg navbar-premium">
    <div class="container">
        <a class="navbar-brand-premium" href="{{ route('home') }}">
            <div class="brand-icon">
                <i class="fas fa-bus"></i>
            </div>
            <span class="brand-text">MoveON</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link-premium {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link-premium {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-premium {{ request()->routeIs('trips.index') ? 'active' : '' }}"
                           href="{{ route('trips.index') }}">
                            <i class="fas fa-route"></i> Trips
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-premium {{ request()->routeIs('my.bookings') ? 'active' : '' }}" href="{{ route('my.bookings') }}">
                            <i class="fas fa-ticket-alt"></i> My Bookings
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link-premium dropdown-toggle user-dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle"></i> {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-premium dropdown-menu-end">
                            <li>
                                <a class="dropdown-item dropdown-item-premium" href="{{ route('profile.edit') }}">
                                    <i class="fas fa-user-edit"></i> My Profile
                                </a>
                            </li>
                            <li><hr class="dropdown-divider" style="border-color: rgba(139, 92, 246, 0.2);"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item dropdown-item-premium" style="color: #f87171;">
                                        <i class="fas fa-sign-out-alt"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item me-2">
                        <a class="btn btn-login-premium" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-register-premium" href="{{ route('register') }}">
                            <i class="fas fa-user-plus"></i> Register
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<!-- Flash Messages -->
@if(session('success'))
    <div class="container mt-4">
        <div class="alert alert-modern alert-success-modern alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
            <button type="button" class="btn-close-modern ms-auto" data-bs-dismiss="alert" aria-label="Close">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
@endif

@if(session('error'))
    <div class="container mt-4">
        <div class="alert alert-modern alert-danger-modern alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle"></i>
            <span>{{ session('error') }}</span>
            <button type="button" class="btn-close-modern ms-auto" data-bs-dismiss="alert" aria-label="Close">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
@endif

@if($errors->any())
    <div class="container mt-4">
        <div class="alert alert-modern alert-danger-modern alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle"></i>
            <div>
                <strong>Please fix the following errors:</strong>
                <ul class="mb-0 mt-2" style="padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <button type="button" class="btn-close-modern ms-auto" data-bs-dismiss="alert" aria-label="Close">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
@endif

<!-- Main Content -->
<main>
    @yield(section: 'content')
</main>

<!-- Modern Footer -->
<footer class="footer-modern">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4 mb-lg-0">
                <div class="footer-brand">
                    <i class="fas fa-bus me-2" style="color: #a855f7;"></i>MoveON
                </div>
                <p class="footer-tagline">Your trusted partner for comfortable and affordable bus travel across the Philippines.</p>
                <div class="footer-social">
                    <a href="#" class="social-icon">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 mb-4 mb-lg-0">
                <h5 class="fw-bold mb-3">Quick Links</h5>
                <div class="d-flex flex-column gap-2">
                    <a href="{{ route('home') }}" class="footer-link">Home</a>
                    <a href="#" class="footer-link">About Us</a>
                    <a href="#" class="footer-link">Routes</a>
                    <a href="#" class="footer-link">Contact</a>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 mb-4 mb-lg-0">
                <h5 class="fw-bold mb-3">Services</h5>
                <div class="d-flex flex-column gap-2">
                    <a href="#" class="footer-link">Book Tickets</a>
                    <a href="#" class="footer-link">Track Bus</a>
                    <a href="#" class="footer-link">Cancellation</a>
                    <a href="#" class="footer-link">Refund Policy</a>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 mb-4 mb-lg-0">
                <h5 class="fw-bold mb-3">Support</h5>
                <div class="d-flex flex-column gap-2">
                    <a href="#" class="footer-link">Help Center</a>
                    <a href="#" class="footer-link">FAQs</a>
                    <a href="#" class="footer-link">Terms</a>
                    <a href="#" class="footer-link">Privacy</a>
                </div>
            </div>
            <div class="col-lg-2 col-md-3">
                <h5 class="fw-bold mb-3">Contact</h5>
                <div class="d-flex flex-column gap-2">
                    <p class="footer-link mb-0"><i class="fas fa-phone me-2"></i> +63 123 456 7890</p>
                    <p class="footer-link mb-0"><i class="fas fa-envelope me-2"></i> info@moveon.ph</p>
                    <p class="footer-link mb-0"><i class="fas fa-map-marker-alt me-2"></i> Manila, Philippines</p>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p class="mb-0">&copy; {{ date('Y') }} <a href="{{ route('home') }}">MoveON</a>. All rights reserved. | Built with ❤️ for Filipino travelers</p>
        </div>
    </div>
</footer>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

@stack('scripts')
</body>
</html>
