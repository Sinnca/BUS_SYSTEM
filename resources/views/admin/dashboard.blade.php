@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<style>
    body {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%) !important;
    }

    .page-header-light {
        background: linear-gradient(135deg, #faf5ff 0%, #f3e8ff 100%);
        padding: 2rem;
        border-radius: 16px;
        margin-bottom: 2rem;
        border: 1px solid rgba(139, 92, 246, 0.15);
        box-shadow: 0 4px 20px rgba(99, 102, 241, 0.08);
    }

    .page-header-light h1 {
        color: #6366f1;
        font-weight: 900;
        margin-bottom: 0.5rem;
    }

    .page-header-light p {
        color: #64748b;
        margin: 0;
    }

    .stat-card {
        background: white !important;
        border: 1px solid rgba(99, 102, 241, 0.1) !important;
        border-radius: 16px !important;
        box-shadow: 0 4px 20px rgba(99, 102, 241, 0.08) !important;
        transition: all 0.3s ease !important;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(99, 102, 241, 0.15) !important;
    }

    .stat-card .card-body {
        padding: 1.5rem;
    }

    .stat-card small {
        color: #64748b;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
    }

    .stat-card h2 {
        color: #6366f1;
        font-weight: 900;
        font-size: 2rem;
    }

    .stat-card .text-success {
        color: #10b981 !important;
        font-weight: 600;
    }

    .stat-card .text-muted {
        color: #64748b !important;
    }

    .icon-shape {
        width: 56px;
        height: 56px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px !important;
        font-size: 1.5rem;
    }

    .bg-primary {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%) !important;
    }

    .bg-success {
        background: linear-gradient(135deg, #10b981 0%, #34d399 100%) !important;
    }

    .bg-info {
        background: linear-gradient(135deg, #06b6d4 0%, #22d3ee 100%) !important;
    }

    .bg-warning {
        background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%) !important;
    }

    .card {
        background: white !important;
        border: 1px solid rgba(99, 102, 241, 0.1) !important;
        border-radius: 16px !important;
        box-shadow: 0 4px 20px rgba(99, 102, 241, 0.08) !important;
    }

    .card-header {
        background: linear-gradient(135deg, #faf5ff 0%, #f3e8ff 100%) !important;
        border-bottom: 1px solid rgba(139, 92, 246, 0.15) !important;
        padding: 1.25rem 1.5rem !important;
        border-radius: 16px 16px 0 0 !important;
    }

    .card-header h5 {
        color: #6366f1 !important;
        font-weight: 700 !important;
        margin: 0 !important;
    }

    .table {
        margin: 0 !important;
    }

    .table thead {
        background: linear-gradient(135deg, #faf5ff 0%, #f8f9fa 100%);
    }

    .table thead th {
        color: #6366f1 !important;
        font-weight: 700 !important;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        padding: 1rem 1.5rem !important;
        border: none !important;
    }

    .table tbody td {
        color: #64748b !important;
        padding: 1rem 1.5rem !important;
        border-bottom: 1px solid rgba(99, 102, 241, 0.08) !important;
    }

    .table tbody tr:hover {
        background: rgba(99, 102, 241, 0.03) !important;
    }

    .table tbody tr:last-child td {
        border-bottom: none !important;
    }

    .table .fw-semibold {
        color: #6366f1 !important;
        font-weight: 700 !important;
    }

    .table .text-muted {
        color: #94a3b8 !important;
    }

    .badge {
        padding: 0.5rem 1rem !important;
        font-weight: 600 !important;
        font-size: 0.75rem !important;
        letter-spacing: 0.3px;
    }

    .bg-success {
        background: linear-gradient(135deg, #10b981 0%, #34d399 100%) !important;
    }

    .bg-danger {
        background: linear-gradient(135deg, #ef4444 0%, #f87171 100%) !important;
    }

    .text-center.text-muted {
        color: #64748b !important;
        font-weight: 500;
    }

    @media (max-width: 768px) {
        .stat-card h2 {
            font-size: 1.5rem;
        }

        .icon-shape {
            width: 48px;
            height: 48px;
            font-size: 1.25rem;
        }
    }
</style>

    <!-- Page Header -->
    <div class="page-header-light">
        <div>
            <h1 class="h3 fw-bold mb-1">Dashboard</h1>
            <p class="text-muted mb-0">
                Overview of system performance and activity
            </p>
        </div>
    </div>

    <!-- KPI / Statistics Cards -->
    <div class="row g-4 mb-4">

        <!-- Total Buses -->
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <small class="text-muted">Total Buses</small>
                            <h2 class="fw-bold mt-2 mb-0">
                                {{ $stats['total_buses'] }}
                            </h2>
                            <span class="text-success small">
                                {{ $stats['active_buses'] }} active
                            </span>
                        </div>
                        <div class="icon-shape bg-primary text-white rounded-3 p-3">
                            <i class="fas fa-bus"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Upcoming Trips -->
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <small class="text-muted">Upcoming Trips</small>
                            <h2 class="fw-bold mt-2 mb-0">
                                {{ $stats['upcoming_trips'] }}
                            </h2>
                            <span class="text-muted small">
                                of {{ $stats['total_trips'] }} total
                            </span>
                        </div>
                        <div class="icon-shape bg-success text-white rounded-3 p-3">
                            <i class="fas fa-route"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reservations -->
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <small class="text-muted">Reservations</small>
                            <h2 class="fw-bold mt-2 mb-0">
                                {{ $stats['total_reservations'] }}
                            </h2>
                            <span class="text-success small">
                                {{ $stats['confirmed_reservations'] }} confirmed
                            </span>
                        </div>
                        <div class="icon-shape bg-info text-white rounded-3 p-3">
                            <i class="fas fa-ticket-alt"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Revenue -->
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <small class="text-muted">Total Revenue</small>
                            <h2 class="fw-bold mt-2 mb-0">
                                ₱{{ number_format($stats['revenue'], 2) }}
                            </h2>
                            <span class="text-muted small">
                                {{ $stats['total_users'] }} users
                            </span>
                        </div>
                        <div class="icon-shape bg-warning text-white rounded-3 p-3">
                            <i class="fas fa-coins"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Recent Reservations -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-semibold">Recent Reservations</h5>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>User</th>
                            <th>Trip</th>
                            <th>Date</th>
                            <th>Passengers</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($recent_reservations as $reservation)
                        <tr>
                            <td class="fw-semibold">
                                {{ $reservation->reservation_code }}
                            </td>
                            <td>{{ $reservation->user->name }}</td>
                            <td>
                                {{ $reservation->trip->origin }}
                                <i class="fas fa-arrow-right mx-1 text-muted"></i>
                                {{ $reservation->trip->destination }}
                            </td>
                            <td>{{ $reservation->trip->formatted_date }}</td>
                            <td>{{ $reservation->total_passengers }}</td>
                            <td class="fw-semibold">
                                {{ $reservation->formatted_total_price }}
                            </td>
                            <td>
                                <span class="badge rounded-pill
                                    bg-{{ $reservation->status === 'confirmed' ? 'success' : 'danger' }}">
                                    {{ ucfirst($reservation->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                No reservations yet
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection