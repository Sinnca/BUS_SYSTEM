@extends('layouts.app')

@section('title', 'My Dashboard')

@push('styles')
<style>
    /* Dashboard Container */
    .dashboard-container {
        margin-top: 2rem;
        margin-bottom: 3rem;
    }

    /* Welcome Header */
    .dashboard-header {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border: 1px solid rgba(139, 92, 246, 0.2);
        border-radius: 20px;
        padding: 2.5rem;
        margin-bottom: 2.5rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        position: relative;
        overflow: hidden;
    }

    .dashboard-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #6366f1, #8b5cf6, #a855f7);
    }

    .dashboard-header h1 {
        color: #ffffff;
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
        letter-spacing: -0.5px;
    }

    .dashboard-header p {
        color: rgba(255, 255, 255, 0.7);
        font-size: 1.1rem;
        margin: 0;
    }

    /* Stats Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2.5rem;
    }

    .stat-card {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border: 1px solid rgba(139, 92, 246, 0.2);
        border-radius: 16px;
        padding: 2rem;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        transition: opacity 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
    }

    .stat-card.primary::before {
        background: linear-gradient(90deg, #6366f1, #8b5cf6);
    }

    .stat-card.success::before {
        background: linear-gradient(90deg, #10b981, #059669);
    }

    .stat-card.info::before {
        background: linear-gradient(90deg, #0ea5e9, #0284c7);
    }

    .stat-card-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }

    .stat-card.primary .stat-card-icon {
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.2) 0%, rgba(139, 92, 246, 0.2) 100%);
        color: #8b5cf6;
    }

    .stat-card.success .stat-card-icon {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.2) 0%, rgba(5, 150, 105, 0.2) 100%);
        color: #10b981;
    }

    .stat-card.info .stat-card-icon {
        background: linear-gradient(135deg, rgba(14, 165, 233, 0.2) 0%, rgba(2, 132, 199, 0.2) 100%);
        color: #0ea5e9;
    }

    .stat-card-title {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.95rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
        font-weight: 600;
    }

    .stat-card-value {
        color: #ffffff;
        font-size: 2.5rem;
        font-weight: 800;
        letter-spacing: -1px;
    }

    /* Section Cards */
    .section-card {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border: 1px solid rgba(139, 92, 246, 0.2);
        border-radius: 20px;
        margin-bottom: 2.5rem;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    }

    .section-card-header {
        padding: 1.5rem 2rem;
        border-bottom: 1px solid rgba(139, 92, 246, 0.2);
    }

    .section-card-header.primary {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
    }

    .section-card-header.secondary {
        background: linear-gradient(135deg, #64748b 0%, #475569 100%);
    }

    .section-card-header h5 {
        color: white;
        font-weight: 700;
        font-size: 1.2rem;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-card-body {
        padding: 2rem;
    }

    /* Trip Cards */
    .trip-card {
        background: rgba(99, 102, 241, 0.08);
        border: 1px solid rgba(139, 92, 246, 0.2);
        border-radius: 16px;
        padding: 1.8rem;
        margin-bottom: 1.5rem;
        transition: all 0.3s ease;
    }

    .trip-card:hover {
        background: rgba(99, 102, 241, 0.12);
        transform: translateX(5px);
        border-color: rgba(139, 92, 246, 0.4);
    }

    .trip-card:last-child {
        margin-bottom: 0;
    }

    .trip-date-box {
        text-align: center;
        padding: 1rem;
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.15) 0%, rgba(139, 92, 246, 0.1) 100%);
        border: 1px solid rgba(139, 92, 246, 0.3);
        border-radius: 12px;
    }

    .trip-date-day {
        color: #ffffff;
        font-size: 2rem;
        font-weight: 800;
        line-height: 1;
        margin-bottom: 0.3rem;
    }

    .trip-date-month {
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .trip-info {
        color: #ffffff;
    }

    .trip-route {
        font-size: 1.2rem;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 0.8rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .trip-route i {
        color: #a855f7;
        font-size: 1rem;
    }

    .trip-details {
        color: rgba(255, 255, 255, 0.8);
        margin-bottom: 0.8rem;
        display: flex;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
    }

    .trip-details i {
        color: #a855f7;
        margin-right: 5px;
    }

    .trip-badges {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .trip-badge {
        padding: 0.4rem 0.9rem;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 700;
    }

    .trip-badge.primary {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        color: white;
    }

    .trip-badge.info {
        background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
        color: white;
    }

    .trip-passengers {
        text-align: center;
        padding: 1rem;
        background: rgba(99, 102, 241, 0.08);
        border-radius: 12px;
    }

    .trip-passengers-label {
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.3rem;
    }

    .trip-passengers-count {
        color: #ffffff;
        font-size: 1.8rem;
        font-weight: 800;
    }

    .trip-action {
        display: flex;
        align-items: center;
        justify-content: flex-end;
    }

    .btn-view-details {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        color: white;
        border: none;
        padding: 0.7rem 1.5rem;
        border-radius: 10px;
        font-weight: 700;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
        text-decoration: none;
        display: inline-block;
    }

    .btn-view-details:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(99, 102, 241, 0.6);
        background: linear-gradient(135deg, #7c3aed 0%, #a855f7 100%);
        color: white;
    }

    /* Past Trip Cards (Compact) */
    .past-trip-card {
        background: rgba(99, 102, 241, 0.05);
        border: 1px solid rgba(139, 92, 246, 0.15);
        border-radius: 12px;
        padding: 1.2rem 1.5rem;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
    }

    .past-trip-card:hover {
        background: rgba(99, 102, 241, 0.1);
        border-color: rgba(139, 92, 246, 0.3);
    }

    .past-trip-card:last-child {
        margin-bottom: 0;
    }

    .past-trip-info {
        color: #ffffff;
        font-weight: 600;
    }

    .past-trip-meta {
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.9rem;
        margin-left: 10px;
    }

    .badge-completed {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        padding: 0.4rem 0.9rem;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.85rem;
    }

    .btn-view-all {
        background: rgba(100, 116, 139, 0.2);
        color: white;
        border: 1px solid rgba(100, 116, 139, 0.3);
        padding: 0.6rem 1.3rem;
        border-radius: 10px;
        font-weight: 700;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .btn-view-all:hover {
        background: rgba(100, 116, 139, 0.3);
        color: white;
        border-color: rgba(100, 116, 139, 0.5);
        transform: translateY(-2px);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 3rem 2rem;
        background: rgba(99, 102, 241, 0.05);
        border: 2px dashed rgba(139, 92, 246, 0.2);
        border-radius: 16px;
    }

    .empty-state-icon {
        font-size: 3.5rem;
        color: rgba(139, 92, 246, 0.3);
        margin-bottom: 1.5rem;
    }

    .empty-state-text {
        color: rgba(255, 255, 255, 0.8);
        font-size: 1.1rem;
        margin-bottom: 1.5rem;
    }

    .empty-state-link {
        color: #a855f7;
        font-weight: 700;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .empty-state-link:hover {
        color: #c084fc;
        text-decoration: underline;
    }

    /* Quick Actions */
    .quick-actions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-top: 2.5rem;
    }

    .action-card {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border: 1px solid rgba(139, 92, 246, 0.2);
        border-radius: 16px;
        padding: 2.5rem 2rem;
        text-align: center;
        transition: all 0.3s ease;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        height: 100%;
    }

    .action-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.5);
        border-color: rgba(139, 92, 246, 0.4);
    }

    .action-card-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 1.5rem;
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.15) 0%, rgba(139, 92, 246, 0.1) 100%);
        border: 1px solid rgba(139, 92, 246, 0.3);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        transition: all 0.3s ease;
    }

    .action-card:hover .action-card-icon {
        transform: scale(1.1);
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.25) 0%, rgba(139, 92, 246, 0.2) 100%);
    }

    .action-card-icon.primary {
        color: #8b5cf6;
    }

    .action-card-icon.success {
        color: #10b981;
    }

    .action-card-title {
        color: #ffffff;
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 0.8rem;
    }

    .action-card-description {
        color: rgba(255, 255, 255, 0.7);
        font-size: 1rem;
        margin-bottom: 1.5rem;
        line-height: 1.6;
    }

    .btn-action-primary {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        color: white;
        border: none;
        padding: 0.8rem 2rem;
        border-radius: 10px;
        font-weight: 700;
        font-size: 1rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
        text-decoration: none;
        display: inline-block;
    }

    .btn-action-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(99, 102, 241, 0.6);
        background: linear-gradient(135deg, #7c3aed 0%, #a855f7 100%);
        color: white;
    }

    .btn-action-success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        border: none;
        padding: 0.8rem 2rem;
        border-radius: 10px;
        font-weight: 700;
        font-size: 1rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
        text-decoration: none;
        display: inline-block;
    }

    .btn-action-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(16, 185, 129, 0.6);
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        color: white;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .dashboard-container {
            margin-top: 1.5rem;
        }

        .dashboard-header {
            padding: 1.8rem;
        }

        .dashboard-header h1 {
            font-size: 2rem;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .section-card-header {
            padding: 1.2rem 1.5rem;
        }

        .section-card-body {
            padding: 1.5rem;
        }

        .trip-card {
            padding: 1.5rem;
        }

        .trip-route {
            font-size: 1.1rem;
        }

        .action-card {
            padding: 2rem 1.5rem;
        }

        .quick-actions-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
    <div class="container dashboard-container">
        <!-- Welcome Header -->
        <div class="dashboard-header">
            <h1>Welcome, {{ auth()->user()->name }}!</h1>
            <p>Manage your bus reservations and track your journeys</p>
        </div>

        <!-- Quick Stats -->
        <div class="stats-grid">
            <div class="stat-card primary">
                <div class="stat-card-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="stat-card-title">Upcoming Trips</div>
                <div class="stat-card-value">{{ $upcomingReservations->count() }}</div>
            </div>
            <div class="stat-card success">
                <div class="stat-card-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-card-title">Past Trips</div>
                <div class="stat-card-value">{{ $pastReservations->count() }}</div>
            </div>
            <div class="stat-card info">
                <div class="stat-card-icon">
                    <i class="fas fa-peso-sign"></i>
                </div>
                <div class="stat-card-title">Total Spent</div>
                <div class="stat-card-value">₱{{ number_format(auth()->user()->reservations()->where('status', 'confirmed')->sum('total_price'), 2) }}</div>
            </div>
        </div>

        <!-- Upcoming Trips -->
        <div class="section-card">
            <div class="section-card-header primary">
                <h5>
                    <i class="fas fa-calendar-alt"></i> Upcoming Trips
                </h5>
            </div>
            <div class="section-card-body">
                @forelse($upcomingReservations as $reservation)
                    <div class="trip-card">
                        <div class="row align-items-center">
                            <div class="col-lg-2 col-md-3 mb-3 mb-md-0">
                                <div class="trip-date-box">
                                    <div class="trip-date-day">{{ $reservation->trip->departure_date->format('d') }}</div>
                                    <div class="trip-date-month">{{ $reservation->trip->departure_date->format('M Y') }}</div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-5 mb-3 mb-md-0">
                                <div class="trip-info">
                                    <div class="trip-route">
                                        {{ $reservation->trip->origin }} 
                                        <i class="fas fa-arrow-right"></i> 
                                        {{ $reservation->trip->destination }}
                                    </div>
                                    <div class="trip-details">
                                        <span>
                                            <i class="fas fa-clock"></i> 
                                            {{ $reservation->trip->formatted_time }}
                                        </span>
                                        <span>
                                            <i class="fas fa-bus"></i> 
                                            {{ $reservation->trip->bus->bus_number }}
                                        </span>
                                    </div>
                                    <div class="trip-badges">
                                        <span class="trip-badge primary">{{ $reservation->reservation_code }}</span>
                                        @if($reservation->is_round_trip)
                                            <span class="trip-badge info">Round Trip</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 mb-3 mb-md-0">
                                <div class="trip-passengers">
                                    <div class="trip-passengers-label">Passengers</div>
                                    <div class="trip-passengers-count">{{ $reservation->total_passengers }}</div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2">
                                <div class="trip-action">
                                    <a href="{{ route('my.bookings') }}" class="btn-view-details">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <i class="fas fa-calendar-times"></i>
                        </div>
                        <div class="empty-state-text">
                            You have no upcoming trips.
                            <a href="{{ route('home') }}" class="empty-state-link">Book a trip now!</a>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Past Trips -->
        @if($pastReservations->isNotEmpty())
            <div class="section-card">
                <div class="section-card-header secondary">
                    <h5>
                        <i class="fas fa-history"></i> Recent Past Trips
                    </h5>
                </div>
                <div class="section-card-body">
                    @foreach($pastReservations as $reservation)
                        <div class="past-trip-card">
                            <div class="row align-items-center">
                                <div class="col-md-8 mb-2 mb-md-0">
                                    <span class="past-trip-info">
                                        {{ $reservation->trip->origin }} → {{ $reservation->trip->destination }}
                                    </span>
                                    <span class="past-trip-meta">
                                        | {{ $reservation->trip->formatted_date }}
                                        | {{ $reservation->reservation_code }}
                                    </span>
                                </div>
                                <div class="col-md-4 text-md-end">
                                    <span class="badge-completed">Completed</span>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div style="margin-top: 1.5rem;">
                        <a href="{{ route('my.bookings') }}" class="btn-view-all">
                            <i class="fas fa-list"></i> View All Bookings
                        </a>
                    </div>
                </div>
            </div>
        @endif

        <!-- Quick Actions -->
        <div class="quick-actions-grid">
            <div class="action-card">
                <div class="action-card-icon primary">
                    <i class="fas fa-search"></i>
                </div>
                <h5 class="action-card-title">Book a New Trip</h5>
                <p class="action-card-description">Search and book your next bus trip with ease</p>
                <a href="{{ route('home') }}" class="btn-action-primary">
                    Search Trips
                </a>
            </div>
            <div class="action-card">
                <div class="action-card-icon success">
                    <i class="fas fa-list"></i>
                </div>
                <h5 class="action-card-title">View All Bookings</h5>
                <p class="action-card-description">See your complete booking history and details</p>
                <a href="{{ route('my.bookings') }}" class="btn-action-success">
                    My Bookings
                </a>
            </div>
        </div>
    </div>
@endsection