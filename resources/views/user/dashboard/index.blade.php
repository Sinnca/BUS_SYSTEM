@extends('layouts.app')

@section('title', 'My Dashboard')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap');

    .dashboard-container {
        font-family: 'Inter', sans-serif;
        animation: fadeIn 0.6s ease-out;
    }

    /* Page Header with Rotating Gradient */
    .dashboard-hero {
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.08) 0%, rgba(139, 92, 246, 0.08) 100%);
        border-radius: 24px;
        padding: 50px 40px;
        margin-bottom: 35px;
        border: 2px solid rgba(99, 102, 241, 0.15);
        position: relative;
        overflow: hidden;
        animation: fadeInDown 0.6s ease-out;
    }

    .dashboard-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: conic-gradient(
            from 0deg,
            rgba(99, 102, 241, 0.2) 0deg,
            rgba(139, 92, 246, 0.2) 90deg,
            rgba(168, 85, 247, 0.2) 180deg,
            rgba(139, 92, 246, 0.2) 270deg,
            rgba(99, 102, 241, 0.2) 360deg
        );
        animation: rotateGradient 8s linear infinite;
    }

    .dashboard-hero::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.9) 0%, rgba(255, 255, 255, 0.85) 100%);
    }

    .hero-content {
        position: relative;
        z-index: 1;
    }

    .welcome-badge {
        display: inline-block;
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        color: white;
        padding: 8px 20px;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 700;
        margin-bottom: 15px;
        box-shadow: 0 4px 15px rgba(99, 102, 241, 0.35);
        letter-spacing: 0.5px;
        text-transform: uppercase;
        animation: pulse 2s ease-in-out infinite;
    }

    .hero-title {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 3rem;
        font-weight: 800;
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 10px;
        letter-spacing: -1.5px;
        line-height: 1.1;
    }

    .hero-subtitle {
        color: #64748b;
        font-size: 1.1rem;
        font-weight: 500;
        margin: 0;
    }

    /* Stats Cards */
    .stats-grid {
        margin-bottom: 35px;
    }

    .stat-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 8px 30px rgba(99, 102, 241, 0.12);
        border: 2px solid rgba(99, 102, 241, 0.1);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
        position: relative;
        animation: fadeInUp 0.6s ease-out both;
        height: 100%;
    }

    .stat-card:nth-child(1) { animation-delay: 0.1s; }
    .stat-card:nth-child(2) { animation-delay: 0.2s; }
    .stat-card:nth-child(3) { animation-delay: 0.3s; }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(90deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s ease;
    }

    .stat-card:hover::before {
        transform: scaleX(1);
    }

    .stat-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 50px rgba(99, 102, 241, 0.25);
        border-color: rgba(99, 102, 241, 0.25);
    }

    .stat-card-body {
        padding: 30px;
    }

    .stat-icon-wrapper {
        width: 70px;
        height: 70px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        font-size: 2rem;
        color: white;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        transition: transform 0.3s ease;
    }

    .stat-card:hover .stat-icon-wrapper {
        transform: scale(1.1) rotate(5deg);
    }

    .stat-icon-wrapper.primary {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
    }

    .stat-icon-wrapper.success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    }

    .stat-icon-wrapper.info {
        background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
    }

    .stat-label {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 0.85rem;
        font-weight: 700;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        margin-bottom: 8px;
    }

    .stat-value {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 2.8rem;
        font-weight: 800;
        color: #1e293b;
        line-height: 1;
        margin-bottom: 0;
    }

    /* Trip Cards */
    .section-card {
        background: white;
        border-radius: 24px;
        box-shadow: 0 10px 40px rgba(99, 102, 241, 0.1);
        border: 2px solid rgba(99, 102, 241, 0.1);
        overflow: hidden;
        margin-bottom: 35px;
        animation: fadeInUp 0.6s ease-out 0.4s both;
        position: relative;
    }

    .section-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(90deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
    }

    .section-header {
        padding: 28px 35px;
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.03) 0%, rgba(139, 92, 246, 0.03) 100%);
        border-bottom: 2px solid rgba(99, 102, 241, 0.1);
    }

    .section-title {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 1.4rem;
        font-weight: 800;
        color: #1e293b;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .section-title i {
        color: #8b5cf6;
        font-size: 1.3rem;
    }

    .section-body {
        padding: 30px 35px;
    }

    .trip-card {
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.02) 0%, rgba(139, 92, 246, 0.02) 100%);
        border: 2px solid rgba(99, 102, 241, 0.12);
        border-radius: 18px;
        padding: 25px;
        margin-bottom: 20px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .trip-card::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 5px;
        background: linear-gradient(180deg, #6366f1 0%, #8b5cf6 100%);
        transform: scaleY(0);
        transition: transform 0.3s ease;
    }

    .trip-card:hover {
        border-color: rgba(99, 102, 241, 0.25);
        box-shadow: 0 8px 25px rgba(99, 102, 241, 0.15);
        transform: translateX(5px);
    }

    .trip-card:hover::before {
        transform: scaleY(1);
    }

    .trip-date-box {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        border-radius: 14px;
        padding: 20px;
        text-align: center;
        color: white;
        box-shadow: 0 6px 20px rgba(99, 102, 241, 0.3);
    }

    .trip-date-day {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 2.5rem;
        font-weight: 800;
        line-height: 1;
        margin-bottom: 5px;
    }

    .trip-date-month {
        font-size: 0.9rem;
        font-weight: 600;
        opacity: 0.95;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .trip-route {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 1.3rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 12px;
    }

    .trip-details {
        color: #64748b;
        font-size: 0.95rem;
        font-weight: 500;
        margin-bottom: 12px;
    }

    .trip-details i {
        color: #8b5cf6;
        margin-right: 6px;
    }

    .badge-custom {
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-right: 8px;
    }

    .badge-primary-custom {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        color: white;
        box-shadow: 0 2px 10px rgba(99, 102, 241, 0.3);
    }

    .badge-info-custom {
        background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
        color: white;
        box-shadow: 0 2px 10px rgba(6, 182, 212, 0.3);
    }

    .passenger-count {
        text-align: center;
    }

    .passenger-label {
        font-size: 0.8rem;
        color: #64748b;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 6px;
    }

    .passenger-value {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 2rem;
        font-weight: 800;
        color: #1e293b;
    }

    .btn-custom {
        font-family: 'Space Grotesk', sans-serif;
        padding: 10px 24px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.9rem;
        letter-spacing: 0.3px;
        transition: all 0.3s ease;
        border: none;
        text-transform: uppercase;
    }

    .btn-primary-custom {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
    }

    .btn-primary-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(99, 102, 241, 0.4);
        background: linear-gradient(135deg, #5558e3 0%, #7c4ee8 100%);
        color: white;
    }

    .btn-success-custom {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
    }

    .btn-success-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4);
        background: linear-gradient(135deg, #0ea374 0%, #047857 100%);
        color: white;
    }

    .btn-outline-custom {
        background: white;
        color: #6366f1;
        border: 2px solid #6366f1;
        box-shadow: 0 2px 10px rgba(99, 102, 241, 0.1);
    }

    .btn-outline-custom:hover {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        color: white;
        border-color: transparent;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(99, 102, 241, 0.3);
    }

    /* Past Trips Compact */
    .past-trip-item {
        background: white;
        border: 2px solid rgba(99, 102, 241, 0.08);
        border-radius: 12px;
        padding: 18px 22px;
        margin-bottom: 12px;
        transition: all 0.3s ease;
    }

    .past-trip-item:hover {
        border-color: rgba(99, 102, 241, 0.2);
        box-shadow: 0 4px 15px rgba(99, 102, 241, 0.1);
        transform: translateX(3px);
    }

    .past-trip-route {
        font-weight: 700;
        color: #1e293b;
        font-size: 1rem;
    }

    .past-trip-meta {
        color: #64748b;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .status-completed {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        padding: 5px 12px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.3px;
        text-transform: uppercase;
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
    }

    /* Quick Actions */
    .action-card {
        background: white;
        border: 2px solid rgba(99, 102, 241, 0.1);
        border-radius: 20px;
        padding: 40px 30px;
        text-align: center;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .action-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, #6366f1 0%, #8b5cf6 100%);
        transform: scaleX(0);
        transition: transform 0.4s ease;
    }

    .action-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 40px rgba(99, 102, 241, 0.2);
        border-color: rgba(99, 102, 241, 0.25);
    }

    .action-card:hover::before {
        transform: scaleX(1);
    }

    .action-icon {
        width: 90px;
        height: 90px;
        margin: 0 auto 25px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        color: white;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        transition: transform 0.4s ease;
    }

    .action-card:hover .action-icon {
        transform: scale(1.15) rotate(10deg);
    }

    .action-icon.primary {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
    }

    .action-icon.success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    }

    .action-title {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 1.3rem;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 12px;
    }

    .action-description {
        color: #64748b;
        font-size: 0.95rem;
        margin-bottom: 25px;
        line-height: 1.5;
    }

    /* Alert */
    .alert-custom {
        background: linear-gradient(135deg, rgba(6, 182, 212, 0.08) 0%, rgba(8, 145, 178, 0.08) 100%);
        border: 2px solid rgba(6, 182, 212, 0.2);
        border-radius: 16px;
        padding: 20px 25px;
        color: #0891b2;
        font-weight: 500;
    }

    .alert-custom i {
        font-size: 1.2rem;
        margin-right: 10px;
    }

    .alert-custom .alert-link {
        color: #0891b2;
        font-weight: 700;
        text-decoration: underline;
    }

    /* Animations */
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes pulse {
        0%, 100% { 
            opacity: 1;
            transform: scale(1);
        }
        50% { 
            opacity: 0.9;
            transform: scale(1.02);
        }
    }

    @keyframes rotateGradient {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2rem;
        }

        .stat-value {
            font-size: 2rem;
        }

        .trip-date-box {
            padding: 15px;
        }

        .trip-date-day {
            font-size: 2rem;
        }

        .action-icon {
            width: 70px;
            height: 70px;
            font-size: 2rem;
        }
    }
