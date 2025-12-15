@extends('layouts.app')

@section('title', 'Trip Details')

@push('styles')
<style>
    /* Trip Details Hero */
    .trip-details-hero {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        padding: 3rem 0;
        margin-bottom: 3rem;
        border-radius: 0 0 32px 32px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
    }

    .trip-details-hero h4 {
        color: #ffffff;
        font-size: 2rem;
        font-weight: 800;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    /* Main Card Styling */
    .details-card {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border: 1px solid rgba(139, 92, 246, 0.2);
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        overflow: hidden;
    }

    .details-card-header {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        color: white;
        padding: 1.5rem;
        border: none;
    }

    .details-card-header h4 {
        margin: 0;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .details-card-body {
        padding: 2.5rem;
    }

    /* Route Display */
    .route-display {
        background: rgba(99, 102, 241, 0.08);
        border: 1px solid rgba(139, 92, 246, 0.2);
        border-radius: 16px;
        padding: 2.5rem 2rem;
        margin-bottom: 2.5rem;
    }

    .route-location {
        text-align: center;
    }

    .route-location h2 {
        color: #ffffff;
        font-size: 2rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
        background: linear-gradient(135deg, #a855f7 0%, #6366f1 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .route-location p {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.95rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin: 0;
    }

    .route-arrow {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .route-arrow i {
        color: #a855f7;
        font-size: 2.5rem;
        animation: slideArrow 2s ease-in-out infinite;
    }

    @keyframes slideArrow {
        0%, 100% { transform: translateX(0); }
        50% { transform: translateX(10px); }
    }

    /* Section Divider */
    .section-divider {
        border: none;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(139, 92, 246, 0.3), transparent);
        margin: 2rem 0;
    }

    /* Section Title */
    .section-title {
        color: #ffffff;
        font-size: 1.4rem;
        font-weight: 700;
        margin-bottom: 1.8rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-title i {
        color: #a855f7;
    }

    /* Info Items */
    .info-item {
        background: rgba(99, 102, 241, 0.08);
        border: 1px solid rgba(139, 92, 246, 0.2);
        border-radius: 12px;
        padding: 1.3rem 1.4rem;
        margin-bottom: 1.2rem;
    }

    .info-item strong {
        color: rgba(255, 255, 255, 0.7);
        display: block;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.6rem;
    }

    .info-item-value {
        color: #ffffff;
        font-size: 1.1rem;
        font-weight: 600;
    }

    .badge-deluxe {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 700;
        box-shadow: 0 2px 10px rgba(99, 102, 241, 0.3);
    }

    .badge-standard {
        background: linear-gradient(135deg, #64748b 0%, #475569 100%);
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 700;
    }

    /* Availability Cards */
    .availability-card {
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.15) 0%, rgba(139, 92, 246, 0.1) 100%);
        border: 2px solid rgba(139, 92, 246, 0.3);
        border-radius: 16px;
        padding: 2rem 1.5rem;
        text-align: center;
        transition: all 0.3s ease;
    }

    .availability-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(99, 102, 241, 0.3);
    }

    .availability-card h3 {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 0.6rem;
    }

    .availability-card.success h3 {
        color: #10b981;
    }

    .availability-card.warning h3 {
        color: #f59e0b;
    }

    .availability-card.muted h3 {
        color: rgba(255, 255, 255, 0.5);
    }

    .availability-card p {
        color: rgba(255, 255, 255, 0.7);
        margin: 0;
        font-size: 0.95rem;
    }

    /* Occupancy Progress Bar */
    .occupancy-container {
        margin-bottom: 2.5rem;
    }

    .occupancy-label {
        color: #ffffff;
        font-weight: 600;
        margin-bottom: 0.8rem;
        display: block;
    }

    .progress-custom {
        height: 30px;
        background: rgba(99, 102, 241, 0.1);
        border-radius: 15px;
        overflow: hidden;
        border: 1px solid rgba(139, 92, 246, 0.2);
    }

    .progress-bar-custom {
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 0.95rem;
        transition: width 0.6s ease;
    }

    .progress-bar-success {
        background: linear-gradient(90deg, #10b981 0%, #059669 100%);
    }

    .progress-bar-warning {
        background: linear-gradient(90deg, #f59e0b 0%, #d97706 100%);
    }

    .progress-bar-danger {
        background: linear-gradient(90deg, #ef4444 0%, #dc2626 100%);
    }

    /* Pricing Display */
    .pricing-display {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.15) 0%, rgba(5, 150, 105, 0.1) 100%);
        border: 2px solid rgba(16, 185, 129, 0.3);
        border-radius: 16px;
        padding: 2rem 1.5rem;
        text-align: center;
    }

    .pricing-label {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 0.5rem;
    }

    .pricing-amount {
        color: #10b981;
        font-size: 2.5rem;
        font-weight: 800;
        letter-spacing: -1px;
    }

    /* Card Footer */
    .details-card-footer {
        background: rgba(99, 102, 241, 0.05);
        border-top: 1px solid rgba(139, 92, 246, 0.2);
        padding: 2rem 2.5rem;
    }

    /* Booking Form */
    .booking-form-container {
        display: flex;
        gap: 1rem;
        align-items: flex-end;
    }

    .booking-input-group {
        flex: 1;
    }

    .booking-input-group label {
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 0.4rem;
        display: block;
    }

    .booking-input {
        background: rgba(99, 102, 241, 0.1);
        border: 1px solid rgba(139, 92, 246, 0.3);
        border-radius: 10px;
        color: white;
        padding: 0.7rem 1rem;
        width: 100%;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .booking-input:focus {
        outline: none;
        border-color: #a855f7;
        background: rgba(99, 102, 241, 0.15);
        box-shadow: 0 0 0 3px rgba(168, 85, 247, 0.1);
    }

    /* Buttons */
    .btn-back {
        background: rgba(100, 116, 139, 0.2);
        color: white;
        border: 1px solid rgba(100, 116, 139, 0.3);
        padding: 0.8rem 1.5rem;
        border-radius: 10px;
        font-weight: 700;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-back:hover {
        background: rgba(100, 116, 139, 0.3);
        color: white;
        transform: translateX(-3px);
        border-color: rgba(100, 116, 139, 0.5);
    }

    .btn-book {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        border: none;
        padding: 0.8rem 1.8rem;
        border-radius: 10px;
        font-weight: 700;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-book:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(16, 185, 129, 0.5);
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        color: white;
    }

    .btn-fully-booked {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        border: none;
        padding: 0.8rem 1.8rem;
        border-radius: 10px;
        font-weight: 700;
        opacity: 0.7;
        cursor: not-allowed;
    }

    .btn-login {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        color: white;
        border: none;
        padding: 0.8rem 1.8rem;
        border-radius: 10px;
        font-weight: 700;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
    }

    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(99, 102, 241, 0.6);
        background: linear-gradient(135deg, #7c3aed 0%, #a855f7 100%);
        color: white;
    }

    /* Sidebar Cards */
    .sidebar-card {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border: 1px solid rgba(139, 92, 246, 0.2);
        border-radius: 16px;
        margin-bottom: 1.5rem;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    }

    .sidebar-card-header {
        padding: 1.2rem 1.5rem;
        border-bottom: 1px solid rgba(139, 92, 246, 0.2);
    }

    .sidebar-card-header.bg-info {
        background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
    }

    .sidebar-card-header.bg-secondary {
        background: linear-gradient(135deg, #64748b 0%, #475569 100%);
    }

    .sidebar-card-header.bg-warning {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    }

    .sidebar-card-header h5 {
        margin: 0;
        color: white;
        font-weight: 700;
        font-size: 1.1rem;
    }

    .sidebar-card-body {
        padding: 1.8rem;
    }

    .feature-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .feature-list li {
        color: rgba(255, 255, 255, 0.9);
        padding: 0.7rem 0;
        display: flex;
        align-items: center;
        gap: 12px;
        font-weight: 500;
    }

    .feature-list li i {
        color: #10b981;
        font-size: 1.1rem;
    }

    /* Stats */
    .stat-item {
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 1.2rem;
        font-size: 0.95rem;
    }

    .stat-item strong {
        color: rgba(255, 255, 255, 0.7);
    }

    .stat-item:last-child {
        margin-bottom: 0;
    }

    .badge-status {
        padding: 0.4rem 0.9rem;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.85rem;
    }

    .badge-status.success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    }

    .badge-status.danger {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    }

    /* Seat Map */
    .seat-map-container {
        background: rgba(248, 249, 250, 0.05);
        border: 1px solid rgba(139, 92, 246, 0.2);
        padding: 1.8rem;
        border-radius: 12px;
    }

    .seat-map-driver {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        color: white;
        padding: 0.8rem;
        border-radius: 8px;
        margin-bottom: 1rem;
        text-align: center;
        font-weight: 700;
        border: 1px solid rgba(139, 92, 246, 0.3);
    }

    .seat-row {
        display: flex;
        gap: 5px;
        justify-content: center;
        margin-bottom: 8px;
    }

    .seat {
        width: 35px;
        height: 35px;
        border-radius: 6px;
        transition: all 0.3s ease;
    }

    .seat-available {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
    }

    .seat-reserved {
        background: linear-gradient(135deg, #64748b 0%, #475569 100%);
    }

    .seat-legend {
        display: flex;
        gap: 1.5rem;
        justify-content: center;
        margin-top: 1.2rem;
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.85rem;
    }

    .seat-legend-item {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .seat-legend-box {
        width: 18px;
        height: 18px;
        border-radius: 4px;
    }

    /* Info Card */
    .info-card {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border: 1px solid rgba(139, 92, 246, 0.2);
        border-radius: 16px;
        margin-top: 2rem;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    }

    .info-card-header {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        color: white;
        padding: 1.2rem 1.5rem;
    }

    .info-card-header h5 {
        margin: 0;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .info-card-body {
        padding: 2rem;
    }

    .info-card-body ul {
        margin: 0;
        padding-left: 1.5rem;
        color: rgba(255, 255, 255, 0.9);
    }

    .info-card-body ul li {
        margin-bottom: 1rem;
        line-height: 1.6;
    }

    .info-card-body ul li:last-child {
        margin-bottom: 0;
    }

    /* Modal Styling */
    .modal-content-custom {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border: 2px solid rgba(239, 68, 68, 0.5);
        border-radius: 20px;
        overflow: hidden;
    }

    .modal-header-custom {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        border: none;
        padding: 1.5rem;
    }

    .modal-header-custom h5 {
        margin: 0;
        font-weight: 700;
    }

    .modal-body-custom {
        padding: 2rem;
        color: rgba(255, 255, 255, 0.9);
        font-size: 1.05rem;
        line-height: 1.8;
    }

    .modal-footer-custom {
        background: rgba(99, 102, 241, 0.05);
        border-top: 1px solid rgba(139, 92, 246, 0.2);
        padding: 1.2rem 1.5rem;
    }

    .btn-modal-close {
        background: rgba(100, 116, 139, 0.3);
        color: white;
        border: 1px solid rgba(100, 116, 139, 0.4);
        padding: 0.6rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-modal-close:hover {
        background: rgba(100, 116, 139, 0.5);
        color: white;
        border-color: rgba(100, 116, 139, 0.6);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .trip-details-hero {
            padding: 2rem 0;
            margin-bottom: 2rem;
        }

        .trip-details-hero h4 {
            font-size: 1.5rem;
        }

        .route-display {
            padding: 1.8rem 1.2rem;
        }

        .route-location h2 {
            font-size: 1.5rem;
        }

        .route-arrow i {
            font-size: 2rem;
        }

        .details-card-body,
        .details-card-footer {
            padding: 1.8rem;
        }

        .booking-form-container {
            flex-direction: column;
        }

        .btn-book,
        .btn-fully-booked,
        .btn-login,
        .btn-back {
            width: 100%;
            justify-content: center;
        }

        .pricing-amount {
            font-size: 2rem;
        }

        .sidebar-card-body {
            padding: 1.5rem;
        }

        .info-card-body {
            padding: 1.5rem;
        }
    }
</style>
@endpush

@section('content')
    <div class="container" style="margin-top: 2rem;">
        <div class="row">
            <div class="col-lg-8 mb-4">
                <!-- Main Trip Details Card -->
                <div class="details-card">
                    <div class="details-card-header">
                        <h4>
                            <i class="fas fa-route"></i> Trip Details
                        </h4>
                    </div>
                    <div class="details-card-body">
                        <!-- Route Info -->
                        <div class="route-display">
                            <div class="row align-items-center">
                                <div class="col-md-5">
                                    <div class="route-location">
                                        <h2>{{ $trip->origin }}</h2>
                                        <p>Departure</p>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="route-arrow">
                                        <i class="fas fa-arrow-right"></i>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="route-location">
                                        <h2>{{ $trip->destination }}</h2>
                                        <p>Arrival</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="section-divider">

                        <!-- Trip Information -->
                        <h5 class="section-title">
                            <i class="fas fa-info-circle"></i> Trip Information
                        </h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="info-item">
                                    <strong>Departure Date</strong>
                                    <div class="info-item-value">{{ $trip->formatted_date }}</div>
                                </div>
                                <div class="info-item">
                                    <strong>Departure Time</strong>
                                    <div class="info-item-value">{{ $trip->formatted_time }}</div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="info-item">
                                    <strong>Bus Number</strong>
                                    <div class="info-item-value">{{ $trip->bus->bus_number }}</div>
                                </div>
                                <div class="info-item">
                                    <strong>Bus Type</strong>
                                    <div class="info-item-value">
                                        <span class="badge-{{ $trip->bus->bus_type === 'deluxe' ? 'deluxe' : 'standard' }}">
                                            {{ $trip->bus->formatted_bus_type }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="section-divider">

                        <!-- Availability -->
                        <h5 class="section-title">
                            <i class="fas fa-chair"></i> Seat Availability
                        </h5>
                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <div class="availability-card {{ $trip->available_seats > 10 ? 'success' : 'warning' }}">
                                    <h3>{{ $trip->available_seats }}</h3>
                                    <p>Available Seats</p>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="availability-card muted">
                                    <h3>{{ $trip->bus->capacity }}</h3>
                                    <p>Total Capacity</p>
                                </div>
                            </div>
                        </div>

                        <!-- Occupancy Bar -->
                        <div class="occupancy-container">
                            <label class="occupancy-label">Occupancy Rate</label>
                            <div class="progress-custom">
                                <div class="progress-bar-custom progress-bar-{{ $trip->occupancy_rate < 50 ? 'success' : ($trip->occupancy_rate < 80 ? 'warning' : 'danger') }}"
                                     role="progressbar"
                                     style="width: {{ $trip->occupancy_rate }}%"
                                     aria-valuenow="{{ $trip->occupancy_rate }}"
                                     aria-valuemin="0"
                                     aria-valuemax="100">
                                    {{ $trip->occupancy_rate }}%
                                </div>
                            </div>
                        </div>

                        <hr class="section-divider">

                        <!-- Pricing -->
                        <h5 class="section-title">
                            <i class="fas fa-money-bill-wave"></i> Pricing
                        </h5>
                        <div class="pricing-display">
                            <div class="pricing-label">Price per Seat</div>
                            <div class="pricing-amount">{{ $trip->formatted_price }}</div>
                        </div>
                    </div>

                    <div class="details-card-footer">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <a href="{{ route('trips.index') }}" class="btn-back w-100">
                                    <i class="fas fa-arrow-left"></i> Back to Trips
                                </a>
                            </div>
                            <div class="col-md-6">
                                @auth
                                    @if($trip->available_seats > 0)
                                        <!-- Booking Form -->
                                        <form action="{{ route('booking.seats', $trip) }}" method="GET" id="booking-form">
                                            <div class="booking-form-container">
                                                <div class="booking-input-group">
                                                    <label for="adults">Adults</label>
                                                    <input type="number" id="adults" name="adults" class="booking-input" value="1" min="1" placeholder="Adults">
                                                </div>
                                                <div class="booking-input-group">
                                                    <label for="children">Children</label>
                                                    <input type="number" id="children" name="children" class="booking-input" value="0" min="0" placeholder="Children">
                                                </div>
                                                <button type="submit" class="btn-book">
                                                    <i class="fas fa-ticket-alt"></i> Book Now
                                                </button>
                                            </div>
                                        </form>
                                    @else
                                        <button class="btn-fully-booked w-100" disabled>
                                            <i class="fas fa-times-circle"></i> Fully Booked
                                        </button>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="btn-login w-100">
                                        <i class="fas fa-sign-in-alt"></i> Login to Book
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Information -->
                <div class="info-card">
                    <div class="info-card-header">
                        <h5><i class="fas fa-info-circle"></i> Important Information</h5>
                    </div>
                    <div class="info-card-body">
                        <ul>
                            <li>Please arrive at the terminal at least 30 minutes before departure</li>
                            <li>Bring a valid ID for verification purposes</li>
                            <li>Luggage allowance: 1 check-in bag + 1 carry-on</li>
                            <li>Cancellations must be made at least 24 hours in advance</li>
                            <li>Children under 12 years old must be accompanied by an adult</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Bus Features -->
                <div class="sidebar-card">
                    <div class="sidebar-card-header bg-info">
                        <h5><i class="fas fa-star"></i> Bus Features</h5>
                    </div>
                    <div class="sidebar-card-body">
                        @if($trip->bus->bus_type === 'deluxe')
                            <ul class="feature-list">
                                <li><i class="fas fa-check-circle"></i> Air Conditioning</li>
                                <li><i class="fas fa-check-circle"></i> Reclining Seats</li>
                                <li><i class="fas fa-check-circle"></i> Free WiFi</li>
                                <li><i class="fas fa-check-circle"></i> USB Charging Ports</li>
                                <li><i class="fas fa-check-circle"></i> Extra Legroom</li>
                                <li><i class="fas fa-check-circle"></i> Onboard Restroom</li>
                            </ul>
                        @else
                            <ul class="feature-list">
                                <li><i class="fas fa-check-circle"></i> Air Conditioning</li>
                                <li><i class="fas fa-check-circle"></i> Comfortable Seats</li>
                                <li><i class="fas fa-check-circle"></i> Onboard Restroom</li>
                            </ul>
                        @endif
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="sidebar-card">
                    <div class="sidebar-card-header bg-secondary">
                        <h5><i class="fas fa-chart-bar"></i> Quick Stats</h5>
                    </div>
                    <div class="sidebar-card-body">
                        <div class="stat-item">
                            <strong>Trip ID:</strong> #{{ $trip->id }}
                        </div>
                        <div class="stat-item">
                            <strong>Bus Capacity:</strong> {{ $trip->bus->capacity }} passengers
                        </div>
                        <div class="stat-item">
                            <strong>Seats Left:</strong> {{ $trip->available_seats }}
                        </div>
                        <div class="stat-item">
                            <strong>Status:</strong>
                            <span class="badge-status {{ $trip->is_sold_out ? 'danger' : 'success' }}">
                                {{ $trip->is_sold_out ? 'Sold Out' : 'Available' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Seat Map Preview -->
                <div class="sidebar-card">
                    <div class="sidebar-card-header bg-warning">
                        <h5><i class="fas fa-th"></i> Seat Map Preview</h5>
                    </div>
                    <div class="sidebar-card-body">
                        <div class="seat-map-container">
                            <div class="seat-map-driver">
                                <i class="fas fa-steering-wheel"></i> DRIVER
                            </div>
                            @php
                                $rows = ceil($trip->bus->capacity / 4);
                            @endphp
                            @for($i = 0; $i < min($rows, 3); $i++)
                                <div class="seat-row">
                                    <div class="seat seat-available"></div>
                                    <div class="seat seat-available"></div>
                                    <div style="width: 20px;"></div>
                                    <div class="seat seat-available"></div>
                                    <div class="seat seat-available"></div>
                                </div>
                            @endfor
                            @if($rows > 3)
                                <p style="color: rgba(255, 255, 255, 0.5); text-align: center; margin-top: 1rem; font-size: 0.9rem;">
                                    ... and {{ $rows - 3 }} more rows
                                </p>
                            @endif
                        </div>
                        <div class="seat-legend">
                            <div class="seat-legend-item">
                                <div class="seat-legend-box seat-available"></div>
                                <span>Available</span>
                            </div>
                            <div class="seat-legend-item">
                                <div class="seat-legend-box seat-reserved"></div>
                                <span>Reserved</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Not Enough Seats Modal -->
    <div class="modal fade" id="notEnoughSeatsModal" tabindex="-1" aria-labelledby="notEnoughSeatsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-content-custom">
                <div class="modal-header modal-header-custom">
                    <h5 class="modal-title" id="notEnoughSeatsModalLabel">
                        <i class="fas fa-exclamation-triangle"></i> Not Enough Seats
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body modal-body-custom" id="modal-body-text">
                    Sorry! There are not enough seats available for this trip.
                </div>
                <div class="modal-footer modal-footer-custom">
                    <button type="button" class="btn-modal-close" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const availableSeats = {{ $trip->available_seats }};
                const form = document.getElementById('booking-form');
                const adultsInput = document.getElementById('adults');
                const childrenInput = document.getElementById('children');
                const modal = new bootstrap.Modal(document.getElementById('notEnoughSeatsModal'));
                const modalBody = document.getElementById('modal-body-text');

                if (form) {
                    form.addEventListener('submit', function(e) {
                        const adults = parseInt(adultsInput.value) || 0;
                        const children = parseInt(childrenInput.value) || 0;
                        const totalSeats = adults + children;

                        if (totalSeats > availableSeats) {
                            e.preventDefault();
                            modalBody.innerHTML = `
                                <div style="text-align: center;">
                                    <i class="fas fa-exclamation-circle" style="font-size: 3rem; color: #ef4444; margin-bottom: 1rem;"></i>
                                    <p style="margin-bottom: 1rem;">Sorry! There are not enough seats available for this trip.</p>
                                    <div style="background: rgba(99, 102, 241, 0.1); padding: 1rem; border-radius: 10px; border: 1px solid rgba(139, 92, 246, 0.2);">
                                        <p style="margin-bottom: 0.5rem;"><strong>Requested:</strong> ${totalSeats} seat(s)</p>
                                        <p style="margin-bottom: 0;"><strong>Available:</strong> ${availableSeats} seat(s)</p>
                                    </div>
                                </div>
                            `;
                            modal.show();
                            return false;
                        }
                    });
                }
            });
        </script>
    @endpush
@endsection