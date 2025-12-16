@extends('layouts.admin')

@section('title', 'Reservation Details')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap');

        .reservation-details-container {
            font-family: 'Inter', sans-serif;
            animation: fadeIn .6s ease-out
        }

        .reservation-details-header {
            background: linear-gradient(135deg, rgba(99, 102, 241, .05) 0%, rgba(139, 92, 246, .05) 100%);
            border-radius: 24px;
            padding: 35px 40px;
            margin-bottom: 30px;
            border: 2px solid rgba(99, 102, 241, .1);
            position: relative;
            overflow: hidden;
            animation: fadeInDown .6s ease-out
        }

        .reservation-details-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(139, 92, 246, .15) 0%, transparent 70%);
            animation: rotate 20s linear infinite
        }

        .header-content-details {
            position: relative;
            z-index: 1;
            display: flex;
            justify-content: space-between;
            align-items: center
        }

        .details-badge {
            display: inline-block;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            color: white;
            padding: 6px 16px;
            border-radius: 50px;
            font-size: .75rem;
            font-weight: 700;
            margin-bottom: 12px;
            box-shadow: 0 4px 12px rgba(99, 102, 241, .3);
            letter-spacing: .5px;
            text-transform: uppercase
        }

        .details-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 8px;
            letter-spacing: -1px
        }

        .btn-back {
            background: linear-gradient(135deg, #64748b 0%, #475569 100%);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 12px 24px;
            font-weight: 700;
            font-size: .95rem;
            font-family: 'Space Grotesk', sans-serif;
            transition: all .3s ease;
            box-shadow: 0 4px 15px rgba(100, 116, 139, .3);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px
        }

        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(100, 116, 139, .4);
            color: white
        }

        .info-card-sticky {
            background: white;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(99, 102, 241, .1);
            border: 2px solid rgba(99, 102, 241, .1);
            padding: 25px;
            position: sticky;
            top: 20px;
            animation: fadeInUp .6s ease-out .1s both
        }

        .info-card-sticky::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #06b6d4 0%, #0891b2 100%);
            border-radius: 20px 20px 0 0
        }

        .info-title {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 800;
            font-size: 1.1rem;
            color: #1e293b;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px
        }

        .info-list {
            list-style: none;
            padding: 0;
            margin: 0
        }

        .info-list li {
            padding: 10px 0;
            color: #475569;
            font-weight: 500;
            display: flex;
            gap: 10px
        }

        .info-list li::before {
            content: '✓';
            color: #06b6d4;
            font-weight: 800;
            font-size: 1.2rem
        }

        .details-card {
            background: white;
            border-radius: 24px;
            box-shadow: 0 10px 40px rgba(99, 102, 241, .08);
            border: 2px solid rgba(99, 102, 241, .1);
            overflow: hidden;
            animation: fadeInUp .6s ease-out .2s both;
            margin-bottom: 30px;
            position: relative
        }

        .details-card-header {
            padding: 25px 30px;
            position: relative
        }

        .details-card-header.status-confirmed {
            background: linear-gradient(135deg, rgba(16, 185, 129, .1) 0%, rgba(5, 150, 105, .1) 100%);
            border-bottom: 2px solid rgba(16, 185, 129, .2)
        }

        .details-card-header.status-pending {
            background: linear-gradient(135deg, rgba(245, 158, 11, .1) 0%, rgba(217, 119, 6, .1) 100%);
            border-bottom: 2px solid rgba(245, 158, 11, .2)
        }

        .details-card-header.status-cancelled {
            background: linear-gradient(135deg, rgba(239, 68, 68, .1) 0%, rgba(220, 38, 38, .1) 100%);
            border-bottom: 2px solid rgba(239, 68, 68, .2)
        }

        .details-card-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px
        }

        .details-card-header.status-confirmed::before {
            background: linear-gradient(90deg, #10b981 0%, #059669 100%)
        }

        .details-card-header.status-pending::before {
            background: linear-gradient(90deg, #f59e0b 0%, #d97706 100%)
        }

        .details-card-header.status-cancelled::before {
            background: linear-gradient(90deg, #ef4444 0%, #dc2626 100%)
        }

        .reservation-code {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 800;
            font-size: 1.5rem;
            margin: 0
        }

        .reservation-code.confirmed {
            color: #059669
        }

        .reservation-code.pending {
            color: #d97706
        }

        .reservation-code.cancelled {
            color: #dc2626
        }

        .status-badge-large {
            padding: 8px 20px;
            border-radius: 50px;
            font-size: .9rem;
            font-weight: 700;
            font-family: 'Space Grotesk', sans-serif;
            text-transform: uppercase;
            letter-spacing: .5px
        }

        .status-badge-large.confirmed {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white
        }

        .status-badge-large.pending {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white
        }

        .status-badge-large.cancelled {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white
        }

        .section-title {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 800;
            font-size: 1.2rem;
            color: #1e293b;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid rgba(99, 102, 241, .1);
            display: flex;
            align-items: center;
            gap: 10px
        }

        .info-label {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            color: #475569;
            margin-bottom: 5px
        }

        .info-value {
            color: #1e293b;
            font-weight: 600;
            margin-bottom: 15px
        }

        .seat-badge {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            color: white;
            padding: 8px 16px;
            border-radius: 10px;
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: .95rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-right: 8px;
            margin-bottom: 8px
        }

        .seat-badge.return {
            background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%)
        }

        .payment-card {
            background: linear-gradient(135deg, rgba(99, 102, 241, .05) 0%, rgba(139, 92, 246, .05) 100%);
            border: 2px solid rgba(99, 102, 241, .15);
            border-radius: 16px;
            padding: 20px
        }

        .total-amount {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 900;
            font-size: 1.8rem;
            color: #10b981;
            margin: 0
        }

        @keyframes fadeIn {
            from {
                opacity: 0
            }

            to {
                opacity: 1
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg)
            }

            to {
                transform: rotate(360deg)
            }
        }

        @media(max-width:992px) {
            .info-card-sticky {
                position: relative;
                top: 0;
                margin-bottom: 30px
            }
        }

        @media print {

            .btn,
            .footer-actions,
            nav,
            footer,
            .info-card-sticky {
                display: none !important
            }
        }
    </style>

    <div class="reservation-details-container">
        <div class="reservation-details-header">
            <div class="header-content-details">
                <div><span class="details-badge"><i class="fas fa-ticket-alt"></i> Booking Details</span>
                    <h1 class="details-title">Reservation Details</h1>
                    <p style="color:#64748b;font-size:1rem;font-weight:500">View complete booking information</p>
                </div>
                <a href="{{ route('admin.reservations.index') }}" class="btn-back"><i class="fas fa-arrow-left"></i> Back to
                    List</a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="details-card">
                    <div class="details-card-header status-{{ $reservation->status }}">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="reservation-code {{ $reservation->status }}"><i class="fas fa-ticket-alt"></i>
                                {{ $reservation->reservation_code }}</h4>
                            <span
                                class="status-badge-large {{ $reservation->status }}">{{ ucfirst($reservation->status) }}</span>
                        </div>
                    </div>
                    <div style="padding:30px">
                        <h5 class="section-title"><i class="fas fa-user"></i> Customer Information</h5>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <p class="info-label">Name</p>
                                <p class="info-value">{{ $reservation->user->name }}</p>
                                <p class="info-label">Email</p>
                                <p class="info-value">{{ $reservation->user->email }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="info-label">Booking Date</p>
                                <p class="info-value">{{ $reservation->created_at->format('M d, Y H:i A') }}</p>
                                <p class="info-label">Status</p>
                                <p class="info-value"><span class="status-badge-large {{ $reservation->status }}"
                                        style="font-size:.8rem;padding:6px 14px">{{ ucfirst($reservation->status) }}</span>
                                </p>
                            </div>
                        </div>

                        <h5 class="section-title"><i class="fas fa-arrow-right"></i> Outbound Trip Information</h5>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <p class="info-label">Route</p>
                                <p class="info-value" style="font-family:'Space Grotesk',sans-serif;font-weight:800">
                                    {{ $reservation->trip->origin }} → {{ $reservation->trip->destination }}</p>
                                <p class="info-label">Date</p>
                                <p class="info-value">{{ $reservation->trip->formatted_date }}</p>
                                <p class="info-label">Time</p>
                                <p class="info-value"
                                    style="font-family:'Space Grotesk',sans-serif;font-weight:700;color:#6366f1">
                                    {{ $reservation->trip->formatted_time }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="info-label">Bus</p>
                                <p class="info-value" style="font-family:'Space Grotesk',sans-serif;font-weight:700">
                                    {{ $reservation->trip->bus->bus_number }}</p>
                                <p class="info-label">Type</p>
                                <p class="info-value"><span
                                        style="background:linear-gradient(135deg,{{ $reservation->trip->bus->bus_type === 'deluxe' ? '#6366f1 0%,#8b5cf6 100%' : '#64748b 0%,#475569 100%' }});color:white;padding:6px 14px;border-radius:50px;font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:.8rem">{{ $reservation->trip->bus->formatted_bus_type }}</span>
                                </p>
                                <p class="info-label">Price per seat</p>
                                <p class="info-value" style="font-family:'Space Grotesk',sans-serif;font-weight:700">
                                    {{ $reservation->trip->formatted_price }}</p>
                            </div>
                        </div>

                        @if($reservation->return_trip_id)
                            <h5 class="section-title"><i class="fas fa-arrow-left"></i> Return Trip Information</h5>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <p class="info-label">Route</p>
                                    <p class="info-value" style="font-family:'Space Grotesk',sans-serif;font-weight:800">
                                        {{ $reservation->returnTrip->origin }} → {{ $reservation->returnTrip->destination }}</p>
                                    <p class="info-label">Date</p>
                                    <p class="info-value">{{ $reservation->returnTrip->formatted_date }}</p>
                                    <p class="info-label">Time</p>
                                    <p class="info-value"
                                        style="font-family:'Space Grotesk',sans-serif;font-weight:700;color:#06b6d4">
                                        {{ $reservation->returnTrip->formatted_time }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="info-label">Bus</p>
                                    <p class="info-value" style="font-family:'Space Grotesk',sans-serif;font-weight:700">
                                        {{ $reservation->returnTrip->bus->bus_number }}</p>
                                    <p class="info-label">Type</p>
                                    <p class="info-value"><span
                                            style="background:linear-gradient(135deg,{{ $reservation->returnTrip->bus->bus_type === 'deluxe' ? '#6366f1 0%,#8b5cf6 100%' : '#64748b 0%,#475569 100%' }});color:white;padding:6px 14px;border-radius:50px;font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:.8rem">{{ $reservation->returnTrip->bus->formatted_bus_type }}</span>
                                    </p>
                                </div>
                            </div>
                        @endif

                        <h5 class="section-title"><i class="fas fa-chair"></i> Seat Information</h5>
                        <div class="mb-4">
                            <p class="info-label">Outbound Trip Seats</p>
                            <div class="mb-3">
                                @foreach($reservation->reservedSeats->where('trip_id', $reservation->trip_id) as $seat)<span
                                    class="seat-badge"><i class="fas fa-chair"></i> Seat
                                {{ $seat->seat_number }}</span>@endforeach</div>
                            @if($reservation->return_trip_id)
                                <p class="info-label">Return Trip Seats</p>
                                <div class="mb-3">
                                    @foreach($reservation->reservedSeats->where('trip_id', $reservation->return_trip_id) as $seat)<span
                                        class="seat-badge return"><i class="fas fa-chair"></i> Seat
                                    {{ $seat->seat_number }}</span>@endforeach</div>
                            @endif
                        </div>

                        <h5 class="section-title"><i class="fas fa-users"></i> Passenger Details</h5>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <p class="info-label">Adults</p>
                                <p class="info-value">{{ $reservation->adults }}</p>
                                <p class="info-label">Children</p>
                                <p class="info-value">{{ $reservation->children }}</p>
                                <p class="info-label">Total Passengers</p>
                                <p class="info-value"
                                    style="font-family:'Space Grotesk',sans-serif;font-weight:800;color:#6366f1">
                                    {{ $reservation->total_passengers }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="info-label">Passenger Names</p>
                                <ul style="list-style:none;padding:0">
                                    @foreach($reservation->passenger_names as $index => $name)<li style="margin-bottom:8px"><i
                                        class="fas fa-user-circle" style="color:#8b5cf6"></i>
                                    <strong>{{ $index + 1 }}.</strong> {{ $name }}</li>@endforeach</ul>
                            </div>
                        </div>

                        @if($reservation->status !== 'cancelled')
                            <h5 class="section-title"><i class="fas fa-money-bill-wave"></i> Payment Information</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="payment-card">
                                        <p class="info-label">Outbound Trip</p>
                                        <p class="info-value">{{ $reservation->trip->formatted_price }} ×
                                            {{ $reservation->total_passengers }} passengers</p>
                                        @if($reservation->return_trip_id)
                                            <p class="info-label">Return Trip</p>
                                            <p class="info-value">{{ $reservation->returnTrip->formatted_price }} ×
                                        {{ $reservation->total_passengers }} passengers</p>@endif
                                        <hr style="border-color:rgba(99,102,241,.2)">
                                        <p class="info-label">Total Amount</p>
                                        <h4 class="total-amount">{{ $reservation->formatted_total_price }}</h4>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="payment-card">
                                        <p class="info-label">Payment Status</p>
                                        <p class="info-value"><span class="status-badge-large {{ $reservation->status }}"
                                                style="font-size:.8rem;padding:6px 14px">{{ ucfirst($reservation->status) }}</span>
                                        </p>
                                        <p class="info-label">Booking Date</p>
                                        <p class="info-value">{{ $reservation->created_at->format('M d, Y') }}</p>
                                        <p class="info-label">Booking Time</p>
                                        <p class="info-value">{{ $reservation->created_at->format('H:i A') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div
                        style="padding:20px 30px;background:linear-gradient(135deg,rgba(99,102,241,.02) 0%,rgba(139,92,246,.02) 100%);border-top:2px solid rgba(99,102,241,.1);display:flex;justify-content:space-between;align-items:center">
                        <small style="color:#64748b"><i class="fas fa-clock"></i> Last updated:
                            {{ $reservation->updated_at->diffForHumans() }}</small>
                        <div><button
                                style="background:linear-gradient(135deg,#64748b 0%,#475569 100%);color:white;border:none;border-radius:10px;padding:10px 20px;font-weight:700;font-size:.9rem;font-family:'Space Grotesk',sans-serif;box-shadow:0 2px 8px rgba(100,116,139,.3);margin-right:8px"
                                onclick="window.print()"><i class="fas fa-print"></i> Print</button>
                            <a href="{{ route('admin.reservations.index') }}"
                                style="background:linear-gradient(135deg,#6366f1 0%,#8b5cf6 100%);color:white;border:none;border-radius:10px;padding:10px 20px;font-weight:700;font-size:.9rem;font-family:'Space Grotesk',sans-serif;box-shadow:0 2px 8px rgba(99,102,241,.3);text-decoration:none"><i
                                    class="fas fa-list"></i> Back to List</a>
                        </div>
                    </div>
                </div>

                <div
                    style="background:white;border-radius:24px;box-shadow:0 10px 40px rgba(99,102,241,.08);border:2px solid rgba(99,102,241,.1);overflow:hidden;position:relative;margin-top:30px">
                    <div
                        style="position:absolute;top:0;left:0;width:100%;height:4px;background:linear-gradient(90deg,#6366f1 0%,#8b5cf6 50%,#a855f7 100%)">
                    </div>
                    <div
                        style="padding:25px 30px;background:linear-gradient(135deg,rgba(99,102,241,.02) 0%,rgba(139,92,246,.02) 100%);border-bottom:2px solid rgba(99,102,241,.1)">
                        <h5 style="font-family:'Space Grotesk',sans-serif;font-weight:800;color:#1e293b;margin:0"><i
                                class="fas fa-history"></i> Booking Timeline</h5>
                    </div>
                    <div style="padding:30px">
                        <div style="position:relative;padding-left:40px">
                            <div style="position:absolute;left:10px;top:0;bottom:0;width:2px;background:#e2e8f0"></div>
                            <div style="position:relative;margin-bottom:20px">
                                <div
                                    style="position:absolute;left:-35px;width:20px;height:20px;border-radius:50%;background:#10b981;border:3px solid white;box-shadow:0 0 0 2px #e2e8f0">
                                </div>
                                <div style="padding:10px 15px;background:#f8f9fa;border-radius:8px">
                                    <p style="margin-bottom:5px;font-weight:700;font-family:'Space Grotesk',sans-serif">
                                        Booking Created</p>
                                    <small
                                        style="color:#64748b">{{ $reservation->created_at->format('M d, Y H:i A') }}</small>
                                </div>
                            </div>
                            @if($reservation->status === 'cancelled')
                                <div style="position:relative">
                                    <div
                                        style="position:absolute;left:-35px;width:20px;height:20px;border-radius:50%;background:#ef4444;border:3px solid white;box-shadow:0 0 0 2px #e2e8f0">
                                    </div>
                                    <div style="padding:10px 15px;background:#f8f9fa;border-radius:8px">
                                        <p style="margin-bottom:5px;font-weight:700;font-family:'Space Grotesk',sans-serif">
                                            Booking Cancelled</p>
                                        <small
                                            style="color:#64748b">{{ $reservation->updated_at->format('M d, Y H:i A') }}</small>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="info-card-sticky">
                    <h5 class="info-title"><i class="fas fa-info-circle"></i> Important Information</h5>
                    <ul class="info-list">
                        <li>Passenger must arrive at least 30 minutes before departure</li>
                        <li>Valid ID required for verification</li>
                        <li>This reservation is
                            {{ $reservation->status === 'confirmed' ? 'confirmed and active' : ($reservation->status === 'pending' ? 'pending' : 'cancelled') }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection