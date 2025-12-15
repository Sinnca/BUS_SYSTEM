{{-- ============================================================ --}}
{{-- FILE: resources/views/layouts/admin.blade.php --}}
{{-- MODERN DARK ADMIN DASHBOARD (MoveON Style) --}}
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
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0b1220, #0e1a2f);
            color: #e5e7eb;
            min-height: 100vh;
        }

        /* ================= NAVBAR ================= */
        .navbar {
            background: linear-gradient(90deg, #0f172a, #1e293b);
            box-shadow: 0 8px 30px rgba(0,0,0,.35);
        }

        .navbar-brand {
            font-weight: 700;
            letter-spacing: .5px;
        }

        .nav-link {
            color: #cbd5f5 !important;
            padding: 8px 16px;
            border-radius: 12px;
            transition: all .3s ease;
        }

        .nav-link:hover {
            background: rgba(99,102,241,.15);
            color: #fff !important;
        }

        .nav-link.active {
            background: linear-gradient(135deg, #6366f1, #4f46e5);
            color: #fff !important;
            box-shadow: 0 6px 20px rgba(99,102,241,.45);
        }

        /* ================= CARDS ================= */
        .card {
            background: rgba(255,255,255,0.04);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 18px;
            box-shadow: 0 20px 40px rgba(0,0,0,.35);
            margin-bottom: 24px;
        }

        .card-header {
            background: transparent;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            font-weight: 600;
            padding: 18px 22px;
            color: #fff;
        }

        .card-body {
            padding: 22px;
        }

        /* ================= STAT CARDS ================= */
        .stat-card {
            transition: transform .3s ease, box-shadow .3s ease;
        }

        .stat-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 25px 50px rgba(99,102,241,.35);
        }

        .stat-card h2 {
            font-size: 2.6rem;
            font-weight: 700;
        }

        /* ================= TABLE ================= */
        .table {
            color: #e5e7eb;
        }

        .table thead th {
            color: #c7d2fe;
            border-bottom: 1px solid rgba(255,255,255,.1);
        }

        .table td {
            border-color: rgba(255,255,255,.05);
        }

        /* ================= ALERTS ================= */
        .alert {
            border-radius: 14px;
            border: none;
            backdrop-filter: blur(10px);
        }

        .alert-success {
            background: rgba(34,197,94,.15);
            color: #bbf7d0;
        }

        .alert-danger {
            background: rgba(239,68,68,.15);
            color: #fecaca;
        }

        /* ================= FOOTER ================= */
        footer {
            color: #94a3b8;
        }
    </style>

    @stack('styles')
</head>

<body>

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
