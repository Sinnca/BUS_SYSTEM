{{-- ============================================================ --}}
{{-- FILE: resources/views/layouts/admin.blade.php --}}
{{-- MODERN LIGHT ADMIN DASHBOARD (MoveON Style) --}}
{{-- ============================================================ --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Dashboard') - MoveON</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* ================= STICKY FOOTER LAYOUT ================= */
        html, body {
            height: 100%;
            margin: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #ffffff, #f8f9fa, #faf5ff);
            color: #64748b;
            display: flex;
            flex-direction: column;
        }

        .main-wrapper {
            flex: 1 0 auto;
            display: flex;
            flex-direction: column;
        }

        .content-container {
            flex: 1 0 auto;
        }

        footer {
            flex-shrink: 0;
        }

        /* ================= NAVBAR ================= */
        .navbar {
            background: linear-gradient(90deg, #0f172a, #1e293b);
            box-shadow: 0 8px 30px rgba(99, 102, 241, 0.2);
            border-bottom: 2px solid rgba(99, 102, 241, 0.3);
        }

        .navbar-brand {
            font-weight: 700;
            letter-spacing: .5px;
            text-shadow: 0 2px 10px rgba(99, 102, 241, 0.5);
        }

        .nav-link {
            color: #cbd5f5 !important;
            padding: 8px 16px;
            border-radius: 12px;
            transition: all .3s ease;
            position: relative;
        }

        .nav-link:hover {
            background: rgba(99,102,241,.15);
            color: #fff !important;
            transform: translateY(-2px);
        }

        .nav-link.active {
            background: linear-gradient(135deg, #6366f1, #4f46e5);
            color: #fff !important;
            box-shadow: 0 6px 20px rgba(99,102,241,.45);
        }

        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            transform: translateX(-50%);
            width: 40%;
            height: 3px;
            background: linear-gradient(90deg, #6366f1, #8b5cf6);
            border-radius: 3px;
        }

        /* ================= CARDS ================= */
        .card {
            background: #ffffff;
            backdrop-filter: blur(12px);
            border: 1px solid rgba(99, 102, 241, 0.12);
            border-radius: 18px;
            box-shadow: 0 10px 40px rgba(99, 102, 241, 0.1);
            margin-bottom: 24px;
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 15px 50px rgba(99, 102, 241, 0.15);
        }

        .card-header {
            background: linear-gradient(135deg, #faf5ff, #f3e8ff);
            border-bottom: 1px solid rgba(99, 102, 241, 0.15);
            font-weight: 600;
            padding: 18px 22px;
            color: #6366f1;
            border-radius: 18px 18px 0 0;
        }

        .card-body {
            padding: 22px;
            color: #64748b;
        }

        /* ================= STAT CARDS ================= */
        .stat-card {
            transition: transform .3s ease, box-shadow .3s ease;
            background: linear-gradient(135deg, #ffffff, #faf5ff);
        }

        .stat-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 60px rgba(99, 102, 241, 0.2);
            border-color: rgba(99, 102, 241, 0.25);
        }

        .stat-card h2 {
            font-size: 2.6rem;
            font-weight: 700;
            color: #6366f1;
        }

        .stat-card small {
            color: #64748b;
            font-weight: 600;
        }

        /* ================= TABLE ================= */
        .table {
            color: #64748b;
        }

        .table thead {
            background: linear-gradient(135deg, #faf5ff, #f8f9fa);
        }

        .table thead th {
            color: #6366f1;
            border-bottom: 2px solid rgba(99, 102, 241, 0.15);
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
        }

        .table td {
            border-color: rgba(99, 102, 241, 0.08);
        }

        .table tbody tr {
            transition: all 0.2s ease;
        }

        .table tbody tr:hover {
            background: rgba(99, 102, 241, 0.04);
            transform: scale(1.01);
        }

        .table .fw-semibold {
            color: #6366f1;
        }

        /* ================= ALERTS ================= */
        .alert {
            border-radius: 14px;
            border: none;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(99, 102, 241, 0.1);
        }

        .alert-success {
            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
            color: #065f46;
            border-left: 4px solid #10b981;
        }

        .alert-danger {
            background: linear-gradient(135deg, #fee2e2, #fecaca);
            color: #991b1b;
            border-left: 4px solid #ef4444;
        }

        .alert i {
            font-size: 1.2rem;
            margin-right: 0.5rem;
        }

        /* ================= FOOTER ================= */
        footer {
            background: linear-gradient(135deg, #faf5ff, #f3e8ff);
            color: #6366f1;
            border-top: 1px solid rgba(99, 102, 241, 0.15);
            box-shadow: 0 -4px 20px rgba(99, 102, 241, 0.08);
            margin-top: auto;
        }

        footer small {
            color: #64748b;
            font-weight: 500;
        }

        /* ================= BUTTONS ================= */
        .btn-outline-light {
            border-color: rgba(255, 255, 255, 0.7);
            color: #fff;
            transition: all 0.3s ease;
        }

        .btn-outline-light:hover {
            background: rgba(255, 255, 255, 0.15);
            border-color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(255, 255, 255, 0.2);
        }

        /* ================= CONTENT WRAPPER ================= */
        .content-wrapper {
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2rem;
            margin: 1.5rem 0;
            border: 1px solid rgba(99, 102, 241, 0.1);
        }

        /* ================= HEADINGS ================= */
        h1, h2, h3, h4, h5, h6 {
            color: #6366f1;
        }

        /* ================= BADGES ================= */
        .badge {
            font-weight: 600;
            padding: 0.5rem 1rem;
            border-radius: 8px;
        }

        .bg-success {
            background: linear-gradient(135deg, #10b981, #34d399) !important;
        }

        .bg-danger {
            background: linear-gradient(135deg, #ef4444, #f87171) !important;
        }

        .bg-warning {
            background: linear-gradient(135deg, #f59e0b, #fbbf24) !important;
        }

        .bg-info {
            background: linear-gradient(135deg, #06b6d4, #22d3ee) !important;
        }

        .bg-primary {
            background: linear-gradient(135deg, #6366f1, #8b5cf6) !important;
        }

        /* ================= ICON SHAPES ================= */
        .icon-shape {
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
        }

        /* ================= TEXT COLORS ================= */
        .text-primary {
            color: #6366f1 !important;
        }

        .text-muted {
            color: #64748b !important;
        }

        .text-light {
            color: #f8f9fa !important;
        }

        /* ================= ANIMATIONS ================= */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert {
            animation: fadeIn 0.5s ease;
        }
    </style>

    @stack('styles')
</head>

<body>

<div class="main-wrapper">
    {{-- ================= NAVBAR ================= --}}
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid px-4">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-bus text-primary me-1"></i> MoveON Admin
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="adminNav">
                <ul class="navbar-nav me-auto gap-2">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                           href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-chart-line me-1"></i> Dashboard
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.buses.*') ? 'active' : '' }}"
                           href="{{ route('admin.buses.index') }}">
                            <i class="fas fa-bus me-1"></i> Buses
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.trips.*') ? 'active' : '' }}"
                           href="{{ route('admin.trips.index') }}">
                            <i class="fas fa-route me-1"></i> Trips
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.reservations.*') ? 'active' : '' }}"
                           href="{{ route('admin.reservations.index') }}">
                            <i class="fas fa-ticket me-1"></i> Reservations
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.schedules.*') ? 'active' : '' }}"
                           href="{{ route('admin.schedules.generator') }}">
                            <i class="fas fa-wand-magic-sparkles me-1"></i> Auto Schedule
                        </a>
                    </li>
                </ul>

                <div class="d-flex align-items-center gap-3">
                    <span class="text-light small">
                        <i class="fas fa-user-shield me-1"></i> {{ auth()->user()->name }}
                    </span>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-outline-light btn-sm rounded-pill px-3">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    {{-- ================= CONTENT ================= --}}
    <div class="content-container">
        <div class="container-fluid px-4 py-4">

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    <i class="fas fa-triangle-exclamation me-1"></i> {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <strong>Validation Error</strong>
                    <ul class="mt-2 mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</div>

{{-- ================= FOOTER ================= --}}
<footer class="text-center py-4">
    <small>&copy; {{ date('Y') }} MoveON Bus Reservation System — Admin Panel</small>
</footer>

{{-- Scripts --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(alert => {
            alert.classList.add('fade');
            setTimeout(() => alert.remove(), 500);
        });
    }, 5000);
</script>

@stack('scripts')
</body>
</html>