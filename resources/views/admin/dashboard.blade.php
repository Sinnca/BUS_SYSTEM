@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap');

    .dashboard-container {
        font-family: 'Inter', sans-serif;
        animation: fadeIn 0.6s ease-out;
    }

    /* Page Header */
    .dashboard-header {
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.05) 0%, rgba(139, 92, 246, 0.05) 100%);
        border-radius: 24px;
        padding: 35px 40px;
        margin-bottom: 30px;
        border: 2px solid rgba(99, 102, 241, 0.1);
        position: relative;
        overflow: hidden;
        animation: fadeInDown 0.6s ease-out;
    }

    .dashboard-header::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(139, 92, 246, 0.15) 0%, transparent 70%);
        animation: rotate 20s linear infinite;
    }

    .dashboard-header-content {
        position: relative;
        z-index: 1;
    }

    .dashboard-badge {
        display: inline-block;
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        color: white;
        padding: 6px 16px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        margin-bottom: 12px;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .dashboard-title {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 2.5rem;
        font-weight: 800;
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 8px;
        letter-spacing: -1px;
    }

    .dashboard-subtitle {
        color: #64748b;
        font-size: 1rem;
        font-weight: 500;
    }

    /* Stats Cards */
    .stat-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 8px 30px rgba(99, 102, 241, 0.1);
        border: 2px solid rgba(99, 102, 241, 0.1);
        transition: all 0.3s ease;
        overflow: hidden;
        position: relative;
        animation: fadeInUp 0.6s ease-out both;
    }

    .stat-card:nth-child(1) { animation-delay: 0.1s; }
    .stat-card:nth-child(2) { animation-delay: 0.2s; }
    .stat-card:nth-child(3) { animation-delay: 0.3s; }
    .stat-card:nth-child(4) { animation-delay: 0.4s; }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
    }

    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 45px rgba(99, 102, 241, 0.2);
        border-color: rgba(99, 102, 241, 0.2);
    }

    .stat-card-body {
        padding: 25px;
    }

    .stat-label {
        color: #64748b;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        margin-bottom: 12px;
        font-family: 'Space Grotesk', sans-serif;
    }

    .stat-value {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 2.5rem;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 8px;
        line-height: 1;
    }

    .stat-subtitle {
        font-size: 0.9rem;
        font-weight: 600;
        margin: 0;
    }

    .stat-subtitle.success {
        color: #10b981;
    }

    .stat-subtitle.muted {
        color: #64748b;
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
        color: white;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
    }

    .stat-icon.primary {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
    }

    .stat-icon.success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    }

    .stat-icon.info {
        background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
    }

    .stat-icon.warning {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    }

    /* Recent Reservations Card */
    .reservations-card {
        background: white;
        border-radius: 24px;
        box-shadow: 0 10px 40px rgba(99, 102, 241, 0.08);
        border: 2px solid rgba(99, 102, 241, 0.1);
        overflow: hidden;
        animation: fadeInUp 0.6s ease-out 0.5s both;
        position: relative;
    }

    .reservations-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
    }

    .reservations-header {
        padding: 25px 30px;
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.02) 0%, rgba(139, 92, 246, 0.02) 100%);
        border-bottom: 2px solid rgba(99, 102, 241, 0.1);
    }

    .reservations-header h5 {
        font-family: 'Space Grotesk', sans-serif;
        font-weight: 800;
        font-size: 1.3rem;
        color: #1e293b;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .reservations-table {
        width: 100%;
        margin: 0;
    }

    .reservations-table thead {
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.05) 0%, rgba(139, 92, 246, 0.05) 100%);
    }

    .reservations-table thead th {
        font-family: 'Space Grotesk', sans-serif;
        font-weight: 700;
        font-size: 0.85rem;
        color: #475569;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 18px 25px;
        border: none;
        white-space: nowrap;
    }

    .reservations-table tbody tr {
        border-bottom: 1px solid #f1f5f9;
        transition: all 0.3s ease;
    }

    .reservations-table tbody tr:hover {
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.02) 0%, rgba(139, 92, 246, 0.02) 100%);
    }

    .reservations-table tbody td {
        padding: 20px 25px;
        vertical-align: middle;
        font-size: 0.95rem;
        color: #334155;
        font-weight: 500;
    }

    .reservation-code {
        font-family: 'Space Grotesk', sans-serif;
        font-weight: 800;
        font-size: 1rem;
        color: #6366f1;
    }

    .trip-route {
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 600;
    }

    .route-arrow {
        color: #8b5cf6;
        font-size: 0.85rem;
    }

    .amount-display {
        font-family: 'Space Grotesk', sans-serif;
        font-weight: 700;
        font-size: 1rem;
        color: #1e293b;
    }

    .status-badge {
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 700;
        letter-spacing: 0.3px;
        text-transform: uppercase;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .status-badge.confirmed {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
    }

    .status-badge.cancelled {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
    }

    .empty-state {
        padding: 80px 40px;
        text-align: center;
    }

    .empty-icon {
        width: 100px;
        height: 100px;
        margin: 0 auto 25px;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, rgba(139, 92, 246, 0.1) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        color: #8b5cf6;
    }

    .empty-title {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 1.3rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 8px;
    }

    .empty-text {
        color: #64748b;
        font-size: 0.95rem;
    }

    /* Animations */
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }

    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .dashboard-title {
            font-size: 2rem;
        }

        .stat-value {
            font-size: 2rem;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            font-size: 1.3rem;
        }

        .reservations-table {
            font-size: 0.85rem;
        }
    }
