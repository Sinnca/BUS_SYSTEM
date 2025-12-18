{{-- ============================================================ --}}
{{-- FILE: resources/views/user/booking/seat-selection.blade.php --}}
{{-- SEAT SELECTION MATCHING HOME PAGE DESIGN --}}
{{-- ============================================================ --}}
@extends('layouts.app')

@section('title', 'Select Seats')

@push('styles')
    <style>
        body {
            min-height: 100vh;
        }

        .page-header {
            background: #1e293b;
            border-radius: 24px;
            padding: 2rem 2.5rem;
            margin-bottom: 2rem;
            border: 1px solid rgba(139, 92, 246, 0.2);
        }

        .page-header h2 {
            color: #ffffff;
            margin: 0;
            font-weight: 700;
            font-size: 1.5rem;
        }

        .page-header .subtitle {
            color: rgba(255, 255, 255, 0.6);
            margin-top: 0.5rem;
            font-size: 0.95rem;
        }

        .seat-map {
            display: flex;
            flex-direction: column;
            gap: 10px;
            max-width: 400px;
            margin: 0 auto;
        }

        .seat-row {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .seat {
            width: 50px;
            height: 50px;
            border: 2px solid rgba(139, 92, 246, 0.3);
            background: #0f172a;
            border-radius: 12px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 700;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255, 255, 255, 0.5);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
        }

        .seat.available:hover {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            border-color: #8b5cf6;
            transform: scale(1.1);
            color: #ffffff;
            box-shadow: 0 8px 20px rgba(139, 92, 246, 0.5);
        }

        .seat.selected {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            color: white;
            border-color: #8b5cf6;
            box-shadow: 0 8px 20px rgba(139, 92, 246, 0.6);
            font-weight: 900;
        }

        .seat.reserved {
            background: rgba(15, 23, 42, 0.5);
            cursor: not-allowed;
            color: rgba(255, 255, 255, 0.2);
            border-color: rgba(139, 92, 246, 0.1);
        }

        .legend {
            display: flex;
            justify-content: center;
            gap: 25px;
            margin-top: 25px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 10px;
            color: rgba(255, 255, 255, 0.9);
            font-size: 14px;
            font-weight: 600;
        }

        .legend-box {
            width: 32px;
            height: 32px;
            border: 2px solid rgba(139, 92, 246, 0.3);
            border-radius: 8px;
        }

        .booking-summary {
            position: sticky;
            top: 20px;
        }

        .trip-section {
            margin-bottom: 40px;
            padding: 30px;
            border: 2px solid rgba(139, 92, 246, 0.2);
            border-radius: 24px;
            background: #1e293b;
            box-shadow: 0 25px 80px rgba(0, 0, 0, 0.6);
        }

        .trip-section.active {
            border-color: rgba(139, 92, 246, 0.5);
            background: #1e293b;
            box-shadow: 0 25px 80px rgba(139, 92, 246, 0.4);
        }

        .trip-section h4 {
            color: #ffffff;
            font-weight: 700;
            font-size: 1.3rem;
        }

        .trip-section h4 i {
            color: #8b5cf6;
        }

        .alert-info {
            background: rgba(15, 23, 42, 0.8);
            border: 2px solid rgba(139, 92, 246, 0.3);
            color: rgba(255, 255, 255, 0.9);
            border-radius: 16px;
            padding: 1.25rem;
        }

        .alert-info h5 {
            color: #ffffff;
            margin-bottom: 12px;
            font-weight: 700;
            font-size: 1.15rem;
        }

        .alert-info p {
            color: rgba(255, 255, 255, 0.7);
            margin: 0;
            font-size: 0.95rem;
        }

        .alert-info i {
            color: #8b5cf6;
        }

        .alert-warning {
            background: rgba(245, 158, 11, 0.1);
            border: 2px solid rgba(245, 158, 11, 0.4);
            color: #fbbf24;
            border-radius: 16px;
            padding: 1rem 1.25rem;
        }

        .alert-warning strong {
            color: #fbbf24;
            font-weight: 700;
        }

        .alert-warning i {
            color: #f59e0b;
        }

        .text-primary {
            color: #8b5cf6 !important;
        }

        .text-success {
            color: #10b981 !important;
        }

        .text-muted {
            color: rgba(255, 255, 255, 0.4) !important;
        }

        .card {
            background: #1e293b;
            border: 1px solid rgba(139, 92, 246, 0.2);
            border-radius: 24px;
            overflow: hidden;
        }

        .card-header.bg-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
            border: none;
            border-radius: 0 !important;
            padding: 1.5rem 1.75rem;
            border-bottom: 1px solid rgba(139, 92, 246, 0.2);
        }

        .card-header h5 {
            color: #ffffff;
            margin: 0;
            font-weight: 700;
            font-size: 1.15rem;
        }

        .card-header h5 i {
            color: rgba(255, 255, 255, 0.9);
            margin-right: 8px;
        }

        .card-body {
            background: #1e293b;
            color: rgba(255, 255, 255, 0.9);
            padding: 1.75rem;
        }

        .card-body strong {
            color: #ffffff;
            font-weight: 700;
        }

        .card-body hr {
            border-color: rgba(139, 92, 246, 0.2);
            opacity: 1;
            margin: 1.25rem 0;
        }

        .badge.bg-info {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%) !important;
            padding: 0.5rem 1rem;
            font-size: 14px;
            font-weight: 700;
            border-radius: 12px;
        }

        .badge.bg-primary {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%) !important;
            padding: 0.4rem 0.8rem;
            font-weight: 700;
            border-radius: 8px;
        }

        .front-indicator {
            background: #0f172a;
            color: rgba(255, 255, 255, 0.8);
            padding: 12px 55px;
            border-radius: 12px;
            display: inline-block;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
            border: 2px solid rgba(139, 92, 246, 0.3);
            font-weight: 700;
            font-size: 0.95rem;
        }

        .front-indicator i {
            color: #8b5cf6;
            margin-right: 8px;
        }

        .form-label {
            color: rgba(255, 255, 255, 0.9);
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .form-control, .form-control-sm {
            background: #0f172a;
            border: 2px solid rgba(139, 92, 246, 0.2);
            color: #ffffff;
            border-radius: 12px;
            padding: 0.65rem 0.85rem;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-control-sm:focus {
            background: #0f172a;
            border-color: #8b5cf6;
            color: #ffffff;
            box-shadow: 0 0 0 4px rgba(139, 92, 246, 0.2);
            outline: none;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.3);
        }

        .btn-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border: none;
            font-weight: 700;
            padding: 0.85rem 1.5rem;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(16, 185, 129, 0.4);
            transition: all 0.3s ease;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(16, 185, 129, 0.5);
        }

        .btn-success:disabled {
            background: rgba(15, 23, 42, 0.8);
            color: rgba(255, 255, 255, 0.3);
            box-shadow: none;
            transform: none;
            cursor: not-allowed;
        }

        .btn-primary {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            border: none;
            font-weight: 700;
            padding: 0.85rem 1.5rem;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(99, 102, 241, 0.4);
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #5a67d8 0%, #7c3aed 100%);
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(99, 102, 241, 0.5);
        }

        .btn-primary:disabled {
            background: rgba(15, 23, 42, 0.8);
            color: rgba(255, 255, 255, 0.3);
            box-shadow: none;
            transform: none;
            cursor: not-allowed;
        }

        .btn-secondary {
            background: rgba(15, 23, 42, 0.8);
            border: 2px solid rgba(139, 92, 246, 0.3);
            font-weight: 700;
            padding: 0.85rem 1.5rem;
            border-radius: 12px;
            transition: all 0.3s ease;
            color: #ffffff;
            font-size: 1rem;
        }

        .btn-secondary:hover {
            background: rgba(139, 92, 246, 0.2);
            border-color: #8b5cf6;
            transform: translateY(-2px);
            color: #ffffff;
        }

        .btn-outline-secondary {
            color: #ffffff;
            border: 2px solid rgba(139, 92, 246, 0.3);
            background: transparent;
            font-weight: 700;
            padding: 0.85rem 1.5rem;
            border-radius: 12px;
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .btn-outline-secondary:hover {
            background: rgba(139, 92, 246, 0.2);
            border-color: #8b5cf6;
            color: #ffffff;
            transform: translateY(-2px);
        }

        .price-row {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.95rem;
        }

        .price-row span:last-child {
            font-weight: 700;
            color: #ffffff;
        }

        .total-price {
            font-size: 1.75rem;
            font-weight: 900;
            color: #10b981 !important;
            text-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
        }

        /* Scrollbar styling */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #0f172a;
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(139, 92, 246, 0.5);
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #8b5cf6;
        }

        /* Loading spinner */
        .spinner-border-sm {
            color: #ffffff;
        }

        @media (max-width: 768px) {
            .page-header {
                padding: 1.5rem;
            }

            .trip-section {
                padding: 1.5rem;
            }

            .card-body {
                padding: 1.25rem;
            }

            .hero-features {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container py-4">
        <!-- Page Header -->
        <div class="page-header">
            <h2>
                <i class="fas fa-chair" style="color: #8b5cf6; margin-right: 10px;"></i>
                Select Your Seats
                @if($returnTrip)
                    <span class="badge bg-info ms-2">Round Trip</span>
                @endif
            </h2>
            <p class="subtitle mb-0">Choose your preferred seats for your journey</p>
        </div>

        <div class="row">
            <!-- Seat Maps -->
            <div class="col-lg-8">
                <!-- OUTBOUND TRIP -->
                <div class="trip-section active" id="outbound-section">
                    <h4 class="mb-3">
                        <i class="fas fa-arrow-right"></i> Outbound Trip
                    </h4>

                    <div class="alert alert-info">
                        <h5><i class="fas fa-route"></i> {{ $trip->origin }} → {{ $trip->destination }}</h5>
                        <p class="mb-0">
                            <i class="fas fa-calendar"></i> {{ $trip->formatted_date }} |
                            <i class="fas fa-clock"></i> {{ $trip->formatted_time }} |
                            <i class="fas fa-bus"></i> {{ $trip->bus->bus_number }} ({{ $trip->bus->formatted_bus_type }})
                        </p>
                    </div>

                    <div class="alert alert-warning">
                        <i class="fas fa-info-circle"></i>
                        Select <strong>{{ $search['adults'] + $search['children'] }}</strong> seat(s) for outbound trip
                    </div>

                    <!-- Outbound Seat Map -->
                    <div class="text-center mb-4">
                        <div class="front-indicator">
                            <i class="fas fa-steering-wheel"></i> FRONT
                        </div>
                    </div>

                    <div class="seat-map" id="outbound-seat-map">
                        @php
                            $capacity = $trip->bus->capacity;
                            $cols = 4;
                            $rows = ceil($capacity / $cols);
                        @endphp

                        @for($row = 1; $row <= $rows; $row++)
                            <div class="seat-row">
                                @for($col = 1; $col <= $cols; $col++)
                                    @php $seatNum = ($row - 1) * $cols + $col; @endphp

                                    @if($seatNum <= $capacity)
                                        @php $isReserved = in_array($seatNum, $reservedSeats); @endphp

                                        <button type="button"
                                                class="seat {{ $isReserved ? 'reserved' : 'available' }}"
                                                data-seat="{{ $seatNum }}"
                                                data-trip="outbound"
                                            {{ $isReserved ? 'disabled' : '' }}>
                                            {{ $seatNum }}
                                        </button>
                                    @else
                                        <div style="width: 50px;"></div>
                                    @endif

                                    @if($col == 2)
                                        <div style="width: 30px;"></div>
                                    @endif
                                @endfor
                            </div>
                        @endfor
                    </div>

                    <!-- Legend -->
                    <div class="legend mt-4">
                        <div class="legend-item">
                            <div class="legend-box" style="background: #0f172a;"></div>
                            <span>Available</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-box" style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);"></div>
                            <span>Selected</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-box" style="background: rgba(15, 23, 42, 0.5); border-color: rgba(139, 92, 246, 0.1);"></div>
                            <span>Reserved</span>
                        </div>
                    </div>
                </div>

                <!-- RETURN TRIP -->
                @if($returnTrip)
                    <div class="trip-section" id="return-section" style="display: none;">
                        <h4 class="mb-3">
                            <i class="fas fa-arrow-left"></i> Return Trip
                        </h4>

                        <div class="alert alert-info">
                            <h5><i class="fas fa-route"></i> {{ $returnTrip->origin }} → {{ $returnTrip->destination }}</h5>
                            <p class="mb-0">
                                <i class="fas fa-calendar"></i> {{ $returnTrip->formatted_date }} |
                                <i class="fas fa-clock"></i> {{ $returnTrip->formatted_time }} |
                                <i class="fas fa-bus"></i> {{ $returnTrip->bus->bus_number }}
                            </p>
                        </div>

                        <div class="alert alert-warning">
                            <i class="fas fa-info-circle"></i>
                            Select <strong>{{ $search['adults'] + $search['children'] }}</strong> seat(s) for return trip
                        </div>

                        <!-- Return Seat Map -->
                        <div class="text-center mb-4">
                            <div class="front-indicator">
                                <i class="fas fa-steering-wheel"></i> FRONT
                            </div>
                        </div>

                        <div class="seat-map" id="return-seat-map">
                            @php
                                $returnCapacity = $returnTrip->bus->capacity;
                                $returnRows = ceil($returnCapacity / 4);
                            @endphp

                            @for($row = 1; $row <= $returnRows; $row++)
                                <div class="seat-row">
                                    @for($col = 1; $col <= 4; $col++)
                                        @php $seatNum = ($row - 1) * 4 + $col; @endphp

                                        @if($seatNum <= $returnCapacity)
                                            @php $isReserved = in_array($seatNum, $returnReservedSeats); @endphp

                                            <button type="button"
                                                    class="seat {{ $isReserved ? 'reserved' : 'available' }}"
                                                    data-seat="{{ $seatNum }}"
                                                    data-trip="return"
                                                {{ $isReserved ? 'disabled' : '' }}>
                                                {{ $seatNum }}
                                            </button>
                                        @else
                                            <div style="width: 50px;"></div>
                                        @endif

                                        @if($col == 2)
                                            <div style="width: 30px;"></div>
                                        @endif
                                    @endfor
                                </div>
                            @endfor
                        </div>

                        <div class="legend mt-4">
                            <div class="legend-item">
                                <div class="legend-box" style="background: #0f172a;"></div>
                                <span>Available</span>
                            </div>
                            <div class="legend-item">
                                <div class="legend-box" style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);"></div>
                                <span>Selected</span>
                            </div>
                            <div class="legend-item">
                                <div class="legend-box" style="background: rgba(15, 23, 42, 0.5); border-color: rgba(139, 92, 246, 0.1);"></div>
                                <span>Reserved</span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Booking Summary -->
            <div class="col-lg-4">
                <div class="booking-summary">
                    <div class="card">
                        <div class="card-header bg-success">
                            <h5 class="mb-0">
                                <i class="fas fa-clipboard-check"></i> Booking Summary
                            </h5>
                        </div>
                        <div class="card-body">
                            <!-- Outbound Seats -->
                            <div class="mb-3">
                                <strong>Outbound Seats:</strong>
                                <div id="outbound-seats-display" class="mt-2">
                                    <span class="text-muted">No seats selected</span>
                                </div>
                            </div>

                            @if($returnTrip)
                                <div class="mb-3">
                                    <strong>Return Seats:</strong>
                                    <div id="return-seats-display" class="mt-2">
                                        <span class="text-muted">No seats selected</span>
                                    </div>
                                </div>
                            @endif

                            <hr>

                            <!-- Price Breakdown -->
                            <div class="mb-3">
                                <div class="d-flex justify-content-between price-row mb-2">
                                    <span>Outbound ({{$search['adults'] + $search['children']}} seats):</span>
                                    <span>{{ $trip->formatted_price }}</span>
                                </div>
                                @if($returnTrip)
                                    <div class="d-flex justify-content-between price-row mb-2">
                                        <span>Return ({{$search['adults'] + $search['children']}} seats):</span>
                                        <span>{{ $returnTrip->formatted_price }}</span>
                                    </div>
                                @endif
                                <hr>
                                <div class="d-flex justify-content-between align-items-center">
                                    <strong style="color: #ffffff; font-size: 1.1rem;">Total:</strong>
                                    <strong class="total-price" id="total-price">
                                        ₱{{ number_format(($trip->price + ($returnTrip ? $returnTrip->price : 0)) * ($search['adults'] + $search['children']), 2) }}
                                    </strong>
                                </div>
                            </div>

                            <hr>

                            <!-- Booking Form -->
                            <form action="{{ route('booking.store') }}" method="POST" id="booking-form">
                                @csrf

                                <input type="hidden" name="trip_id" value="{{ $trip->id }}">
                                @if($returnTrip)
                                    <input type="hidden" name="return_trip_id" value="{{ $returnTrip->id }}">
                                @endif

                                <!-- Hidden inputs for selected seats -->
                                <div id="outbound-seat-inputs"></div>
                                <div id="return-seat-inputs"></div>

                                <!-- Original search parameters -->
                                <input type="hidden" name="origin" value="{{ session('search_params')['origin'] }}">
                                <input type="hidden" name="destination" value="{{ session('search_params')['destination'] }}">
                                <input type="hidden" name="departure_date" value="{{ session('search_params')['departure_date'] }}">
                                <input type="hidden" name="adults" value="{{ session('search_params')['adults'] }}">
                                <input type="hidden" name="children" value="{{ session('search_params')['children'] }}">

                                <!-- Passenger Names -->
                                <div id="passenger-names" class="mb-3"></div>

                                <!-- Navigation & Submit Buttons -->
                                @if($returnTrip)
                                    <button type="button" class="btn btn-secondary w-100 mb-2" id="prev-btn" style="display: none;">
                                        <i class="fas fa-arrow-left"></i> Back to Outbound
                                    </button>
                                    <button type="button" class="btn btn-primary w-100 mb-2" id="next-btn" disabled>
                                        Continue to Return <i class="fas fa-arrow-right"></i>
                                    </button>
                                @endif

                                <button type="submit" class="btn btn-success btn-lg w-100" id="confirm-btn" disabled>
                                    <i class="fas fa-check"></i> Confirm Booking
                                </button>
                            </form>

                            <a href="{{ route('trips.search') }}" class="btn btn-outline-secondary w-100 mt-2">
                                <i class="fas fa-arrow-left"></i> Back to Search
                            </a>
                        </div>
                    </div>
                    <hr>
                    <style>
                        .cancellation-card {
                            max-width: 700px;
                            margin: 0 auto;
                            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
                            border-radius: 16px;
                            overflow: hidden;
                            box-shadow: 0 10px 30px rgba(251, 191, 36, 0.3);
                            border: 2px solid #fbbf24;
                        }

                        .card-header-modern {
                            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
                            padding: 24px 28px;
                            display: flex;
                            align-items: center;
                            gap: 12px;
                        }

                        .icon-wrapper {
                            background: rgba(255, 255, 255, 0.2);
                            width: 48px;
                            height: 48px;
                            border-radius: 12px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            backdrop-filter: blur(10px);
                        }

                        .icon-wrapper i {
                            font-size: 24px;
                            color: #ffffff;
                            animation: pulse 2s ease-in-out infinite;
                        }

                        @keyframes pulse {
                            0%, 100% {
                                transform: scale(1);
                            }
                            50% {
                                transform: scale(1.1);
                            }
                        }

                        .card-header-modern h5 {
                            margin: 0;
                            color: #ffffff;
                            font-size: 1.5rem;
                            font-weight: 700;
                            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                        }

                        .card-body-modern {
                            padding: 28px;
                            background: #ffffff;
                        }

                        .rules-list {
                            list-style: none;
                            padding: 0;
                            margin: 0;
                            display: flex;
                            flex-direction: column;
                            gap: 16px;
                        }

                        .rule-item {
                            display: flex;
                            align-items: start;
                            gap: 16px;
                            padding: 20px;
                            background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
                            border-radius: 12px;
                            border-left: 4px solid #f59e0b;
                            transition: all 0.3s ease;
                        }

                        .rule-item:hover {
                            transform: translateX(4px);
                            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.2);
                        }

                        .rule-icon {
                            flex-shrink: 0;
                            width: 36px;
                            height: 36px;
                            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
                            border-radius: 8px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            color: #ffffff;
                            font-weight: 700;
                            font-size: 1.1rem;
                            box-shadow: 0 4px 8px rgba(245, 158, 11, 0.3);
                        }

                        .rule-content {
                            flex: 1;
                            color: #78350f;
                            font-size: 1rem;
                            line-height: 1.6;
                        }

                        .rule-content strong {
                            color: #92400e;
                            font-weight: 700;
                        }

                        .rule-badge {
                            display: inline-block;
                            background: #f59e0b;
                            color: #ffffff;
                            padding: 2px 8px;
                            border-radius: 4px;
                            font-size: 0.75rem;
                            font-weight: 600;
                            margin-left: 4px;
                        }

                        .info-footer {
                            margin-top: 20px;
                            padding: 16px 20px;
                            background: #eff6ff;
                            border-radius: 10px;
                            border-left: 4px solid #3b82f6;
                            display: flex;
                            align-items: start;
                            gap: 12px;
                        }

                        .info-footer i {
                            color: #3b82f6;
                            font-size: 1.2rem;
                            margin-top: 2px;
                        }

                        .info-footer p {
                            margin: 0;
                            color: #1e40af;
                            font-size: 0.9rem;
                            line-height: 1.6;
                        }

                        @media (max-width: 640px) {
                            .card-header-modern {
                                padding: 20px;
                            }

                            .card-header-modern h5 {
                                font-size: 1.25rem;
                            }

                            .card-body-modern {
                                padding: 20px;
                            }

                            .rule-item {
                                padding: 16px;
                                gap: 12px;
                            }

                            .rule-content {
                                font-size: 0.9rem;
                            }
                        }
                    </style>
                    <div class="cancellation-card">
                        <!-- Header -->
                        <div class="card-header-modern">
                            <div class="icon-wrapper">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <h5>Cancellation Policy</h5>
                        </div>

                        <!-- Body -->
                        <div class="card-body-modern">
                            <ul class="rules-list">
                                <li class="rule-item">
                                    <div class="rule-icon">1</div>
                                    <div class="rule-content">
                                        You <strong>cannot cancel</strong> this reservation if it was booked more than <strong>10 hours ago</strong>
                                        <span class="rule-badge">Rule 1</span>
                                    </div>
                                </li>

                                <li class="rule-item">
                                    <div class="rule-icon">2</div>
                                    <div class="rule-content">
                                        You <strong>cannot cancel</strong> this reservation if the trip departs in <strong>10 hours or less</strong>
                                        <span class="rule-badge">Rule 2</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const maxSeats = {{ $search['adults'] + $search['children'] }};
                const hasReturnTrip = {{ $returnTrip ? 'true' : 'false' }};

                let outboundSeats = [];
                let returnSeats = [];
                let currentSection = 'outbound';

                const confirmBtn = document.getElementById('confirm-btn');
                const nextBtn = document.getElementById('next-btn');
                const prevBtn = document.getElementById('prev-btn');

                // Handle seat selection
                document.querySelectorAll('.seat.available').forEach(seat => {
                    seat.addEventListener('click', function() {
                        const seatNum = parseInt(this.dataset.seat);
                        const tripType = this.dataset.trip;

                        if (tripType === 'outbound') {
                            toggleSeat(this, seatNum, outboundSeats, 'outbound');
                        } else {
                            toggleSeat(this, seatNum, returnSeats, 'return');
                        }

                        updateForm();
                    });
                });

                function toggleSeat(element, seatNum, seatsArray, tripType) {
                    if (element.classList.contains('selected')) {
                        element.classList.remove('selected');
                        const index = seatsArray.indexOf(seatNum);
                        if (index > -1) seatsArray.splice(index, 1);
                    } else {
                        if (seatsArray.length >= maxSeats) {
                            alert(`You can only select ${maxSeats} seat(s)`);
                            return;
                        }
                        element.classList.add('selected');
                        seatsArray.push(seatNum);
                    }
                    seatsArray.sort((a, b) => a - b);
                }

                function updateForm() {
                    // Update seat displays
                    updateSeatDisplay('outbound', outboundSeats);
                    if (hasReturnTrip) updateSeatDisplay('return', returnSeats);

                    // Update hidden inputs and passenger names (always)
                    updateHiddenInputs();
                    updatePassengerNames();

                    // Update buttons
                    if (hasReturnTrip) {
                        // Next button is enabled only if outbound seats are fully selected
                        nextBtn.disabled = outboundSeats.length !== maxSeats;

                        // Confirm button enabled only if both outbound and return seats are fully selected
                        confirmBtn.disabled = !(outboundSeats.length === maxSeats && returnSeats.length === maxSeats);
                        confirmBtn.style.display = confirmBtn.disabled ? 'none' : 'block';
                    } else {
                        // Single trip
                        confirmBtn.disabled = outboundSeats.length !== maxSeats;
                        confirmBtn.style.display = 'block';
                    }
                }

                function updateSeatDisplay(tripType, seats) {
                    const displayId = tripType + '-seats-display';
                    const display = document.getElementById(displayId);

                    if (seats.length === 0) {
                        display.innerHTML = '<span class="text-muted">No seats selected</span>';
                    } else {
                        display.innerHTML = seats.map(s => `<span class="badge bg-primary me-1">${s}</span>`).join('');
                    }
                }

                function updateHiddenInputs() {
                    // Outbound seats
                    const outboundContainer = document.getElementById('outbound-seat-inputs');
                    outboundContainer.innerHTML = '';
                    outboundSeats.forEach(seat => {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'seat_numbers[]';
                        input.value = seat;
                        outboundContainer.appendChild(input);
                    });

                    // Return seats
                    if (hasReturnTrip) {
                        const returnContainer = document.getElementById('return-seat-inputs');
                        returnContainer.innerHTML = '';
                        returnSeats.forEach(seat => {
                            const input = document.createElement('input');
                            input.type = 'hidden';
                            input.name = 'return_seat_numbers[]';
                            input.value = seat;
                            returnContainer.appendChild(input);
                        });
                    }
                }

                function updatePassengerNames() {
                    const container = document.getElementById('passenger-names');
                    container.innerHTML = '<strong class="d-block mb-2">Passenger Names:</strong>';

                    // Outbound
                    outboundSeats.forEach((seat, index) => {
                        const div = document.createElement('div');
                        div.className = 'mb-2';
                        const label = document.createElement('label');
                        label.className = 'form-label small mb-1';
                        label.textContent = `Outbound Seat ${seat}:`;
                        const input = document.createElement('input');
                        input.type = 'text';
                        input.className = 'form-control form-control-sm';
                        input.name = 'passenger_names[]';
                        input.placeholder = 'Full Name';
                        input.required = true;
                        input.pattern = '[a-zA-Z\\s]+';
                        div.appendChild(label);
                        div.appendChild(input);
                        container.appendChild(div);
                    });

                    // Return
                    if (hasReturnTrip) {
                        returnSeats.forEach((seat, index) => {
                            const div = document.createElement('div');
                            div.className = 'mb-2';
                            const label = document.createElement('label');
                            label.className = 'form-label small mb-1';
                            label.textContent = `Return Seat ${seat}:`;
                            const input = document.createElement('input');
                            input.type = 'text';
                            input.className = 'form-control form-control-sm';
                            input.name = 'return_passenger_names[]';
                            input.placeholder = 'Full Name';
                            input.required = true;
                            input.pattern = '[a-zA-Z\\s]+';
                            div.appendChild(label);
                            div.appendChild(input);
                            container.appendChild(div);
                        });
                    }
                }

                // Navigation for round trip
                if (nextBtn) {
                    nextBtn.addEventListener('click', function() {
                        document.getElementById('outbound-section').style.display = 'none';
                        document.getElementById('return-section').style.display = 'block';
                        document.getElementById('return-section').classList.add('active');
                        document.getElementById('outbound-section').classList.remove('active');
                        prevBtn.style.display = 'block';
                        nextBtn.style.display = 'none';
                        currentSection = 'return';
                    });
                }

                if (prevBtn) {
                    prevBtn.addEventListener('click', function() {
                        document.getElementById('return-section').style.display = 'none';
                        document.getElementById('outbound-section').style.display = 'block';
                        document.getElementById('outbound-section').classList.add('active');
                        document.getElementById('return-section').classList.remove('active');
                        prevBtn.style.display = 'none';
                        nextBtn.style.display = 'block';
                        currentSection = 'outbound';
                    });
                }

                // Form submission
                document.getElementById('booking-form').addEventListener('submit', function(e) {
                    const requiredSeats = hasReturnTrip ? maxSeats * 2 : maxSeats;
                    const selectedSeats = outboundSeats.length + returnSeats.length;

                    if (selectedSeats < requiredSeats) {
                        e.preventDefault();
                        alert('Please select all required seats');
                        return false;
                    }

                    confirmBtn.disabled = true;
                    confirmBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Processing...';
                });
            });
        </script>
    @endpush
@endsection
