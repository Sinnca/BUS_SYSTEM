@extends('layouts.app')

@section('title', 'Available Trips')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap');

    .trips-container {
        font-family: 'Inter', sans-serif;
        animation: fadeIn 0.6s ease-out;
        padding-bottom: 50px;
    }

    /* Page Header with Rotating Gradient */
    .trips-hero {
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.08) 0%, rgba(139, 92, 246, 0.08) 100%);
        border-radius: 24px;
        padding: 45px 40px;
        margin-bottom: 40px;
        border: 2px solid rgba(99, 102, 241, 0.15);
        position: relative;
        overflow: hidden;
        animation: fadeInDown 0.6s ease-out;
    }

    .trips-hero::before {
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

    .trips-hero::after {
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

    .page-badge {
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

    .page-title {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 2.8rem;
        font-weight: 800;
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 10px;
        letter-spacing: -1.5px;
        line-height: 1.1;
        display: inline-flex;
        align-items: center;
        gap: 15px;
    }

    .page-title i {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Date Section Header */
    .date-section {
        margin-top: 45px;
        margin-bottom: 30px;
        animation: fadeInUp 0.6s ease-out both;
    }

    .date-header {
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.05) 0%, rgba(139, 92, 246, 0.05) 100%);
        border-left: 5px solid;
        border-image: linear-gradient(180deg, #6366f1 0%, #8b5cf6 100%) 1;
        padding: 20px 30px;
        border-radius: 16px;
        position: relative;
        overflow: hidden;
    }

    .date-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 5px;
        height: 100%;
        background: linear-gradient(180deg, #6366f1 0%, #8b5cf6 100%);
    }

    .date-title {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 1.8rem;
        font-weight: 800;
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .date-title i {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Origin Section */
    .origin-section {
        margin-top: 30px;
        margin-bottom: 25px;
    }

    .origin-header {
        background: white;
        border: 2px solid rgba(99, 102, 241, 0.15);
        border-radius: 14px;
        padding: 15px 25px;
        display: inline-block;
        box-shadow: 0 4px 15px rgba(99, 102, 241, 0.1);
    }

    .origin-title {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 1.3rem;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .origin-title i {
        color: #8b5cf6;
        font-size: 1.1rem;
    }

    /* Trip Cards */
    .trip-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 8px 30px rgba(99, 102, 241, 0.12);
        border: 2px solid rgba(99, 102, 241, 0.1);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
        position: relative;
        animation: fadeInUp 0.6s ease-out both;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .trip-card::before {
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

    .trip-card:hover::before {
        transform: scaleX(1);
    }

    .trip-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 50px rgba(99, 102, 241, 0.25);
        border-color: rgba(99, 102, 241, 0.25);
    }

    .trip-card-body {
        padding: 28px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .trip-route {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 1.4rem;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        line-height: 1.2;
    }

    .route-arrow {
        color: #8b5cf6;
        font-size: 1.2rem;
        font-weight: 700;
    }

    .trip-info {
        flex-grow: 1;
        margin-bottom: 20px;
    }

    .info-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 16px;
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.03) 0%, rgba(139, 92, 246, 0.03) 100%);
        border-radius: 12px;
        margin-bottom: 10px;
        transition: all 0.3s ease;
    }

    .info-item:hover {
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.08) 0%, rgba(139, 92, 246, 0.08) 100%);
        transform: translateX(5px);
    }

    .info-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        color: white;
        flex-shrink: 0;
    }

    .info-icon.time {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
    }

    .info-icon.bus {
        background: linear-gradient(135deg, #8b5cf6 0%, #a855f7 100%);
    }

    .info-icon.seats {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    }

    .info-icon.price {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    }

    .info-content {
        flex-grow: 1;
    }

    .info-label {
        font-size: 0.75rem;
        color: #64748b;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 2px;
    }

    .info-value {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 1rem;
        font-weight: 700;
        color: #1e293b;
    }

    .info-value.highlight {
        color: #10b981;
        font-size: 1.1rem;
    }

    .info-value.price-value {
        font-size: 1.3rem;
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .bus-type-badge {
        display: inline-block;
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.15) 0%, rgba(168, 85, 247, 0.15) 100%);
        color: #8b5cf6;
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.3px;
        margin-left: 8px;
    }

    .btn-view-trip {
        font-family: 'Space Grotesk', sans-serif;
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        color: white;
        border: none;
        padding: 14px 28px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 1rem;
        letter-spacing: 0.3px;
        text-transform: uppercase;
        transition: all 0.3s ease;
        width: 100%;
        box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .btn-view-trip:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(99, 102, 241, 0.4);
        background: linear-gradient(135deg, #5558e3 0%, #7c4ee8 100%);
        color: white;
    }

    .btn-view-trip i {
        transition: transform 0.3s ease;
    }

    .btn-view-trip:hover i {
        transform: translateX(5px);
    }

    /* Empty State */
    .empty-state {
        background: white;
        border: 2px solid rgba(99, 102, 241, 0.15);
        border-radius: 24px;
        padding: 80px 40px;
        text-align: center;
        box-shadow: 0 10px 40px rgba(99, 102, 241, 0.08);
    }

    .empty-icon {
        width: 120px;
        height: 120px;
        margin: 0 auto 30px;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, rgba(139, 92, 246, 0.1) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3.5rem;
        color: #8b5cf6;
        box-shadow: 0 8px 30px rgba(99, 102, 241, 0.2);
    }

    .empty-title {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 1.8rem;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 12px;
    }

    .empty-text {
        color: #64748b;
        font-size: 1.1rem;
        line-height: 1.6;
    }

    /* Pagination */
    .pagination-wrapper {
        margin-top: 50px;
        display: flex;
        justify-content: center;
    }

    .pagination-wrapper .pagination {
        gap: 8px;
    }

    .pagination-wrapper .page-link {
        font-family: 'Space Grotesk', sans-serif;
        font-weight: 700;
        border: 2px solid rgba(99, 102, 241, 0.2);
        color: #6366f1;
        border-radius: 10px;
        padding: 10px 18px;
        transition: all 0.3s ease;
    }

    .pagination-wrapper .page-link:hover {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        color: white;
        border-color: transparent;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
    }

    .pagination-wrapper .page-item.active .page-link {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        border-color: transparent;
        box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
    }

    .pagination-wrapper .page-item.disabled .page-link {
        background: rgba(99, 102, 241, 0.05);
        border-color: rgba(99, 102, 241, 0.1);
        color: #94a3b8;
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

    /* Stagger animations */
    .trip-card:nth-child(1) { animation-delay: 0.1s; }
    .trip-card:nth-child(2) { animation-delay: 0.2s; }
    .trip-card:nth-child(3) { animation-delay: 0.3s; }
    .trip-card:nth-child(4) { animation-delay: 0.4s; }
    .trip-card:nth-child(5) { animation-delay: 0.5s; }
    .trip-card:nth-child(6) { animation-delay: 0.6s; }

    /* Responsive */
    @media (max-width: 768px) {
        .page-title {
            font-size: 2rem;
        }

        .date-title {
            font-size: 1.4rem;
        }

        .trip-route {
            font-size: 1.2rem;
        }

        .trip-card-body {
            padding: 20px;
        }
    }
</style>

<div class="trips-container container">
    <!-- Hero Header -->
    <div class="trips-hero">
        <div class="hero-content">
            <span class="page-badge">
                <i class="fas fa-bus"></i> Browse Trips
            </span>
            <h2 class="page-title">
                <i class="fas fa-route"></i>
                Available Trips
            </h2>
        </div>
    </div>

    @if($trips->count() == 0)
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fas fa-info-circle"></i>
            </div>
            <h3 class="empty-title">No Trips Available</h3>
            <p class="empty-text">There are currently no trips scheduled. Please check back later.</p>
        </div>
    @endif

    @php
        // Group trips by departure date first
        $tripsByDate = $trips->groupBy(fn($trip) => $trip->formatted_date);
    @endphp

    @foreach($tripsByDate as $date => $dateTrips)
        <div class="date-section">
            <div class="date-header">
                <h4 class="date-title">
                    <i class="fas fa-calendar-day"></i>
                    {{ $date }}
                </h4>
            </div>
        </div>

        @php
            // Further group trips by origin
            $tripsByOrigin = $dateTrips->groupBy('origin');
        @endphp

        @foreach($tripsByOrigin as $origin => $originTrips)
            <div class="origin-section">
                <div class="origin-header">
                    <h5 class="origin-title">
                        <i class="fas fa-map-marker-alt"></i>
                        {{ $origin }}
                    </h5>
                </div>
            </div>

            <div class="row g-4">
                @foreach($originTrips as $trip)
                    <div class="col-md-4 mb-4">
                        <div class="trip-card">
                            <div class="trip-card-body">
                                <h6 class="trip-route">
                                    <span>{{ $trip->origin }}</span>
                                    <span class="route-arrow">→</span>
                                    <span>{{ $trip->destination }}</span>
                                </h6>

                                <div class="trip-info">
                                    <div class="info-item">
                                        <div class="info-icon time">
                                            <i class="fas fa-clock"></i>
                                        </div>
                                        <div class="info-content">
                                            <div class="info-label">Departure Time</div>
                                            <div class="info-value">{{ $trip->formatted_time }}</div>
                                        </div>
                                    </div>

                                    <div class="info-item">
                                        <div class="info-icon bus">
                                            <i class="fas fa-bus"></i>
                                        </div>
                                        <div class="info-content">
                                            <div class="info-label">Bus</div>
                                            <div class="info-value">
                                                {{ $trip->bus->bus_number }}
                                                <span class="bus-type-badge">{{ $trip->bus->bus_type }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="info-item">
                                        <div class="info-icon seats">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div class="info-content">
                                            <div class="info-label">Available Seats</div>
                                            <div class="info-value highlight">{{ $trip->available_seats }} seats</div>
                                        </div>
                                    </div>

                                    <div class="info-item">
                                        <div class="info-icon price">
                                            <i class="fas fa-money-bill"></i>
                                        </div>
                                        <div class="info-content">
                                            <div class="info-label">Price</div>
                                            <div class="info-value price-value">₱{{ number_format($trip->price, 2) }}</div>
                                        </div>
                                    </div>
                                </div>

                                <a href="{{ route('trips.show', $trip->id) }}" class="btn-view-trip">
                                    View Trip
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    @endforeach

    <div class="pagination-wrapper">
        {{ $trips->links() }}
    </div>
</div>
@endsection