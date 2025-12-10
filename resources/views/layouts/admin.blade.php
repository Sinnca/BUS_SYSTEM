{{-- ============================================================ --}}
{{-- FILE: resources/views/layouts/admin.blade.php --}}
{{-- COMPLETE - Replace your entire file with this --}}
{{-- ============================================================ --}}
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - Bus Reservation</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- Custom Admin Styles --}}
    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,.1);
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #fff;
            border-bottom: 2px solid #f0f0f0;
            font-weight: 600;
            padding: 15px 20px;
        }

        .card-body {
            padding: 20px;
        }

        .stat-card {
            transition: transform 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-card h2 {
            font-size: 2.5rem;
            font-weight: bold;
            margin: 10px 0;
        }

        .stat-card small {
            opacity: 0.9;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            border-top: none;
            font-weight: 600;
            color: #495057;
        }

        .badge {
            padding: 5px 10px;
            font-weight: 500;
        }

        .nav-link.active {
            font-weight: bold;
        }

        .alert {
            border-radius: 10px;
            border: none;
        }
    </style>

    @stack('styles')
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-bus"></i> Bus Admin
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                       href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.buses.*') ? 'active' : '' }}"
                       href="{{ route('admin.buses.index') }}">
                        <i class="fas fa-bus"></i> Buses
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.trips.*') ? 'active' : '' }}"
                       href="{{ route('admin.trips.index') }}">
                        <i class="fas fa-route"></i> Trips
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.reservations.*') ? 'active' : '' }}"
                       href="{{ route('admin.reservations.index') }}">
                        <i class="fas fa-ticket-alt"></i> Reservations
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.schedules.generator') }}" class="nav-link">
                        <i class="fas fa-magic"></i>
                        <span>Auto Schedule Generator</span>
                    </a>
                </li>
            </ul>
            <div class="d-flex align-items-center">
                    <span class="navbar-text text-white me-3">
                        <i class="fas fa-user-shield"></i> {{ auth()->user()->name }}
                    </span>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="container-fluid mt-4 mb-4">
    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Error Message --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-exclamation-triangle"></i> <strong>Validation Error!</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Page Content --}}
    @yield('content')
</div>

{{-- Footer --}}
<footer class="bg-light text-center py-3 mt-5 border-top">
    <div class="container">
        <p class="text-muted mb-0">
            <small>&copy; {{ date('Y') }} Bus Reservation System. Admin Panel.</small>
        </p>
    </div>
</footer>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

{{-- jQuery (optional, for convenience) --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

{{-- Custom Scripts --}}
<script>
    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        var alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            var bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);

    // Confirm before delete
    document.querySelectorAll('form[method="POST"]').forEach(function(form) {
        if (form.querySelector('input[name="_method"][value="DELETE"]')) {
            form.addEventListener('submit', function(e) {
                if (!confirm('Are you sure you want to delete this item?')) {
                    e.preventDefault();
                }
            });
        }
    });
</script>

@stack('scripts')
</body>
</html>