</style>

<div class="dashboard-container container">
    <!-- Hero Header -->
    <div class="dashboard-hero">
        <div class="hero-content">
            <span class="welcome-badge">
                <i class="fas fa-user"></i> My Account
            </span>
            <h1 class="hero-title">Welcome, {{ auth()->user()->name }}!</h1>
            <p class="hero-subtitle">Manage your bus reservations and travel history</p>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="row stats-grid g-4 mb-4">
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-card-body">
                    <div class="stat-icon-wrapper primary">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="stat-label">Upcoming Trips</div>
                    <h2 class="stat-value">{{ $upcomingReservations->count() }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-card-body">
                    <div class="stat-icon-wrapper success">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-label">Past Trips</div>
                    <h2 class="stat-value">{{ $pastReservations->count() }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-card-body">
                    <div class="stat-icon-wrapper info">
                        <i class="fas fa-coins"></i>
                    </div>
                    <div class="stat-label">Total Spent</div>
                    <h2 class="stat-value">₱{{ number_format(auth()->user()->reservations()->where('status', 'confirmed')->sum('total_price'), 2) }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Upcoming Trips -->
    <div class="section-card">
        <div class="section-header">
            <h5 class="section-title">
                <i class="fas fa-calendar-alt"></i>
                Upcoming Trips
            </h5>
        </div>
        <div class="section-body">
            @forelse($upcomingReservations as $reservation)
                <div class="trip-card">
                    <div class="row align-items-center">
                        <div class="col-md-2">
                            <div class="trip-date-box">
                                <div class="trip-date-day">{{ $reservation->trip->departure_date->format('d') }}</div>
                                <div class="trip-date-month">{{ $reservation->trip->departure_date->format('M Y') }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5 class="trip-route">{{ $reservation->trip->origin }} → {{ $reservation->trip->destination }}</h5>
                            <p class="trip-details">
                                <i class="fas fa-clock"></i> {{ $reservation->trip->formatted_time }} |
                                <i class="fas fa-bus"></i> {{ $reservation->trip->bus->bus_number }}
                            </p>
                            <div>
                                <span class="badge-custom badge-primary-custom">{{ $reservation->reservation_code }}</span>
                                @if($reservation->is_round_trip)
                                    <span class="badge-custom badge-info-custom">Round Trip</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="passenger-count">
                                <div class="passenger-label">Passengers</div>
                                <div class="passenger-value">{{ $reservation->total_passengers }}</div>
                            </div>
                        </div>
                        <div class="col-md-2 text-end">
                            <a href="{{ route('my.bookings') }}" class="btn btn-custom btn-primary-custom">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert-custom">
                    <i class="fas fa-info-circle"></i> You have no upcoming trips.
                    <a href="{{ route('home') }}" class="alert-link">Book a trip now!</a>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Past Trips -->
    @if($pastReservations->isNotEmpty())
        <div class="section-card">
            <div class="section-header">
                <h5 class="section-title">
                    <i class="fas fa-history"></i>
                    Recent Past Trips
                </h5>
            </div>
            <div class="section-body">
                @foreach($pastReservations as $reservation)
                    <div class="past-trip-item">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <span class="past-trip-route">{{ $reservation->trip->origin }} → {{ $reservation->trip->destination }}</span>
                                <span class="past-trip-meta">
                                    | {{ $reservation->trip->formatted_date }}
                                    | {{ $reservation->reservation_code }}
                                </span>
                            </div>
                            <div class="col-md-4 text-end">
                                <span class="status-completed">Completed</span>
                            </div>
                        </div>
                    </div>
                @endforeach

                <a href="{{ route('my.bookings') }}" class="btn btn-custom btn-outline-custom mt-3">
                    View All Bookings
                </a>
            </div>
        </div>
    @endif

    <!-- Quick Actions -->
    <div class="row g-4 mt-2">
        <div class="col-md-6">
            <div class="action-card">
                <div class="action-icon primary">
                    <i class="fas fa-search"></i>
                </div>
                <h5 class="action-title">Book a New Trip</h5>
                <p class="action-description">Search and book your next bus trip</p>
                <a href="{{ route('home') }}" class="btn btn-custom btn-primary-custom">
                    Search Trips
                </a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="action-card">
                <div class="action-icon success">
                    <i class="fas fa-list"></i>
                </div>
                <h5 class="action-title">View All Bookings</h5>
                <p class="action-description">See your complete booking history</p>
                <a href="{{ route('my.bookings') }}" class="btn btn-custom btn-success-custom">
                    My Bookings
                </a>
            </div>
        </div>
    </div>
</div>
@endsection