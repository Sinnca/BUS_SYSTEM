@extends('layouts.app')

@section('title', 'Search Results')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    /* Font Setup */
    h1, h2, h3, h4, h5, h6, .btn, .badge, strong, .card-title {
        font-family: 'Space Grotesk', sans-serif !important;
    }

    body, p, span, div, small, .text-muted {
        font-family: 'Inter', sans-serif !important;
    }

    /* Animated Hero Section with Rotating Colors */
    .search-results-hero {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border: 1px solid rgba(139, 92, 246, 0.2);
        border-radius: 24px;
        padding: 3rem 2.5rem;
        margin-bottom: 3rem;
        margin-top: 2rem;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
        position: relative;
        overflow: hidden;
        animation: fadeInDown 0.6s ease-out;
    }

    /* Rotating Color Animation for Top Border */
    .search-results-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #6366f1, #8b5cf6, #a855f7, #ec4899, #6366f1);
        background-size: 200% 100%;
        animation: rotateColors 3s linear infinite;
    }

    @keyframes rotateColors {
        0% { background-position: 0% 0%; }
        100% { background-position: 200% 0%; }
    }

    .search-results-hero h2 {
        color: #ffffff;
        font-size: 2.8rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
        letter-spacing: -1px;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    }

    .search-results-hero p {
        color: rgba(255, 255, 255, 0.7);
        font-size: 1.15rem;
        margin: 0;
        font-weight: 400;
    }

    /* Trip Type Badge */
    .trip-type-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white;
        padding: 0.6rem 1.2rem;
        border-radius: 30px;
        font-weight: 700;
        font-size: 0.95rem;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
        margin-top: 1rem;
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    /* Section Headers */
    .section-header {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border: 1px solid rgba(139, 92, 246, 0.2);
        border-left: 5px solid #8b5cf6;
        padding: 1.5rem 2rem;
        border-radius: 16px;
        margin-bottom: 2rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        position: relative;
        overflow: hidden;
        animation: slideInLeft 0.5s ease-out;
    }

    .section-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #6366f1, #8b5cf6, #a855f7, #ec4899, #6366f1);
        background-size: 200% 100%;
        animation: rotateColors 3s linear infinite;
    }

    .section-header h4 {
        color: #ffffff;
        font-weight: 800;
        font-size: 1.8rem;
        margin: 0;
        letter-spacing: -0.5px;
    }

    .section-header i {
        font-size: 1.5rem;
        margin-right: 12px;
        background: linear-gradient(135deg, #6366f1, #a855f7);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Enhanced Trip Cards */
    .trip-card {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border: 1px solid rgba(139, 92, 246, 0.2);
        border-radius: 24px;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        height: 100%;
        animation: fadeInUp 0.6s ease-out;
        animation-fill-mode: both;
    }

    .trip-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #6366f1, #8b5cf6, #a855f7);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .trip-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 50px rgba(99, 102, 241, 0.4);
        border-color: rgba(139, 92, 246, 0.6);
    }

    .trip-card:hover::before {
        opacity: 1;
    }

    /* Staggered Card Animations */
    .col-md-6:nth-child(1) .trip-card { animation-delay: 0.1s; }
    .col-md-6:nth-child(2) .trip-card { animation-delay: 0.2s; }
    .col-md-6:nth-child(3) .trip-card { animation-delay: 0.3s; }
    .col-md-6:nth-child(4) .trip-card { animation-delay: 0.4s; }
    .col-md-6:nth-child(5) .trip-card { animation-delay: 0.5s; }
    .col-md-6:nth-child(6) .trip-card { animation-delay: 0.6s; }

    .card-body {
        padding: 2rem;
    }

    /* Route Display */
    .route-display {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 2px solid rgba(139, 92, 246, 0.2);
    }

    .route-location {
        color: #ffffff;
        font-size: 1.3rem;
        font-weight: 800;
        flex: 1;
        letter-spacing: -0.5px;
    }

    .route-arrow {
        color: #a855f7;
        font-size: 1.5rem;
        animation: slideArrow 2s ease-in-out infinite;
    }

    @keyframes slideArrow {
        0%, 100% { transform: translateX(0); }
        50% { transform: translateX(8px); }
    }

    /* Trip Info Items */
    .trip-info-row {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .trip-info-item {
        display: flex;
        align-items: center;
        gap: 12px;
        color: #e0e7ff;
        font-size: 0.95rem;
        padding: 0.8rem;
        background: rgba(99, 102, 241, 0.08);
        border-radius: 12px;
        transition: all 0.3s ease;
        border: 1px solid transparent;
    }

    .trip-info-item:hover {
        background: rgba(99, 102, 241, 0.15);
        border-color: rgba(139, 92, 246, 0.3);
        transform: translateX(5px);
    }

    .trip-info-item i {
        color: #a855f7;
        width: 22px;
        text-align: center;
        font-size: 1.1rem;
    }

    /* Enhanced Badges */
    .badge {
        padding: 0.5rem 1rem;
        font-weight: 700;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        border-radius: 20px;
        text-transform: uppercase;
    }

    .bg-primary {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%) !important;
        box-shadow: 0 2px 10px rgba(99, 102, 241, 0.4);
    }

    .bg-secondary {
        background: linear-gradient(135deg, #64748b 0%, #475569 100%) !important;
        box-shadow: 0 2px 10px rgba(100, 116, 139, 0.4);
    }

    .bg-info {
        background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%) !important;
        box-shadow: 0 2px 10px rgba(6, 182, 212, 0.4);
    }

    /* Seats Display */
    .seats-indicator {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 0.4rem 0.9rem;
        border-radius: 20px;
        font-weight: 700;
        font-size: 0.9rem;
    }

    .text-success .seats-indicator {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        box-shadow: 0 2px 10px rgba(16, 185, 129, 0.3);
    }

    .text-warning .seats-indicator {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
        box-shadow: 0 2px 10px rgba(245, 158, 11, 0.3);
        animation: pulse 2s ease-in-out infinite;
    }

    /* Price Display */
    .price-section {
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.12) 0%, rgba(139, 92, 246, 0.12) 100%);
        border: 2px solid rgba(139, 92, 246, 0.3);
        border-radius: 16px;
        padding: 1.2rem;
        text-align: center;
        margin-bottom: 1.5rem;
    }

    .price-label {
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 0.4rem;
        font-weight: 600;
    }

    .price-amount {
        color: #ffffff;
        font-size: 2.2rem;
        font-weight: 800;
        letter-spacing: -1px;
    }

    .price-currency {
        color: #a855f7;
        font-size: 1.5rem;
    }

    /* Enhanced Buttons */
    .btn {
        font-weight: 700;
        padding: 0.9rem 1.8rem;
        border-radius: 14px;
        transition: all 0.3s ease;
        font-size: 1rem;
        letter-spacing: 0.3px;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        justify-content: center;
    }

    .btn-primary {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #7c3aed 0%, #a855f7 100%);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(99, 102, 241, 0.6);
    }

    .btn-success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
        color: white;
    }

    .btn-success:hover {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(16, 185, 129, 0.6);
        color: white;
    }

    .btn-secondary {
        background: linear-gradient(135deg, #64748b 0%, #475569 100%);
        box-shadow: 0 4px 15px rgba(100, 116, 139, 0.4);
    }

    .btn-secondary:hover {
        background: linear-gradient(135deg, #475569 0%, #334155 100%);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(100, 116, 139, 0.6);
    }

    .btn-outline-success {
        background: transparent;
        border: 2px solid #10b981;
        color: #10b981;
    }

    .btn-outline-success:hover {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        border-color: transparent;
    }

    /* Summary Card */
    .summary-card {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border: 2px solid rgba(139, 92, 246, 0.3);
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
        animation: fadeInUp 0.6s ease-out;
    }

    .summary-card h5 {
        color: #ffffff;
        font-weight: 800;
        font-size: 1.6rem;
        margin-bottom: 1.5rem;
        letter-spacing: -0.5px;
    }

    .summary-row {
        background: rgba(99, 102, 241, 0.08);
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 1rem;
    }

    .summary-row strong {
        color: #a855f7;
        font-size: 1rem;
    }

    .summary-row span {
        color: #e0e7ff;
        font-size: 0.95rem;
    }

    /* Alert Styling */
    .alert {
        border-radius: 16px;
        border: none;
        padding: 1.5rem;
        font-weight: 500;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        animation: fadeInUp 0.6s ease-out;
    }

    .alert-warning {
        background: linear-gradient(135deg, rgba(245, 158, 11, 0.15) 0%, rgba(217, 119, 6, 0.15) 100%);
        border-left: 4px solid #f59e0b;
        color: #fbbf24;
    }

    .alert i {
        font-size: 1.2rem;
        margin-right: 10px;
    }

    /* Animations */
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

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .search-results-hero {
            padding: 2rem 1.5rem;
            margin-top: 1.5rem;
        }

        .search-results-hero h2 {
            font-size: 2rem;
        }

        .section-header h4 {
            font-size: 1.4rem;
        }

        .route-location {
            font-size: 1.1rem;
        }

        .price-amount {
            font-size: 1.8rem;
        }

        .btn {
            padding: 0.8rem 1.4rem;
            font-size: 0.95rem;
        }
    }
</style>
@endpush

@section('content')
    <div class="container">
        <!-- Hero Section -->
        <div class="search-results-hero">
            <div class="d-flex justify-content-between align-items-start flex-wrap">
                <div>
                    <h2>
                        <i class="fas fa-search-location"></i> Search Results
                    </h2>
                    <p>Review and select your preferred travel options</p>
                    @if(session('search_params.is_round_trip'))
                        <div class="trip-type-badge">
                            <i class="fas fa-exchange-alt"></i>
                            Round Trip Search
                        </div>
                    @endif
                </div>
                <a href="{{ route('home') }}" class="btn btn-secondary mt-3 mt-md-0">
                    <i class="fas fa-arrow-left"></i> New Search
                </a>
            </div>
        </div>

        @if($trips->isEmpty())
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle"></i>
                No outbound trips found for your search criteria. Please try different dates or routes.
            </div>
            <a href="{{ route('home') }}" class="btn btn-primary">
                <i class="fas fa-search"></i> Search Again
            </a>
        @else
            <!-- Outbound Trips Section -->
            <div class="section-header">
                <h4>
                    <i class="fas fa-arrow-right"></i> Outbound Trips
                </h4>
            </div>

            <div class="row mb-5">
                @foreach($trips as $trip)
                    <div class="col-md-6 mb-4">
                        <div class="card trip-card">
                            <div class="card-body">
                                <!-- Route Display -->
                                <div class="route-display">
                                    <div class="route-location">{{ $trip->origin }}</div>
                                    <i class="fas fa-arrow-right route-arrow"></i>
                                    <div class="route-location">{{ $trip->destination }}</div>
                                </div>

                                <!-- Bus Type Badge -->
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="badge bg-{{ $trip->bus->bus_type === 'deluxe' ? 'primary' : 'secondary' }}">
                                        {{ $trip->bus->formatted_bus_type }}
                                    </span>
                                </div>

                                <!-- Trip Information -->
                                <div class="trip-info-row">
                                    <div class="trip-info-item">
                                        <i class="fas fa-calendar-alt"></i>
                                        <span><strong>{{ $trip->formatted_date }}</strong></span>
                                    </div>

                                    <div class="trip-info-item">
                                        <i class="fas fa-clock"></i>
                                        <span>Departure: <strong>{{ $trip->formatted_time }}</strong></span>
                                    </div>

                                    <div class="trip-info-item">
                                        <i class="fas fa-bus"></i>
                                        <span>Bus <strong>{{ $trip->bus->bus_number }}</strong></span>
                                    </div>

                                    <div class="trip-info-item">
                                        <i class="fas fa-chair"></i>
                                        <span>
                                            Available: 
                                            <strong class="text-{{ $trip->available_seats > 10 ? 'success' : 'warning' }}">
                                                <span class="seats-indicator">
                                                    <i class="fas fa-{{ $trip->available_seats > 10 ? 'check-circle' : 'exclamation-triangle' }}"></i>
                                                    {{ $trip->available_seats }} / {{ $trip->bus->capacity }}
                                                </span>
                                            </strong>
                                        </span>
                                    </div>
                                </div>

                                <!-- Price Section -->
                                <div class="price-section">
                                    <div class="price-label">Price per Seat</div>
                                    <div class="price-amount">
                                        <span class="price-currency">₱</span>{{ number_format($trip->price, 2) }}
                                    </div>
                                </div>

                                <!-- Action Button -->
                                @auth
                                    @if(session('search_params.is_round_trip'))
                                        <button class="btn btn-primary w-100 btn-select-outbound" data-trip-id="{{ $trip->id }}">
                                            <i class="fas fa-check-circle"></i> Select This Trip
                                        </button>
                                    @else
                                        <a href="{{ route('booking.seats', $trip) }}" class="btn btn-primary w-100">
                                            <i class="fas fa-chair"></i> Select Seats
                                        </a>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-primary w-100">
                                        <i class="fas fa-sign-in-alt"></i> Login to Book
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Return Trips Section -->
            @if($returnTrips !== null)
                <div class="section-header">
                    <h4>
                        <i class="fas fa-arrow-left"></i> Return Trips
                    </h4>
                </div>

                @if($returnTrips->isEmpty())
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i>
                        No return trips available for selected date. Please select outbound trip only or change dates.
                    </div>
                @else
                    <div class="row" id="return-trips-section" style="display: none;">
                        @foreach($returnTrips as $trip)
                            <div class="col-md-6 mb-4">
                                <div class="card trip-card">
                                    <div class="card-body">
                                        <!-- Route Display -->
                                        <div class="route-display">
                                            <div class="route-location">{{ $trip->origin }}</div>
                                            <i class="fas fa-arrow-left route-arrow"></i>
                                            <div class="route-location">{{ $trip->destination }}</div>
                                        </div>

                                        <!-- Bus Type Badge -->
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <span class="badge bg-{{ $trip->bus->bus_type === 'deluxe' ? 'primary' : 'secondary' }}">
                                                {{ $trip->bus->formatted_bus_type }}
                                            </span>
                                        </div>

                                        <!-- Trip Information -->
                                        <div class="trip-info-row">
                                            <div class="trip-info-item">
                                                <i class="fas fa-calendar-alt"></i>
                                                <span><strong>{{ $trip->formatted_date }}</strong></span>
                                            </div>

                                            <div class="trip-info-item">
                                                <i class="fas fa-clock"></i>
                                                <span>Departure: <strong>{{ $trip->formatted_time }}</strong></span>
                                            </div>

                                            <div class="trip-info-item">
                                                <i class="fas fa-chair"></i>
                                                <span>
                                                    Available: 
                                                    <strong>
                                                        <span class="seats-indicator" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white;">
                                                            {{ $trip->available_seats }} / {{ $trip->bus->capacity }}
                                                        </span>
                                                    </strong>
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Price Section -->
                                        <div class="price-section">
                                            <div class="price-label">Price per Seat</div>
                                            <div class="price-amount">
                                                <span class="price-currency">₱</span>{{ number_format($trip->price, 2) }}
                                            </div>
                                        </div>

                                        <!-- Action Button -->
                                        <button class="btn btn-success w-100 btn-select-return" data-trip-id="{{ $trip->id }}">
                                            <i class="fas fa-check-circle"></i> Select Return Trip
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Selected Trips Summary -->
                    <div id="selected-summary" style="display: none;" class="summary-card mb-4">
                        <h5><i class="fas fa-ticket-alt"></i> Selected Trips Summary</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="summary-row">
                                    <strong><i class="fas fa-arrow-right"></i> Outbound:</strong><br>
                                    <span id="outbound-summary"></span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="summary-row">
                                    <strong><i class="fas fa-arrow-left"></i> Return:</strong><br>
                                    <span id="return-summary"></span>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <form action="{{ route('booking.seats', ':tripId') }}" method="GET" id="proceed-form">
                                <input type="hidden" name="return_trip_id" id="return_trip_id">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-arrow-right"></i> Proceed to Seat Selection
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            @endif
        @endif
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let selectedOutbound = null;
        let selectedReturn = null;

        // Handle outbound trip selection
        document.querySelectorAll('.btn-select-outbound').forEach(btn => {
            btn.addEventListener('click', function() {
                selectedOutbound = this.dataset.tripId;

                // Visual feedback
                document.querySelectorAll('.btn-select-outbound').forEach(b => {
                    b.classList.remove('btn-success');
                    b.classList.add('btn-primary');
                    b.innerHTML = '<i class="fas fa-check-circle"></i> Select This Trip';
                });

                this.classList.remove('btn-primary');
                this.classList.add('btn-success');
                this.innerHTML = '<i class="fas fa-check"></i> Selected';

                // Show return trips section
                document.getElementById('return-trips-section').style.display = 'block';

                // Scroll to return trips
                document.getElementById('return-trips-section').scrollIntoView({ behavior: 'smooth' });

                // Update summary
                const card = this.closest('.card-body');
                const route = card.querySelector('.route-display').textContent.trim();
                const date = card.querySelectorAll('.trip-info-item')[0].textContent.trim();
                document.getElementById('outbound-summary').textContent = route + ' | ' + date;
            });
        });

        // Handle return trip selection
        document.querySelectorAll('.btn-select-return').forEach(btn => {
            btn.addEventListener('click', function() {
                if (!selectedOutbound) {
                    alert('Please select an outbound trip first!');
                    return;
                }

                selectedReturn = this.dataset.tripId;

                // Visual feedback
                document.querySelectorAll('.btn-select-return').forEach(b => {
                    b.classList.remove('btn-success');
                    b.classList.add('btn-outline-success');
                    b.innerHTML = '<i class="fas fa-check-circle"></i> Select Return Trip';
                });

                this.classList.remove('btn-outline-success');
                this.classList.add('btn-success');
                this.innerHTML = '<i class="fas fa-check"></i> Selected';

                // Update summary
                const card = this.closest('.card-body');
                const route = card.querySelector('.route-display').textContent.trim();
                const date = card.querySelectorAll('.trip-info-item')[0].textContent.trim();
                document.getElementById('return-summary').textContent = route + ' | ' + date;

                // Show summary and proceed button
                document.getElementById('selected-summary').style.display = 'block';
                document.getElementById('return_trip_id').value = selectedReturn;

                // Update form action
                const form = document.getElementById('proceed-form');
                form.action = form.action.replace(':tripId', selectedOutbound);

                // Scroll to summary
                document.getElementById('selected-summary').scrollIntoView({ behavior: 'smooth', block: 'center' });
            });
        });
    });
</script>