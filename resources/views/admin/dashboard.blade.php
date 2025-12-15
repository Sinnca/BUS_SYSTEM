@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
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
