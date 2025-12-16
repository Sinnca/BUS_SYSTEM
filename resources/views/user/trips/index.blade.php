@extends('layouts.app')

@section('title', 'Available Trips')

@push('styles')
<style>
    /* Modern Trip Cards Section */
    /* UPDATED Hero Section - Matching Dashboard Header Design */
    .trips-hero {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border: 1px solid rgba(139, 92, 246, 0.2);
        border-radius: 20px;
        padding: 2.5rem;
        margin-bottom: 2.5rem;
        margin-top: 2rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        position: relative;
        overflow: hidden;
        animation: fadeInDown 0.6s ease-out;
    }

    .trips-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #6366f1, #8b5cf6, #a855f7);
    }

    .trips-hero h2 {
        color: #ffffff;
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
        letter-spacing: -0.5px;
    }

    .trips-hero p {
        color: rgba(255, 255, 255, 0.7);
        font-size: 1.1rem;
        margin: 0;
    }

    .date-section {
        margin-bottom: 3rem;
    }

    .date-header {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 16px;
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 20px rgba(99, 102, 241, 0.4);
        display: inline-flex;
        align-items: center;
        gap: 12px;
    }

    .date-header i {
        font-size: 1.3rem;
    }

    .origin-header {
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.8) 0%, rgba(139, 92, 246, 0.7) 100%);
        border: 1px solid rgba(139, 92, 246, 0.3);
        border-left: 4px solid #a855f7;
        color: #ffffff;
        font-size: 1.4rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        padding: 1rem 1.5rem;
        border-radius: 12px;
        display: flex;
        align-items: center;
        gap: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    .origin-header i {
        color: #a855f7;
        font-size: 1.3rem;
    }

    .trip-card {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border: 1px solid rgba(139, 92, 246, 0.2);
        border-radius: 20px;
        padding: 1.8rem;
        height: 100%;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
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
        transform: translateY(-8px);
        box-shadow: 0 20px 50px rgba(99, 102, 241, 0.3);
        border-color: rgba(139, 92, 246, 0.5);
    }

    .trip-card:hover::before {
        opacity: 1;
    }

    .trip-route {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 1.5rem;
        padding-bottom: 1.2rem;
        border-bottom: 2px solid rgba(139, 92, 246, 0.2);
    }

    .trip-location {
        color: #ffffff;
        font-size: 1.15rem;
        font-weight: 700;
        flex: 1;
    }

    .trip-arrow {
        color: #a855f7;
        font-size: 1.2rem;
        animation: slideArrow 2s ease-in-out infinite;
    }

    @keyframes slideArrow {
        0%, 100% { transform: translateX(0); }
        50% { transform: translateX(5px); }
    }

    /* Page Load Animations */
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

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    /* Apply staggered animations to sections */
    .date-section {
        animation: fadeInUp 0.6s ease-out;
    }

    .date-section:nth-child(1) {
        animation-delay: 0.1s;
    }

    .date-section:nth-child(2) {
        animation-delay: 0.2s;
    }

    .date-section:nth-child(3) {
        animation-delay: 0.3s;
    }

    .trip-card {
        animation: fadeInUp 0.6s ease-out;
        animation-fill-mode: both;
    }

    /* Stagger animation for trip cards in a row */
    .col-lg-4:nth-child(1) .trip-card {
        animation-delay: 0.1s;
    }

    .col-lg-4:nth-child(2) .trip-card {
        animation-delay: 0.2s;
    }

    .col-lg-4:nth-child(3) .trip-card {
        animation-delay: 0.3s;
    }

    .col-lg-4:nth-child(4) .trip-card {
        animation-delay: 0.4s;
    }

    .col-lg-4:nth-child(5) .trip-card {
        animation-delay: 0.5s;
    }

    .col-lg-4:nth-child(6) .trip-card {
        animation-delay: 0.6s;
    }

    .no-trips-container {
        animation: fadeIn 0.6s ease-out;
    }

    .trip-info {
        display: flex;
        flex-direction: column;
        gap: 0.9rem;
        margin-bottom: 1.5rem;
    }

    .trip-info-item {
        display: flex;
        align-items: center;
        gap: 12px;
        color: #e0e7ff;
        font-size: 0.95rem;
        padding: 0.6rem;
        background: rgba(99, 102, 241, 0.08);
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .trip-info-item:hover {
        background: rgba(99, 102, 241, 0.15);
        transform: translateX(3px);
    }

    .trip-info-item i {
        color: #a855f7;
        width: 20px;
        text-align: center;
        font-size: 1.1rem;
    }

    .trip-info-item strong {
        color: #ffffff;
        font-weight: 700;
    }

    .trip-price {
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.15) 0%, rgba(139, 92, 246, 0.15) 100%);
        border: 2px solid rgba(139, 92, 246, 0.3);
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 1.2rem;
        text-align: center;
    }

    .trip-price-label {
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 0.3rem;
    }

    .trip-price-amount {
        color: #ffffff;
        font-size: 2rem;
        font-weight: 800;
        letter-spacing: -0.5px;
    }

    .trip-price-currency {
        color: #a855f7;
        font-size: 1.3rem;
    }

    .btn-view-trip {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        color: white;
        border: none;
        padding: 0.9rem 1.5rem;
        border-radius: 12px;
        font-weight: 700;
        font-size: 1rem;
        width: 100%;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .btn-view-trip:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(99, 102, 241, 0.6);
        background: linear-gradient(135deg, #7c3aed 0%, #a855f7 100%);
        color: white;
    }

    .btn-view-trip i {
        transition: transform 0.3s ease;
    }

    .btn-view-trip:hover i {
        transform: translateX(3px);
    }

    .seats-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        padding: 0.4rem 0.9rem;
        border-radius: 20px;
        font-weight: 700;
        font-size: 0.9rem;
        box-shadow: 0 2px 10px rgba(16, 185, 129, 0.3);
    }

    .seats-badge.low-seats {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        box-shadow: 0 2px 10px rgba(239, 68, 68, 0.3);
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.8; }
    }

    .no-trips-container {
        text-align: center;
        padding: 5rem 2rem;
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border-radius: 24px;
        border: 2px dashed rgba(139, 92, 246, 0.3);
    }

    .no-trips-icon {
        font-size: 5rem;
        color: rgba(139, 92, 246, 0.3);
        margin-bottom: 1.5rem;
    }

    .no-trips-title {
        color: #ffffff;
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 0.8rem;
    }

    .no-trips-text {
        color: rgba(255, 255, 255, 0.6);
        font-size: 1.1rem;
    }

    /* Pagination Styling */
    .pagination {
        margin-top: 3rem;
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

    /* Responsive Design */
    @media (max-width: 768px) {
        .trips-hero {
            padding: 1.8rem;
            margin-top: 1.5rem;
        }

        .trips-hero h2 {
            font-size: 2rem;
        }

        .date-header {
            font-size: 1.2rem;
            padding: 0.8rem 1.2rem;
        }

        .origin-header {
            font-size: 1.15rem;
            padding: 0.8rem 1.2rem;
        }

        .trip-card {
            padding: 1.5rem;
        }

        .trip-location {
            font-size: 1rem;
        }

        .trip-price-amount {
            font-size: 1.6rem;
        }
    }
    .filter-card-user {
        background: white;
        border-radius: 16px;
        padding: 20px 25px;
        box-shadow: 0 4px 15px rgba(99, 102, 241, 0.1);
        border: 1px solid rgba(99, 102, 241, 0.1);
        margin-bottom: 25px;
    }

    .filter-input {
        border-radius: 12px;
        padding: 10px 14px;
        font-size: 0.95rem;
    }

    .btn-filter {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        color: white;
        font-weight: 600;
    }

    .btn-reset {
        background: #64748b;
        color: white;
        font-weight: 600;
    }
</style>
@endpush

@section('content')

    <!-- Hero Section - UPDATED TO MATCH DASHBOARD HEADER -->
    <div class="container">
        <div class="trips-hero">
            <h2>
                <i class="fas fa-route"></i> Available Trips
            </h2>
            <p>Book your journey across the Philippines with comfort and convenience</p>
        </div>
    </div>
    <div class="container mb-4">
        <div class="filter-card-user">
            <form action="{{ route('trips.index') }}" method="GET" class="row g-3 align-items-center">
                <div class="col-md-2">
                    <input type="text" name="origin" class="form-control filter-input" placeholder="🚩 Origin" value="{{ request('origin') }}">
                </div>
                <div class="col-md-2">
                    <input type="text" name="destination" class="form-control filter-input" placeholder="📍 Destination" value="{{ request('destination') }}">
                </div>
                <div class="col-md-2">
                    <input type="date" name="departure_date" class="form-control filter-input" value="{{ request('departure_date') }}">
                </div>
                <div class="col-md-2">
                    <select name="trip_status" class="form-select filter-input">
                        <option value="">All Trips</option>
                        <option value="upcoming" {{ request('trip_status') == 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                        <option value="past" {{ request('trip_status') == 'past' ? 'selected' : '' }}>Past</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-filter w-100">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('trips.index') }}" class="btn btn-reset w-100">
                        <i class="fas fa-times"></i> Reset
                    </a>
                </div>
            </form>
        </div>
    </div>


    <div class="container">
        @if($trips->count() == 0)
            <div class="no-trips-container">
                <div class="no-trips-icon">
                    <i class="fas fa-bus-alt"></i>
                </div>
                <h3 class="no-trips-title">No Trips Available</h3>
                <p class="no-trips-text">Check back later for upcoming schedules</p>
            </div>
        @else
            @php
                // Group trips by departure date first
                $tripsByDate = $trips->groupBy(fn($trip) => $trip->formatted_date);
            @endphp

            @foreach($tripsByDate as $date => $dateTrips)
                <div class="date-section">
                    <div class="date-header">
                        <i class="fas fa-calendar-day"></i>
                        {{ $date }}
                    </div>

                    @php
                        // Further group trips by origin
                        $tripsByOrigin = $dateTrips->groupBy('origin');
                    @endphp

                    @foreach($tripsByOrigin as $origin => $originTrips)
                        <h5 class="origin-header">
                            <i class="fas fa-map-marker-alt"></i>
                            From {{ $origin }}
                        </h5>

                        <div class="row">
                            @foreach($originTrips as $trip)
                                <div class="col-lg-4 col-md-6 mb-4">
                                    <div class="trip-card">
                                        <div class="trip-route">
                                            <div class="trip-location">{{ $trip->origin }}</div>
                                            <i class="fas fa-arrow-right trip-arrow"></i>
                                            <div class="trip-location">{{ $trip->destination }}</div>
                                        </div>

                                        <div class="trip-info">
                                            <div class="trip-info-item">
                                                <i class="fas fa-clock"></i>
                                                <span>Departure: <strong>{{ $trip->formatted_time }}</strong></span>
                                            </div>

                                            <div class="trip-info-item">
                                                <i class="fas fa-bus"></i>
                                                <span>Bus <strong>{{ $trip->bus->bus_number }}</strong> ({{ $trip->bus->bus_type }})</span>
                                            </div>

                                            <div class="trip-info-item">
                                                <i class="fas fa-chair"></i>
                                                <span>
                                                    Seats Available:
                                                    <span class="seats-badge {{ $trip->available_seats <= 5 ? 'low-seats' : '' }}">
                                                        <i class="fas fa-{{ $trip->available_seats <= 5 ? 'exclamation-triangle' : 'check-circle' }}"></i>
                                                        {{ $trip->available_seats }}
                                                    </span>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="trip-price">
                                            <div class="trip-price-label">Price per Seat</div>
                                            <div class="trip-price-amount">
                                                <span class="trip-price-currency">₱</span>{{ number_format($trip->price, 2) }}
                                            </div>
                                        </div>

                                        <a href="{{ route('trips.show', $trip->id) }}" class="btn btn-view-trip">
                                            View Details & Book
                                            <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            @endforeach

            <!-- Pagination -->
            @if($trips->hasPages())
                <nav aria-label="Trips Pagination">
                    <ul class="pagination justify-content-center flex-wrap">
                        {{-- Previous Page Link --}}
                        @if ($trips->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $trips->previousPageUrl() }}" rel="prev">&laquo;</a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($trips->links()->elements[0] as $page => $url)
                            @if ($page == $trips->currentPage())
                                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($trips->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $trips->nextPageUrl() }}" rel="next">&raquo;</a>
                            </li>
                        @else
                            <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                        @endif
                    </ul>
                </nav>
            @endif
        @endif
    </div>
@endsection
