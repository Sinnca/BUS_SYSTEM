@extends('layouts.app')

@section('title', 'Booking Confirmed')

@push('styles')
    <style>
        body {
            min-height: 100vh;
        }
        
        .confirmation-container {
            padding-top: 3rem;
            padding-bottom: 3rem;
        }
        
        /* Success Animation */
        .success-checkmark {
            width: 120px;
            height: 120px;
            margin: 0 auto 2rem;
            position: relative;
            animation: scaleIn 0.5s ease-out;
        }
        
        .success-checkmark .check-icon {
            width: 120px;
            height: 120px;
            position: relative;
            border-radius: 50%;
            box-sizing: content-box;
            border: 6px solid #10b981;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            box-shadow: 0 20px 60px rgba(16, 185, 129, 0.5);
        }
        
        .success-checkmark .check-icon::before {
            top: 3px;
            left: -2px;
            width: 40px;
            transform-origin: 100% 50%;
            border-radius: 100px 0 0 100px;
        }
        
        .success-checkmark .check-icon::after {
            top: 0;
            left: 40px;
            width: 75px;
            transform-origin: 0 50%;
            border-radius: 0 100px 100px 0;
            animation: rotateCircle 4.25s ease-in;
        }
        
        .success-checkmark .icon-line {
            height: 6px;
            background-color: #ffffff;
            display: block;
            border-radius: 3px;
            position: absolute;
            z-index: 10;
        }
        
        .success-checkmark .icon-line.line-tip {
            top: 58px;
            left: 22px;
            width: 30px;
            transform: rotate(45deg);
            animation: iconLineTip 0.75s 0.3s ease-out forwards;
        }
        
        .success-checkmark .icon-line.line-long {
            top: 50px;
            right: 14px;
            width: 55px;
            transform: rotate(-45deg);
            animation: iconLineLong 0.75s 0.5s ease-out forwards;
        }
        
        .success-header {
            text-align: center;
            margin-bottom: 3rem;
            animation: fadeInUp 0.6s ease-out 0.3s both;
        }
        
        .success-header h1 {
            color: #ffffff;
            font-size: 2.5rem;
            font-weight: 900;
            margin-bottom: 1rem;
            text-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }
        
        .success-header p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.2rem;
            font-weight: 500;
        }
        
        /* Card Styling */
        .confirmation-card {
            background: #1e293b;
            border: 1px solid rgba(139, 92, 246, 0.2);
            border-radius: 24px;
            box-shadow: 0 25px 80px rgba(0, 0, 0, 0.6);
            overflow: hidden;
            animation: fadeInUp 0.6s ease-out 0.5s both;
        }
        
        .card-header {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border: none;
            padding: 1.75rem 2rem;
            border-bottom: 1px solid rgba(139, 92, 246, 0.2);
        }
        
        .card-header h4 {
            color: #ffffff;
            margin: 0;
            font-weight: 700;
            font-size: 1.4rem;
        }
        
        .card-header h4 i {
            margin-right: 10px;
        }
        
        .card-body {
            background: #1e293b;
            color: rgba(255, 255, 255, 0.9);
            padding: 2rem;
        }
        
        /* Reservation Code Box */
        .reservation-code-box {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.15) 0%, rgba(139, 92, 246, 0.15) 100%);
            border: 2px solid rgba(139, 92, 246, 0.4);
            border-radius: 16px;
            padding: 1.75rem;
            text-align: center;
            margin-bottom: 2rem;
            animation: pulse 2s ease-in-out infinite;
        }
        
        .reservation-code-box h5 {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .reservation-code-box h2 {
            color: #ffffff;
            font-size: 2.5rem;
            font-weight: 900;
            margin-bottom: 0.5rem;
            letter-spacing: 3px;
            text-shadow: 0 2px 8px rgba(139, 92, 246, 0.5);
        }
        
        .reservation-code-box small {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.9rem;
        }
        
        /* Section Headers */
        .section-header {
            color: #ffffff;
            font-size: 1.2rem;
            font-weight: 700;
            padding-bottom: 0.75rem;
            margin-bottom: 1.25rem;
            border-bottom: 2px solid rgba(139, 92, 246, 0.3);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .section-header i {
            color: #8b5cf6;
            font-size: 1.3rem;
        }
        
        /* Info Rows */
        .info-label {
            color: rgba(255, 255, 255, 0.7);
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .info-value {
            color: #ffffff;
            font-size: 1.05rem;
            font-weight: 600;
            margin-bottom: 1.25rem;
        }
        
        .info-value i {
            color: #8b5cf6;
            margin-right: 6px;
        }
        
        /* Badges */
        .badge.bg-primary {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%) !important;
            padding: 0.5rem 0.9rem;
            font-weight: 700;
            border-radius: 8px;
            font-size: 0.95rem;
            margin: 0.25rem;
        }
        
        /* Passenger List */
        .passenger-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .passenger-list li {
            background: rgba(15, 23, 42, 0.6);
            border: 2px solid rgba(139, 92, 246, 0.2);
            border-radius: 12px;
            padding: 0.9rem 1.2rem;
            margin-bottom: 0.75rem;
            color: #ffffff;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .passenger-list li:hover {
            border-color: rgba(139, 92, 246, 0.5);
            background: rgba(139, 92, 246, 0.1);
            transform: translateX(5px);
        }
        
        .passenger-list li i {
            color: #8b5cf6;
            margin-right: 12px;
            font-size: 1.1rem;
        }
        
        /* Total Price */
        .total-price-box {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.15) 0%, rgba(5, 150, 105, 0.15) 100%);
            border: 2px solid rgba(16, 185, 129, 0.4);
            border-radius: 16px;
            padding: 1.5rem;
            text-align: right;
        }
        
        .total-price-label {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .total-price-amount {
            color: #10b981;
            font-size: 2.5rem;
            font-weight: 900;
            text-shadow: 0 2px 8px rgba(16, 185, 129, 0.5);
            margin: 0;
        }
        
        /* Card Footer */
        .card-footer {
            background: rgba(15, 23, 42, 0.8);
            border-top: 1px solid rgba(139, 92, 246, 0.2);
            padding: 1.75rem 2rem;
        }
        
        /* Buttons */
        .btn-primary {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            border: none;
            font-weight: 700;
            padding: 0.9rem 1.5rem;
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
        
        .btn-outline-secondary {
            color: #ffffff;
            border: 2px solid rgba(139, 92, 246, 0.4);
            background: transparent;
            font-weight: 700;
            padding: 0.9rem 1.5rem;
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
        
        /* Alert Box */
        .alert-warning-custom {
            background: rgba(245, 158, 11, 0.15);
            border: 2px solid rgba(245, 158, 11, 0.4);
            border-radius: 16px;
            padding: 1.5rem;
            margin-top: 2rem;
            animation: fadeInUp 0.6s ease-out 0.7s both;
        }
        
        .alert-warning-custom h6 {
            color: #fbbf24;
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 1rem;
        }
        
        .alert-warning-custom h6 i {
            color: #f59e0b;
            margin-right: 8px;
        }
        
        .alert-warning-custom ul {
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 0;
        }
        
        .alert-warning-custom ul li {
            margin-bottom: 0.5rem;
            font-weight: 500;
        }
        
        /* Modal Styling */
        .modal-content {
            background: #1e293b;
            border: 2px solid rgba(139, 92, 246, 0.3);
            border-radius: 20px;
        }
        
        .modal-header {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            border-bottom: 1px solid rgba(139, 92, 246, 0.2);
            border-radius: 20px 20px 0 0;
        }
        
        .modal-header .modal-title {
            color: #ffffff;
            font-weight: 700;
        }
        
        .modal-header .btn-close {
            filter: brightness(0) invert(1);
        }
        
        .modal-body {
            color: rgba(255, 255, 255, 0.9);
            padding: 2rem;
            font-size: 1.05rem;
            line-height: 1.8;
        }
        
        .modal-body p {
            margin-bottom: 1rem;
        }
        
        .modal-body strong {
            color: #fbbf24;
            font-weight: 700;
        }
        
        .modal-footer {
            border-top: 1px solid rgba(139, 92, 246, 0.2);
            padding: 1.5rem 2rem;
        }
        
        /* Divider */
        hr {
            border-color: rgba(139, 92, 246, 0.2);
            opacity: 1;
            margin: 2rem 0;
        }
        
        /* Animations */
        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0);
            }
            to {
                opacity: 1;
                transform: scale(1);
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
        
        @keyframes iconLineTip {
            0% {
                width: 0;
                left: 1px;
                top: 19px;
            }
            54% {
                width: 0;
                left: 1px;
                top: 19px;
            }
            70% {
                width: 50px;
                left: -8px;
                top: 37px;
            }
            84% {
                width: 17px;
                left: 21px;
                top: 48px;
            }
            100% {
                width: 30px;
                left: 22px;
                top: 58px;
            }
        }
        
        @keyframes iconLineLong {
            0% {
                width: 0;
                right: 46px;
                top: 54px;
            }
            65% {
                width: 0;
                right: 46px;
                top: 54px;
            }
            84% {
                width: 55px;
                right: 0;
                top: 35px;
            }
            100% {
                width: 55px;
                right: 14px;
                top: 50px;
            }
        }
        
        @keyframes pulse {
            0%, 100% {
                box-shadow: 0 0 0 0 rgba(139, 92, 246, 0.4);
            }
            50% {
                box-shadow: 0 0 0 10px rgba(139, 92, 246, 0);
            }
        }
        
        @media (max-width: 768px) {
            .success-header h1 {
                font-size: 2rem;
            }
            
            .reservation-code-box h2 {
                font-size: 2rem;
            }
            
            .total-price-amount {
                font-size: 2rem;
            }
        }
        
        @media print {
            body {
                background: white !important;
            }
            
            .card-footer,
            .alert-warning-custom {
                display: none;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container confirmation-container">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-xl-8">
                <!-- Success Animation & Header -->
                <div class="success-checkmark">
                    <div class="check-icon">
                        <span class="icon-line line-tip"></span>
                        <span class="icon-line line-long"></span>
                    </div>
                </div>
                
                <div class="success-header">
                    <h1>Booking Confirmed!</h1>
                    <p>Your reservation has been successfully confirmed</p>
                </div>

                <!-- Reservation Details Card -->
                <div class="confirmation-card">
                    <div class="card-header">
                        <h4>
                            <i class="fas fa-ticket-alt"></i> Reservation Details
                        </h4>
                    </div>
                    <div class="card-body">
                        <!-- Reservation Code -->
                        <div class="reservation-code-box">
                            <h5>Reservation Code</h5>
                            <h2>{{ $reservation->reservation_code }}</h2>
                            <small>Please save this code for your reference</small>
                        </div>

                        <!-- Trip Details -->
                        <h5 class="section-header">
                            <i class="fas fa-route"></i> Outbound Trip Information
                        </h5>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="info-label">Route</div>
                                <div class="info-value">
                                    <i class="fas fa-map-marker-alt"></i>
                                    {{ $reservation->trip->origin }} → {{ $reservation->trip->destination }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-label">Date & Time</div>
                                <div class="info-value">
                                    <i class="fas fa-calendar"></i>
                                    {{ $reservation->trip->formatted_date }}<br>
                                    <i class="fas fa-clock"></i>
                                    {{ $reservation->trip->formatted_time }}
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="info-label">Bus Information</div>
                                <div class="info-value">
                                    <i class="fas fa-bus"></i>
                                    {{ $reservation->trip->bus->bus_number }}
                                    ({{ $reservation->trip->bus->formatted_bus_type }})
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-label">Seat Numbers</div>
                                <div class="info-value">
                                    @foreach($reservation->reservedSeats->where('trip_id', $reservation->trip_id) as $seat)
                                        <span class="badge bg-primary">{{ $seat->seat_number }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Return Trip (if round trip) -->
                        @if($reservation->is_round_trip)
                            <hr>
                            <h5 class="section-header">
                                <i class="fas fa-undo-alt"></i> Return Trip Information
                            </h5>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="info-label">Route</div>
                                    <div class="info-value">
                                        <i class="fas fa-map-marker-alt"></i>
                                        {{ $reservation->returnTrip->origin }} → {{ $reservation->returnTrip->destination }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-label">Date & Time</div>
                                    <div class="info-value">
                                        <i class="fas fa-calendar"></i>
                                        {{ $reservation->returnTrip->formatted_date }}<br>
                                        <i class="fas fa-clock"></i>
                                        {{ $reservation->returnTrip->formatted_time }}
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="info-label">Bus Information</div>
                                    <div class="info-value">
                                        <i class="fas fa-bus"></i>
                                        {{ $reservation->returnTrip->bus->bus_number }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-label">Seat Numbers</div>
                                    <div class="info-value">
                                        @foreach($reservation->reservedSeats->where('trip_id', $reservation->return_trip_id) as $seat)
                                            <span class="badge bg-primary">{{ $seat->seat_number }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Passengers -->
                        <hr>
                        <h5 class="section-header">
                            <i class="fas fa-users"></i> Passenger Information
                        </h5>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="info-label">Passengers</div>
                                <ul class="passenger-list">
                                    @foreach($reservation->passenger_names as $name)
                                        <li><i class="fas fa-user-circle"></i> {{ $name }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <!-- Payment Summary -->
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-label">Ticket Summary</div>
                                <div class="info-value">
                                    <i class="fas fa-user"></i> <strong>{{ $reservation->adults }}</strong> Adult(s)<br>
                                    <i class="fas fa-child"></i> <strong>{{ $reservation->children }}</strong> Child(ren)
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="total-price-box">
                                    <div class="total-price-label">Total Amount</div>
                                    <h3 class="total-price-amount">{{ $reservation->formatted_total_price }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6 mb-2 mb-md-0">
                                <a href="{{ route('dashboard') }}" class="btn btn-primary w-100">
                                    <i class="fas fa-home"></i> Go to Dashboard
                                </a>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-outline-secondary w-100" onclick="window.print()">
                                    <i class="fas fa-print"></i> Print Confirmation
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Important Notes -->
                <div class="alert-warning-custom">
                    <h6><i class="fas fa-exclamation-triangle"></i> Important Reminders</h6>
                    <ul>
                        <li><strong>Arrive Early:</strong> Please arrive at least 30 minutes before departure</li>
                        <li><strong>Valid ID:</strong> Bring a valid government-issued ID for verification</li>
                        <li><strong>Reservation Code:</strong> Show your reservation code to the conductor</li>
                        <li><strong>Non-Refundable:</strong> This reservation cannot be refunded after 24 hours</li>
                        <li><strong>Cancellation:</strong> You may only cancel within 24 hours of booking</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Cancellation Warning Modal -->
    <div class="modal fade" id="cancellationWarningModal" tabindex="-1" aria-labelledby="cancellationWarningLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancellationWarningLabel">
                        <i class="fas fa-exclamation-triangle"></i> Important Notice
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>You may cancel your reservation only within <strong>24 hours</strong> of booking.</p>
                    <p>After that, your trip is non-refundable, and you will need to book another trip if you wish to change your plans.</p>
                    <p>Please save your reservation code <strong>{{ $reservation->reservation_code }}</strong> for future reference.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                        <i class="fas fa-check"></i> I Understand
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Show cancellation modal on page load
            var cancellationModal = new bootstrap.Modal(document.getElementById('cancellationWarningModal'));
            cancellationModal.show();
        });
    </script>
@endpush