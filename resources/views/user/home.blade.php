@extends('layouts.app')

@section('title', 'Find Your Bus Trip')

@section('content')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Hero Banner - Light Theme - SHORTENED */
        .hero-banner {
            position: relative;
            height: 33rem;
            background: linear-gradient(135deg, #ffffff 0%, #faf5ff 50%, #f3e8ff 100%);
            margin: 0 -15px;
            overflow: hidden;
        }

        .hero-banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?w=1600&q=80');
            background-size: cover;
            background-position: center;
            opacity: 1;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.6) 0%, rgba(250, 245, 255, 0.6) 50%, rgba(99, 102, 241, 0.2) 100%), url('your-image-url.jpg');


        }

        .hero-content {
            position: relative;
            z-index: 2;
            padding-top: 60px;
            color: #6366f1;
            text-align: center;
        }

        .hero-badge {
            display: inline-block;
            background: rgba(99, 102, 241, 0.1);
            backdrop-filter: blur(10px);
            padding: 10px 24px;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 700;
            margin-bottom: 25px;
            border: 2px solid rgba(99, 102, 241, 0.3);
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.15);
            color: #6366f1;
            animation: fadeInDown 0.8s ease-out;
        }

        .hero-title {
            font-size: 4rem;
            font-weight: 900;
            margin-bottom: 20px;
            line-height: 1.2;
            letter-spacing: -1px;
            text-shadow: 0 2px 20px rgba(99, 102, 241, 0.2);
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: fadeInUp 0.8s ease-out 0.2s both;
        }

        .hero-subtitle {
            font-size: 1.35rem;
            opacity: 0.8;
            font-weight: 400;
            max-width: 600px;
            margin: 0 auto 40px;
            line-height: 1.6;
            color: #64748b;
            animation: fadeInUp 0.8s ease-out 0.4s both;
        }

        .hero-features {
            display: flex;
            justify-content: center;
            gap: 40px;
            margin-top: 30px;
        }

        .hero-feature {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1rem;
            font-weight: 600;
            background: rgba(99, 102, 241, 0.08);
            padding: 12px 24px;
            border-radius: 50px;
            border: 2px solid rgba(99, 102, 241, 0.2);
            color: #6366f1;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.1);
            animation: fadeInUp 0.8s ease-out both;
        }

        .hero-feature:nth-child(1) {
            animation-delay: 0.6s;
        }

        .hero-feature:nth-child(2) {
            animation-delay: 0.7s;
        }

        .hero-feature:nth-child(3) {
            animation-delay: 0.8s;
        }

        .hero-feature i {
            font-size: 1.3rem;
            color: #8b5cf6;
        }

        /* Booking Section */
        .booking-section {
            position: relative;
            margin-top: -120px;
            z-index: 10;
            padding-bottom: 80px;
            animation: fadeInUp 1s ease-out 0.5s both;
        }

        .booking-card {
            background: #1e293b;
            border-radius: 28px;
            box-shadow: 0 25px 80px rgba(0, 0, 0, 0.6);
            border: 1px solid rgba(139, 92, 246, 0.2);
            overflow: hidden;
        }

        .booking-header {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, rgba(139, 92, 246, 0.1) 100%);
            padding: 35px 45px;
            border-bottom: 1px solid rgba(139, 92, 246, 0.2);
        }

        .booking-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            margin: 0;
        }

        .booking-body {
            padding: 45px;
            background: #1e293b;
        }

        .trip-type-selector {
            background: rgba(15, 23, 42, 0.8);
            border-radius: 16px;
            padding: 8px;
            display: inline-flex;
            margin-bottom: 40px;
            border: 1px solid rgba(139, 92, 246, 0.2);
        }

        .trip-type-btn {
            border: none;
            background: transparent;
            padding: 14px 32px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.6);
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }

        .trip-type-btn.active {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
        }

        .trip-type-btn:hover:not(.active) {
            color: white;
            background: rgba(99, 102, 241, 0.2);
        }

        .trip-type-btn i {
            margin-right: 8px;
        }

        .form-group {
            margin-bottom: 28px;
        }

        .form-label-modern {
            display: flex;
            align-items: center;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 10px;
            font-size: 0.95rem;
        }

        .form-label-modern i {
            margin-right: 8px;
            font-size: 1.1rem;
        }

        .form-control-modern, .form-select-modern {
            border: 2px solid rgba(139, 92, 246, 0.2);
            border-radius: 14px;
            padding: 16px 20px;
            font-size: 1rem;
            transition: all 0.3s ease;
            width: 100%;
            background: #0f172a;
            color: white;
        }

        .form-control-modern:focus, .form-select-modern:focus {
            border-color: #8b5cf6;
            box-shadow: 0 0 0 4px rgba(139, 92, 246, 0.2);
            outline: none;
            background: #0f172a;
            color: white;
        }

        .form-control-modern:hover, .form-select-modern:hover {
            border-color: rgba(139, 92, 246, 0.4);
        }

        .form-control-modern::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        .form-select-modern option {
            background: #0f172a;
            color: white;
        }

        .input-with-icon {
            position: relative;
        }

        .input-icon-left {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(139, 92, 246, 0.6);
            pointer-events: none;
            z-index: 1;
        }

        .input-with-icon .form-control-modern {
            padding-left: 48px;
        }

        .search-btn-hero {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
            border: none;
            border-radius: 14px;
            padding: 18px 40px;
            font-size: 1.15rem;
            font-weight: 700;
            color: white;
            width: 100%;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            box-shadow: 0 10px 30px rgba(99, 102, 241, 0.5);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .search-btn-hero:hover {    
            transform: translateY(-3px);
            box-shadow: 0 20px 45px rgba(99, 102, 241, 0.6);
        }

        .search-btn-hero i {
            margin-right: 10px;
        }

        /* Popular Routes Section - Light Theme */
        .routes-section {
            padding: 100px 0;
            background: linear-gradient(135deg, #faf5ff 0%, #ffffff 50%, #f8f9fa 100%);
        }

        .section-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-badge {
            display: inline-block;
            background: rgba(99, 102, 241, 0.1);
            color: #6366f1;
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 700;
            margin-bottom: 15px;
            border: 2px solid rgba(99, 102, 241, 0.2);
            animation: fadeInDown 0.6s ease-out;
        }

        .section-title {
            font-size: 2.8rem;
            font-weight: 800;
            color: #6366f1;
            margin-bottom: 15px;
            animation: fadeInUp 0.6s ease-out 0.2s both;
        }

        .section-subtitle {
            font-size: 1.15rem;
            color: #64748b;
            max-width: 600px;
            margin: 0 auto;
            animation: fadeInUp 0.6s ease-out 0.4s both;
        }

        .route-card {
            border: none;
            border-radius: 24px;
            overflow: hidden;
            transition: all 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
            background: #ffffff;
            box-shadow: 0 8px 30px rgba(99, 102, 241, 0.15);
            height: 100%;
            border: 3px solid rgba(99, 102, 241, 0.15);
            position: relative;
            animation: fadeInUp 0.6s ease-out both;
        }

        .route-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.05) 0%, rgba(139, 92, 246, 0.05) 100%);
            opacity: 0;
            transition: opacity 0.5s ease;
            pointer-events: none;
            z-index: 1;
        }

        .route-card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .route-card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .route-card:nth-child(3) {
            animation-delay: 0.3s;
        }

        .route-card:nth-child(4) {
            animation-delay: 0.4s;
        }

        .route-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 30px 60px rgba(99, 102, 241, 0.3);
            border-color: rgba(99, 102, 241, 0.4);
        }

        .route-card:hover::before {
            opacity: 1;
        }

        .route-image {
            height: 200px;
            background-size: cover;
            background-position: center;
            position: relative;
            transition: transform 0.5s ease;
            overflow: hidden;
        }

        .route-card:hover .route-image {
            transform: scale(1.1);
        }

        .route-image::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(180deg, transparent 0%, rgba(255, 255, 255, 0.9) 100%);
        }

        .route-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            backdrop-filter: blur(10px);
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 700;
            color: white;
            z-index: 2;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.4);
            animation: pulse 2s ease-in-out infinite;
        }

        .route-content {
            padding: 28px;
            background: #ffffff;
            position: relative;
            z-index: 2;
        }

        .route-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: #6366f1;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
        }

        .route-card:hover .route-title {
            transform: translateX(5px);
        }

        .route-arrow {
            color: #8b5cf6;
            font-size: 1.2rem;
            transition: transform 0.3s ease;
        }

        .route-card:hover .route-arrow {
            transform: translateX(5px);
            animation: bounceX 0.6s ease-in-out;
        }

        .route-info {
            display: flex;
            gap: 20px;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 2px solid rgba(99, 102, 241, 0.1);
        }

        .route-info-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.9rem;
            color: #64748b;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .route-card:hover .route-info-item {
            color: #6366f1;
        }

        .route-info-item i {
            color: #8b5cf6;
            transition: transform 0.3s ease;
        }

        .route-card:hover .route-info-item i {
            transform: scale(1.2);
        }

        /* Trust Section - Light Theme */
        .trust-section {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            padding: 70px 0;
            color: white;
            margin-top: 0;
            position: relative;
            overflow: hidden;
            box-shadow: 0 -10px 40px rgba(99, 102, 241, 0.3);
        }

        .trust-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="40" fill="rgba(255,255,255,0.05)"/></svg>');
            background-size: 50px 50px;
        }

        .trust-stats {
            display: flex;
            justify-content: space-around;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .trust-stat {
            flex: 1;
        }

        .trust-number {
            font-size: 3rem;
            font-weight: 900;
            margin-bottom: 10px;
            text-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .trust-label {
            font-size: 1.1rem;
            opacity: 0.95;
            font-weight: 500;
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

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }

        @keyframes bounceX {
            0%, 100% {
                transform: translateX(5px);
            }
            50% {
                transform: translateX(10px);
            }
        }

        @media (max-width: 768px) {
            .hero-banner {
                height: 450px;
            }

            .hero-title {
                font-size: 2.5rem;
            }

            .hero-features {
                flex-direction: column;
                gap: 15px;
            }

            .booking-header, .booking-body {
                padding: 25px;
            }

            .section-title {
                font-size: 2rem;
            }

            .trust-stats {
                flex-direction: column;
                gap: 30px;
            }

            .hero-feature {
                font-size: 0.9rem;
                padding: 10px 20px;
            }
        }
    </style>

    <!-- Hero Banner -->
<div class="hero-banner" style="margin-bottom: 20px;">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div class="container">
            <div class="hero-badge" style="background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%); -webkit-background-clip: text; color: transparent;">
                <i class="fas fa-shield-alt"></i> Trusted by 1M+ Travelers
            </div>
            <h1 class="hero-title" style="font-size: 3rem; margin-bottom: 20px; background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%); -webkit-background-clip: text; color: transparent;">
                Travel Philippines<br>in Comfort & Style
            </h1>
            <p class="hero-subtitle" style="background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%); -webkit-background-clip: text; color: transparent;">Book your bus journey with ease. Experience premium comfort, reliable schedules, and unbeatable prices across the archipelago.</p>
            <div class="hero-features">
                <div class="hero-feature" style="background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);">
                    <i class="fas fa-check-circle"></i>
                    <span>Instant Booking</span>
                </div>
                <div class="hero-feature" style="background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);">
                    <i class="fas fa-check-circle"></i>
                    <span>Best Price Guarantee</span>
                </div>
                <div class="hero-feature" style="background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);">
                    <i class="fas fa-check-circle"></i>
                    <span>24/7 Support</span>
                </div>
            </div>
        </div>
    </div>
</div>


    <!-- Booking Section -->
    <div class="booking-section" style="margin-top: 40px;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-11 col-xl-10">
                    <div class="booking-card">
                        <div class="booking-header">
                            <h2 class="booking-title">
                                <i class="fas fa-ticket-alt" style="color: #8b5cf6; margin-right: 12px;"></i>
                                Find Your Perfect Trip
                            </h2>
                        </div>
                        <div class="booking-body">
                            <form action="{{ route('trips.search') }}" method="GET" id="searchForm">
                                <!-- Trip Type Selector -->
                                <div class="trip-type-selector">
                                    <button type="button" class="trip-type-btn active" id="oneWayBtn">
                                        <i class="fas fa-arrow-right"></i>One Way
                                    </button>
                                    <button type="button" class="trip-type-btn" id="roundTripBtn">
                                        <i class="fas fa-exchange-alt"></i>Round Trip
                                    </button>
                                </div>
                                <input type="radio" name="trip_type" id="oneWay" value="one_way" checked style="display: none;">
                                <input type="radio" name="trip_type" id="roundTrip" value="round_trip" style="display: none;">
                                <input type="hidden" name="is_round_trip" id="is_round_trip" value="0">

                                <!-- Location Fields -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label-modern">
                                                <i class="fas fa-map-marker-alt" style="color: #ef4444;"></i>
                                                Departure City
                                            </label>
                                            <div class="input-with-icon">
                                                <i class="fas fa-search input-icon-left"></i>
                                                <input type="text" class="form-control-modern" id="origin" name="origin"
                                                       list="origin-list" placeholder="Where are you leaving from?" required>
                                            </div>
                                            <datalist id="origin-list">
                                                <option value="Manila">
                                                <option value="Cebu">
                                                <option value="Davao">
                                                <option value="Baguio">
                                                <option value="Iloilo">
                                                <option value="Bacolod">
                                                <option value="Cagayan de Oro">
                                            </datalist>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label-modern">
                                                <i class="fas fa-map-marker-alt" style="color: #10b981;"></i>
                                                Destination City
                                            </label>
                                            <div class="input-with-icon">
                                                <i class="fas fa-search input-icon-left"></i>
                                                <input type="text" class="form-control-modern" id="destination" name="destination"
                                                       list="destination-list" placeholder="Where are you going?" required>
                                            </div>
                                            <datalist id="destination-list">
                                                <option value="Manila">
                                                <option value="Cebu">
                                                <option value="Davao">
                                                <option value="Baguio">
                                                <option value="Iloilo">
                                                <option value="Bacolod">
                                                <option value="Cagayan de Oro">
                                            </datalist>
                                        </div>
                                    </div>
                                </div>

                                <!-- Date Fields -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label-modern">
                                                <i class="fas fa-calendar-day" style="color: #6366f1;"></i>
                                                Departure Date
                                            </label>
                                            <input type="date" class="form-control-modern" id="departure_date"
                                                   name="departure_date" min="{{ date('Y-m-d') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6" id="return-date-group" style="display: none;">
                                        <div class="form-group">
                                            <label class="form-label-modern">
                                                <i class="fas fa-calendar-day" style="color: #8b5cf6;"></i>
                                                Return Date
                                            </label>
                                            <input type="date" class="form-control-modern" id="return_date" name="return_date">
                                        </div>
                                    </div>
                                </div>

                                <!-- Passenger & Bus Type -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label-modern">
                                                <i class="fas fa-user" style="color: #3b82f6;"></i>
                                                Adults
                                            </label>
                                            <select class="form-select-modern" id="adults" name="adults" required>
                                                @for($i = 1; $i <= 10; $i++)
                                                    <option value="{{ $i }}" {{ $i === 1 ? 'selected' : '' }}>{{ $i }} Adult{{ $i > 1 ? 's' : '' }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label-modern">
                                                <i class="fas fa-child" style="color: #f59e0b;"></i>
                                                Children
                                            </label>
                                            <select class="form-select-modern" id="children" name="children">
                                                @for($i = 0; $i <= 10; $i++)
                                                    <option value="{{ $i }}">{{ $i }} {{ $i === 1 ? 'Child' : 'Children' }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label-modern">
                                                <i class="fas fa-bus-alt" style="color: #06b6d4;"></i>
                                                Bus Type
                                            </label>
                                            <select class="form-select-modern" id="bus_type" name="bus_type">
                                                <option value="any">Any Type</option>
                                                <option value="deluxe">Deluxe (20 seats)</option>
                                                <option value="regular">Regular (40 seats)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="search-btn-hero">
                                    <i class="fas fa-search"></i> Search Available Trips
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Popular Routes -->
    <div class="routes-section">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">
                    <i class="fas fa-fire"></i> POPULAR ROUTES
                </span>
                <h2 class="section-title">Explore Top Destinations</h2>
                <p class="section-subtitle">Discover our most traveled routes with the best prices and schedules</p>
            </div>

            <div class="row">
                @php
                    $routeImages = [
                        'Manila → Baguio' => 'https://images.unsplash.com/photo-1555400038-63f5ba517a47?w=800&q=80',
                        'Manila → Cebu' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&q=80',
                        'Cebu → Davao' => 'https://images.unsplash.com/photo-1527004013197-933c4bb611b3?w=800&q=80',
                        'Baguio → Manila' => 'https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?w=800&q=80',
                    ];
                @endphp

                @foreach($popular_routes as $index => $route)
                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="route-card">
                            <div class="route-image" style="background-image: url('{{ $routeImages[$route['origin'] . ' → ' . $route['destination']] ?? 'https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?w=800&q=80' }}');">
                                <span class="route-badge">Popular</span>
                            </div>
                            <div class="route-content">
                                <h3 class="route-title">
                                    {{ $route['origin'] }}
                                    <span class="route-arrow">→</span>
                                    {{ $route['destination'] }}
                                </h3>
                                <div class="route-info">
                                    <div class="route-info-item">
                                        <i class="fas fa-clock"></i>
                                        <span>{{ rand(4, 12) }}h</span>
                                    </div>
                                    <div class="route-info-item">
                                        <i class="fas fa-tag"></i>
                                        <span>From ₱{{ rand(500, 1500) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const oneWayBtn = document.getElementById('oneWayBtn');
                const roundTripBtn = document.getElementById('roundTripBtn');
                const oneWay = document.getElementById('oneWay');
                const roundTrip = document.getElementById('roundTrip');
                const returnDateGroup = document.getElementById('return-date-group');
                const returnDateInput = document.getElementById('return_date');
                const isRoundTripInput = document.getElementById('is_round_trip');
                const departureDate = document.getElementById('departure_date');

                // Handle trip type toggle
                function toggleReturnDate(isRound) {
                    if (isRound) {
                        oneWayBtn.classList.remove('active');
                        roundTripBtn.classList.add('active');
                        oneWay.checked = false;
                        roundTrip.checked = true;
                        returnDateGroup.style.display = 'block';
                        returnDateInput.required = true;
                        isRoundTripInput.value = '1';
                    } else {
                        roundTripBtn.classList.remove('active');
                        oneWayBtn.classList.add('active');
                        roundTrip.checked = false;
                        oneWay.checked = true;
                        returnDateGroup.style.display = 'none';
                        returnDateInput.required = false;
                        isRoundTripInput.value = '0';
                    }
                }

                oneWayBtn.addEventListener('click', () => toggleReturnDate(false));
                roundTripBtn.addEventListener('click', () => toggleReturnDate(true));

                // Set minimum return date based on departure date
                departureDate.addEventListener('change', function() {
                    const nextDay = new Date(this.value);
                    nextDay.setDate(nextDay.getDate() + 1);
                    returnDateInput.min = nextDay.toISOString().split('T')[0];

                    // If return date is before new minimum, clear it
                    if (returnDateInput.value && new Date(returnDateInput.value) < nextDay) {
                        returnDateInput.value = '';
                    }
                });

                // Initialize
                toggleReturnDate(false);
            });
        </script>
    @endpush
@endsection