</style>

<div class="dashboard-container">
    <!-- Page Header -->
    <div class="dashboard-header">
        <div class="dashboard-header-content">
            <span class="dashboard-badge">
                <i class="fas fa-chart-line"></i> System Overview
            </span>
            <h1 class="dashboard-title">Dashboard</h1>
            <p class="dashboard-subtitle">Monitor your system performance and activity</p>
        </div>
    </div>

    <!-- KPI / Statistics Cards -->
    <div class="row g-4 mb-4">

        <!-- Total Buses -->
        <div class="col-xl-3 col-md-6">
            <div class="stat-card h-100">
                <div class="stat-card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <div class="stat-label">Total Buses</div>
                            <div class="stat-value">{{ $stats['total_buses'] }}</div>
                            <p class="stat-subtitle success">
                                <i class="fas fa-check-circle"></i>
                                {{ $stats['active_buses'] }} active
                            </p>
                        </div>
                        <div class="stat-icon primary">
                            <i class="fas fa-bus"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Upcoming Trips -->
        <div class="col-xl-3 col-md-6">
            <div class="stat-card h-100">
                <div class="stat-card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <div class="stat-label">Upcoming Trips</div>
                            <div class="stat-value">{{ $stats['upcoming_trips'] }}</div>
                            <p class="stat-subtitle muted">
                                of {{ $stats['total_trips'] }} total
                            </p>
                        </div>
                        <div class="stat-icon success">
                            <i class="fas fa-route"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reservations -->
        <div class="col-xl-3 col-md-6">
            <div class="stat-card h-100">
                <div class="stat-card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <div class="stat-label">Reservations</div>
                            <div class="stat-value">{{ $stats['total_reservations'] }}</div>
                            <p class="stat-subtitle success">
                                <i class="fas fa-check-circle"></i>
                                {{ $stats['confirmed_reservations'] }} confirmed
                            </p>
                        </div>
                        <div class="stat-icon info">
                            <i class="fas fa-ticket-alt"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Revenue -->
        <div class="col-xl-3 col-md-6">
            <div class="stat-card h-100">
                <div class="stat-card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <div class="stat-label">Total Revenue</div>
                            <div class="stat-value">₱{{ number_format($stats['revenue'], 0) }}</div>
                            <p class="stat-subtitle muted">
                                {{ $stats['total_users'] }} users
                            </p>
                        </div>
                        <div class="stat-icon warning">
                            <i class="fas fa-coins"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Recent Reservations -->
    <div class="reservations-card">
        <div class="reservations-header">
            <h5>
                <i class="fas fa-clock"></i>
                Recent Reservations
            </h5>
        </div>

        <div class="table-responsive">
            <table class="reservations-table">
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
                        <td>
                            <span class="reservation-code">
                                {{ $reservation->reservation_code }}
                            </span>
                        </td>
                        <td>{{ $reservation->user->name }}</td>
                        <td>
                            <div class="trip-route">
                                <span>{{ $reservation->trip->origin }}</span>
                                <i class="fas fa-arrow-right route-arrow"></i>
                                <span>{{ $reservation->trip->destination }}</span>
                            </div>
                        </td>
                        <td>{{ $reservation->trip->formatted_date }}</td>
                        <td>
                            <span style="font-weight: 600;">
                                <i class="fas fa-users" style="color: #8b5cf6; margin-right: 4px;"></i>
                                {{ $reservation->total_passengers }}
                            </span>
                        </td>
                        <td>
                            <span class="amount-display">
                                {{ $reservation->formatted_total_price }}
                            </span>
                        </td>
                        <td>
                            <span class="status-badge {{ $reservation->status === 'confirmed' ? 'confirmed' : 'cancelled' }}">
                                @if($reservation->status === 'confirmed')
                                    <i class="fas fa-check-circle"></i>
                                @else
                                    <i class="fas fa-times-circle"></i>
                                @endif
                                {{ ucfirst($reservation->status) }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <i class="fas fa-ticket-alt"></i>
                                </div>
                                <h3 class="empty-title">No Reservations Yet</h3>
                                <p class="empty-text">Reservations will appear here once customers start booking</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection