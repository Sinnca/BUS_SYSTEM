@extends('layouts.app')

@section('title', 'My Bookings')

@push('styles')
<style>
    /* Bookings Container */
    .bookings-container {
        margin-top: 2rem;
        margin-bottom: 3rem;
        animation: fadeIn 0.6s ease-out;
    }

    /* Page Header */
    .bookings-header {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border: 1px solid rgba(139, 92, 246, 0.2);
        border-radius: 20px;
        padding: 2rem 2.5rem;
        margin-bottom: 2.5rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1.5rem;
        animation: fadeInDown 0.6s ease-out;
    }

    .bookings-header h2 {
        color: #ffffff;
        font-size: 2.2rem;
        font-weight: 800;
        margin: 0;
        letter-spacing: -0.5px;
    }

    .btn-new-trip {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        color: white;
        border: none;
        padding: 0.8rem 1.8rem;
        border-radius: 10px;
        font-weight: 700;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-new-trip:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(99, 102, 241, 0.6);
        background: linear-gradient(135deg, #7c3aed 0%, #a855f7 100%);
        color: white;
    }

    /* Filter Section */
    .filter-section {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border: 1px solid rgba(139, 92, 246, 0.2);
        border-radius: 16px;
        padding: 1.8rem;
        margin-bottom: 2rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        animation: fadeInUp 0.6s ease-out;
        animation-delay: 0.1s;
        animation-fill-mode: both;
    }

    .filter-label {
        color: rgba(255, 255, 255, 0.8);
        font-weight: 600;
        margin-bottom: 0.8rem;
        display: block;
    }

    .filter-select {
        background: rgba(99, 102, 241, 0.1);
        border: 1px solid rgba(139, 92, 246, 0.3);
        border-radius: 10px;
        color: white;
        padding: 0.7rem 1rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .filter-select:focus {
        outline: none;
        border-color: #a855f7;
        background: rgba(99, 102, 241, 0.15);
        box-shadow: 0 0 0 3px rgba(168, 85, 247, 0.1);
        color: white;
    }

    .filter-select option {
        background: #1e293b;
        color: white;
    }

    .btn-filter {
        background: rgba(100, 116, 139, 0.2);
        color: white;
        border: 1px solid rgba(100, 116, 139, 0.3);
        padding: 0.7rem 1.5rem;
        border-radius: 0 10px 10px 0;
        font-weight: 700;
        transition: all 0.3s ease;
    }

    .btn-filter:hover {
        background: rgba(100, 116, 139, 0.3);
        color: white;
        border-color: rgba(100, 116, 139, 0.5);
    }

    /* Empty State */
    .empty-state {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border: 2px dashed rgba(139, 92, 246, 0.3);
        border-radius: 20px;
        padding: 4rem 2rem;
        text-align: center;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        animation: fadeIn 0.6s ease-out;
        animation-delay: 0.2s;
        animation-fill-mode: both;
    }

    .empty-state-icon {
        font-size: 4rem;
        color: rgba(139, 92, 246, 0.3);
        margin-bottom: 1.5rem;
    }

    .empty-state-text {
        color: rgba(255, 255, 255, 0.8);
        font-size: 1.2rem;
        margin-bottom: 0.5rem;
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

    /* Booking Cards */
    .booking-card {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border: 1px solid rgba(139, 92, 246, 0.2);
        border-radius: 20px;
        margin-bottom: 2rem;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        transition: all 0.3s ease;
        animation: fadeInUp 0.6s ease-out;
        animation-fill-mode: both;
    }

    .booking-card:nth-child(1) {
        animation-delay: 0.2s;
    }

    .booking-card:nth-child(2) {
        animation-delay: 0.3s;
    }

    .booking-card:nth-child(3) {
        animation-delay: 0.4s;
    }

    .booking-card:nth-child(4) {
        animation-delay: 0.5s;
    }

    .booking-card:nth-child(5) {
        animation-delay: 0.6s;
    }

    .booking-card:nth-child(6) {
        animation-delay: 0.7s;
    }

    .booking-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
        border-color: rgba(139, 92, 246, 0.4);
    }

    .booking-card-header {
        padding: 1.5rem 2rem;
        border-bottom: 1px solid rgba(139, 92, 246, 0.2);
    }

    .booking-card-header.confirmed {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    }

    .booking-card-header.pending {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    }

    .booking-card-header.cancelled {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    }

    .booking-code {
        color: white;
        font-size: 1.3rem;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .booking-status-badges {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .status-badge {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        color: white;
        padding: 0.4rem 0.9rem;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.85rem;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .status-badge.round-trip {
        background: linear-gradient(135deg, rgba(14, 165, 233, 0.3) 0%, rgba(2, 132, 199, 0.3) 100%);
        border-color: rgba(14, 165, 233, 0.5);
    }

    .booking-card-body {
        padding: 2rem;
    }

    /* Trip Sections */
    .trip-section {
        margin-bottom: 2rem;
    }

    .trip-section:last-of-type {
        margin-bottom: 0;
    }

    .trip-section-header {
        color: #a855f7;
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 1.2rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .trip-section-divider {
        border: none;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(139, 92, 246, 0.3), transparent);
        margin: 2rem 0;
    }

    .trip-info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.2rem;
        margin-bottom: 1.5rem;
    }

    .trip-info-item {
        background: rgba(99, 102, 241, 0.08);
        border: 1px solid rgba(139, 92, 246, 0.2);
        border-radius: 12px;
        padding: 1.2rem;
    }

    .trip-info-label {
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
        font-weight: 600;
    }

    .trip-info-value {
        color: #ffffff;
        font-size: 1rem;
        font-weight: 600;
        line-height: 1.5;
    }

    .bus-type-badge {
        background: linear-gradient(135deg, #64748b 0%, #475569 100%);
        color: white;
        padding: 0.3rem 0.7rem;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 700;
        display: inline-block;
        margin-top: 0.3rem;
    }

    /* Booking Details */
    .booking-details-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.2rem;
        margin-bottom: 1.5rem;
    }

    .seat-badges {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-top: 0.5rem;
    }

    .seat-badge {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        color: white;
        padding: 0.3rem 0.7rem;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 700;
    }

    .total-price {
        text-align: right;
    }

    .total-price-label {
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.3rem;
    }

    .total-price-amount {
        color: #10b981;
        font-size: 2rem;
        font-weight: 800;
        letter-spacing: -1px;
    }

    /* Passenger Names */
    .passengers-section {
        background: rgba(99, 102, 241, 0.05);
        border: 1px solid rgba(139, 92, 246, 0.15);
        border-radius: 12px;
        padding: 1.2rem;
    }

    .passengers-label {
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.8rem;
        font-weight: 600;
    }

    .passenger-list {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .passenger-item {
        color: rgba(255, 255, 255, 0.9);
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .passenger-item i {
        color: #a855f7;
    }

    /* Card Footer */
    .booking-card-footer {
        background: rgba(99, 102, 241, 0.05);
        border-top: 1px solid rgba(139, 92, 246, 0.2);
        padding: 1.5rem 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .footer-info {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .footer-info i {
        color: #a855f7;
    }

    .footer-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    /* Action Buttons */
    .btn-print {
        background: rgba(100, 116, 139, 0.2);
        color: white;
        border: 1px solid rgba(100, 116, 139, 0.3);
        padding: 0.6rem 1.2rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-print:hover {
        background: rgba(100, 116, 139, 0.3);
        color: white;
        border-color: rgba(100, 116, 139, 0.5);
        transform: translateY(-2px);
    }

    .btn-pay {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        color: white;
        border: none;
        padding: 0.6rem 1.2rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-pay:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(99, 102, 241, 0.6);
        background: linear-gradient(135deg, #7c3aed 0%, #a855f7 100%);
        color: white;
    }

    .btn-cancel {
        background: transparent;
        color: #ef4444;
        border: 1px solid rgba(239, 68, 68, 0.5);
        padding: 0.6rem 1.2rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-cancel:hover {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
        border-color: rgba(239, 68, 68, 0.7);
        transform: translateY(-2px);
    }

    /* Modal Styling */
    .modal-content-custom {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border: 2px solid rgba(239, 68, 68, 0.3);
        border-radius: 20px;
        overflow: hidden;
    }

    .modal-header-custom {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        border: none;
        padding: 1.5rem 2rem;
    }

    .modal-header-custom h5 {
        margin: 0;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .modal-body-custom {
        padding: 2rem;
        color: rgba(255, 255, 255, 0.9);
        font-size: 1.05rem;
        line-height: 1.8;
    }

    .modal-body-custom strong {
        color: #ef4444;
    }

    .modal-footer-custom {
        background: rgba(99, 102, 241, 0.05);
        border-top: 1px solid rgba(139, 92, 246, 0.2);
        padding: 1.2rem 2rem;
    }

    .btn-modal-keep {
        background: rgba(100, 116, 139, 0.3);
        color: white;
        border: 1px solid rgba(100, 116, 139, 0.4);
        padding: 0.7rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-modal-keep:hover {
        background: rgba(100, 116, 139, 0.5);
        color: white;
        border-color: rgba(100, 116, 139, 0.6);
    }

    .btn-modal-cancel {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        border: none;
        padding: 0.7rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(239, 68, 68, 0.4);
    }

    .btn-modal-cancel:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(239, 68, 68, 0.6);
        background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
        color: white;
    }

    /* Pagination */
    .pagination {
        margin-top: 2rem;
        gap: 8px;
    }

    .pagination .page-link {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border: 1px solid rgba(139, 92, 246, 0.3);
        color: #e0e7ff;
        border-radius: 10px;
        padding: 0.6rem 1rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .pagination .page-link:hover {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        color: white;
        border-color: transparent;
        transform: translateY(-2px);
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        border-color: transparent;
        color: white;
        box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
    }

    .pagination .page-item.disabled .page-link {
        background: rgba(30, 41, 59, 0.5);
        border-color: rgba(139, 92, 246, 0.1);
        color: rgba(255, 255, 255, 0.3);
    }

    /* Keyframe Animations */
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
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

    /* Responsive */
    @media (max-width: 768px) {
        .bookings-container {
            margin-top: 1.5rem;
        }

        .bookings-header {
            padding: 1.5rem;
            flex-direction: column;
            align-items: flex-start;
        }

        .bookings-header h2 {
            font-size: 1.8rem;
        }

        .btn-new-trip {
            width: 100%;
            justify-content: center;
        }

        .filter-section {
            padding: 1.5rem;
        }

        .booking-card-header {
            padding: 1.2rem 1.5rem;
        }

        .booking-code {
            font-size: 1.1rem;
        }

        .booking-card-body {
            padding: 1.5rem;
        }

        .trip-info-grid,
        .booking-details-grid {
            grid-template-columns: 1fr;
        }

        .total-price {
            text-align: left;
        }

        .booking-card-footer {
            padding: 1.2rem 1.5rem;
            flex-direction: column;
            align-items: flex-start;
        }

        .footer-actions {
            width: 100%;
            flex-direction: column;
        }

        .btn-print,
        .btn-pay,
        .btn-cancel {
            width: 100%;
            justify-content: center;
        }
    }
    .status-badge.failed {
        background: linear-gradient(135deg, #ef4444 0%, #b91c1c 100%);
        border-color: rgba(239, 68, 68, 0.5);
    }

</style>
@endpush

@section('content')
    <div class="container bookings-container">

        <!-- Page Header -->
        <div class="bookings-header">
            <h2>My Bookings</h2>
            <a href="{{ route('home') }}" class="btn-new-trip">
                <i class="fas fa-plus"></i> Book New Trip
            </a>
        </div>

        <!-- Filter -->
        <div class="filter-section">
            <form method="GET" action="{{ route('my.bookings') }}">
                <div class="row align-items-end">
                    <div class="col-md-4">
                        <label class="filter-label">Filter by Status</label>
                        <div class="input-group">
                            <select name="status" class="filter-select form-select" onchange="this.form.submit()">
                                <option value="">All Bookings</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            <button class="btn-filter" type="submit">
                                <i class="fas fa-filter"></i> Filter
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- Show active filter -->
        @if(request('status'))
            <div class="alert alert-info">
                <i class="fas fa-filter"></i> Showing: <strong>{{ ucfirst(request('status')) }}</strong> bookings
            </div>
        @endif
        @if($reservations->isEmpty())
            <div class="empty-state">
                <div class="empty-state-icon"><i class="fas fa-ticket-alt"></i></div>
                <div class="empty-state-text">You don't have any bookings yet.</div>
                <a href="{{ route('home') }}" class="empty-state-link">Book your first trip!</a>
            </div>
        @else
            @foreach($reservations as $reservation)
                @php
                    // ✅ FIX: Parse trip datetime correctly
                    $departureDate = $reservation->trip->departure_date->format('Y-m-d');
                    $departureTime = \Carbon\Carbon::parse($reservation->trip->departure_time)->format('H:i:s');
                    $tripDateTime = \Carbon\Carbon::parse($departureDate . ' ' . $departureTime);

                    $isPastTrip = $tripDateTime->isPast();
                    $hoursSinceBooking = $reservation->created_at->diffInHours(now());

                    $hoursUntilDeparture = now()->diffInHours($tripDateTime, false);
                @endphp

                <div class="booking-card">
                    <!-- HEADER -->
                    <div class="booking-card-header {{ $reservation->status }}">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h5 class="booking-code">
                                    <i class="fas fa-ticket-alt"></i>
                                    {{ $reservation->reservation_code }}
                                </h5>
                            </div>

                            <div class="col-md-4 text-md-end">
                                <div class="booking-status-badges">
                                    @if($isPastTrip)
                                        @if($reservation->status === 'confirmed')
                                            <span class="status-badge completed">Completed</span>
                                        @elseif($reservation->status === 'pending')
                                            <span class="status-badge failed">Failed</span>
                                        @else
                                            <span class="status-badge {{ $reservation->status }}">
                                                {{ ucfirst($reservation->status) }}
                                            </span>
                                        @endif
                                    @else
                                        <span class="status-badge {{ $reservation->status }}">
                                            {{ ucfirst($reservation->status) }}
                                        </span>
                                    @endif

                                    @if($reservation->is_round_trip)
                                        <span class="status-badge round-trip">Round Trip</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- BODY -->
                    <div class="booking-card-body">
                        <!-- OUTBOUND -->
                        <div class="trip-section">
                            <div class="trip-section-header">
                                <i class="fas fa-arrow-right"></i> Outbound Trip
                            </div>

                            <div class="trip-info-grid">
                                <div class="trip-info-item">
                                    <div class="trip-info-label">Route</div>
                                    <div class="trip-info-value">
                                        {{ $reservation->trip->origin }} → {{ $reservation->trip->destination }}
                                    </div>
                                </div>

                                <div class="trip-info-item">
                                    <div class="trip-info-label">Date & Time</div>
                                    <div class="trip-info-value">
                                        {{ $reservation->trip->formatted_date }}<br>
                                        {{ $reservation->trip->formatted_time }}
                                    </div>
                                </div>

                                <div class="trip-info-item">
                                    <div class="trip-info-label">Bus</div>
                                    <div class="trip-info-value">
                                        {{ $reservation->trip->bus->bus_number }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($reservation->is_round_trip && $reservation->returnTrip)
                            <hr class="trip-section-divider">

                            <!-- RETURN TRIP -->
                            <div class="trip-section">
                                <div class="trip-section-header">
                                    <i class="fas fa-arrow-left"></i> Return Trip
                                </div>

                                <div class="trip-info-grid">
                                    <div class="trip-info-item">
                                        <div class="trip-info-label">Route</div>
                                        <div class="trip-info-value">
                                            {{ $reservation->returnTrip->origin }} → {{ $reservation->returnTrip->destination }}
                                        </div>
                                    </div>

                                    <div class="trip-info-item">
                                        <div class="trip-info-label">Date & Time</div>
                                        <div class="trip-info-value">
                                            {{ $reservation->returnTrip->formatted_date }}<br>
                                            {{ $reservation->returnTrip->formatted_time }}
                                        </div>
                                    </div>

                                    <div class="trip-info-item">
                                        <div class="trip-info-label">Bus</div>
                                        <div class="trip-info-value">
                                            {{ $reservation->returnTrip->bus->bus_number }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <hr class="trip-section-divider">

                        <!-- DETAILS -->
                        <div class="booking-details-grid">
                            <div class="trip-info-item">
                                <div class="trip-info-label">Seats</div>
                                <div class="seat-badges">
                                    @foreach($reservation->reservedSeats as $seat)
                                        <span class="seat-badge">{{ $seat->seat_number }}</span>
                                    @endforeach
                                </div>
                            </div>

                            <div class="trip-info-item">
                                <div class="trip-info-label">Passengers</div>
                                <div class="trip-info-value">
                                    {{ $reservation->adults }} adults
                                    @if($reservation->children > 0)
                                        , {{ $reservation->children }} children
                                    @endif
                                </div>
                            </div>

                            <div class="trip-info-item">
                                <div class="trip-info-label">Booked On</div>
                                <div class="trip-info-value">
                                    {{ $reservation->created_at->format('M d, Y') }}
                                </div>
                            </div>

                            <div class="trip-info-item">
                                <div class="total-price">
                                    <div class="total-price-label">Total</div>
                                    <div class="total-price-amount">{{ $reservation->formatted_total_price }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- FOOTER -->
                    <div class="booking-card-footer">
                        <div class="footer-info">
                            <i class="fas fa-info-circle"></i>
                            <span>Arrive 30 minutes before departure</span>
                        </div>

                        <div class="footer-actions">
                            {{-- COMPLETED --}}
                            @if($isPastTrip)
                                <button class="btn-print" onclick="window.print()">
                                    <i class="fas fa-print"></i> Print
                                </button>

                                {{-- CANCELLED --}}
                            @elseif($reservation->status === 'cancelled')
                                {{-- no actions --}}

                                {{-- PENDING --}}
                            @elseif($reservation->status === 'pending')
                                <a href="{{ route('payment.page', $reservation->id) }}" class="btn-pay">
                                    <i class="fas fa-credit-card"></i> Pay Now
                                </a>

                                <button class="btn-cancel" data-bs-toggle="modal"
                                        data-bs-target="#cancelModal{{ $reservation->id }}">
                                    <i class="fas fa-times"></i> Cancel
                                </button>

                                {{-- CONFIRMED --}}
                            @elseif($reservation->status === 'confirmed')
                                <button class="btn-print" onclick="window.print()">
                                    <i class="fas fa-print"></i> Print
                                </button>

{{--                                @if($hoursSinceBooking <= 10)--}}
{{--                                    <button class="btn-cancel" data-bs-toggle="modal"--}}
{{--                                            data-bs-target="#cancelModal{{ $reservation->id }}">--}}
{{--                                        <i class="fas fa-times"></i> Cancel--}}
{{--                                    </button>--}}
{{--                                @endif--}}
                                @if($hoursSinceBooking <= 10 && $hoursUntilDeparture > 10)
                                    <button class="btn-cancel" data-bs-toggle="modal"
                                            data-bs-target="#cancelModal{{ $reservation->id }}">
                                        <i class="fas fa-times"></i> Cancel
                                    </button>
                                @endif

                            @endif
                        </div>
                    </div>
                </div>

                <!-- CANCEL MODAL -->
{{--                @if(--}}
{{--                    !$isPastTrip &&--}}
{{--                    (--}}
{{--                        $reservation->status === 'pending' ||--}}
{{--                        ($reservation->status === 'confirmed' && $hoursSinceBooking <= 10)--}}
{{--                    )--}}
{{--                )--}}
{{--                @if(--}}
{{--                    !$isPastTrip &&--}}
{{--                    $hoursUntilDeparture > 10 &&--}}
{{--                    (--}}
{{--                        $reservation->status === 'pending' ||--}}
{{--                        ($reservation->status === 'confirmed' && $hoursSinceBooking <= 10)--}}
{{--                    )--}}
                @if(
                        !$isPastTrip &&
                        $hoursUntilDeparture > 10 &&
                        ($reservation->status === 'pending' || ($reservation->status === 'confirmed' && $hoursSinceBooking <= 10))
                    )
                )

                <div class="modal fade" id="cancelModal{{ $reservation->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content modal-content-custom">
                                <div class="modal-header modal-header-custom">
                                    <h5 class="modal-title">
                                        <i class="fas fa-exclamation-triangle"></i> Cancel Reservation
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body modal-body-custom">
                                    Are you sure you want to cancel this reservation?
                                </div>

                                <div class="modal-footer modal-footer-custom">
                                    <button class="btn-modal-keep" data-bs-dismiss="modal">
                                        No, Keep Booking
                                    </button>

                                    <form action="{{ route('reservation.cancel', $reservation->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn-modal-cancel">
                                            Yes, Cancel
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            @endforeach

            <div class="d-flex justify-content-center">
                {{ $reservations->links() }}
            </div>
        @endif
    </div>
@endsection
