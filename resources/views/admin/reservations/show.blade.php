{{-- ============================================================ --}}
{{-- FILE: resources/views/admin/reservations/show.blade.php --}}
{{-- ============================================================ --}}
@extends('layouts.admin')

@section('title', 'Reservation Details')

@section('content')
    <div class="row mb-3">
        <div class="col-md-6">
            <h1>Reservation Details</h1>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.reservations.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-{{ $reservation->status === 'confirmed' ? 'success' : ($reservation->status === 'pending' ? 'warning' : 'danger') }} text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <i class="fas fa-ticket-alt"></i> {{ $reservation->reservation_code }}
                </h4>
                <span class="badge bg-light text-dark fs-6">
                    {{ ucfirst($reservation->status) }}
                </span>
            </div>
        </div>
        <div class="card-body">
            <!-- Customer Information -->
            <h5 class="border-bottom pb-2 mb-3">
                <i class="fas fa-user text-primary"></i> Customer Information
            </h5>
            <div class="row mb-4">
                <div class="col-md-6">
                    <p><strong>Name:</strong> {{ $reservation->user->name }}</p>
                    <p><strong>Email:</strong> {{ $reservation->user->email }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Booking Date:</strong> {{ $reservation->created_at->format('M d, Y H:i A') }}</p>
                    <p><strong>Status:</strong>
                        <span class="badge bg-{{ $reservation->status === 'confirmed' ? 'success' : ($reservation->status === 'pending' ? 'warning' : 'danger') }}">
                            {{ ucfirst($reservation->status) }}
                        </span>
                    </p>
                </div>
            </div>

            <!-- Outbound Trip Information -->
            <h5 class="border-bottom pb-2 mb-3">
                <i class="fas fa-arrow-right text-primary"></i> Outbound Trip Information
            </h5>
            <div class="row mb-4">
                <div class="col-md-6">
                    <p><strong>Route:</strong> {{ $reservation->trip->origin }} → {{ $reservation->trip->destination }}</p>
                    <p><strong>Date:</strong> {{ $reservation->trip->formatted_date }}</p>
                    <p><strong>Time:</strong> {{ $reservation->trip->formatted_time }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Bus:</strong> {{ $reservation->trip->bus->bus_number }}</p>
                    <p><strong>Type:</strong>
                        <span class="badge bg-{{ $reservation->trip->bus->bus_type === 'deluxe' ? 'primary' : 'secondary' }}">
                            {{ $reservation->trip->bus->formatted_bus_type }}
                        </span>
                    </p>
                    <p><strong>Price per seat:</strong> {{ $reservation->trip->formatted_price }}</p>
                </div>
            </div>

            <!-- Return Trip (if exists) -->
            @if($reservation->return_trip_id)
                <h5 class="border-bottom pb-2 mb-3">
                    <i class="fas fa-arrow-left text-info"></i> Return Trip Information
                </h5>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <p><strong>Route:</strong> {{ $reservation->returnTrip->origin }} → {{ $reservation->returnTrip->destination }}</p>
                        <p><strong>Date:</strong> {{ $reservation->returnTrip->formatted_date }}</p>
                        <p><strong>Time:</strong> {{ $reservation->returnTrip->formatted_time }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Bus:</strong> {{ $reservation->returnTrip->bus->bus_number }}</p>
                        <p><strong>Type:</strong>
                            <span class="badge bg-{{ $reservation->returnTrip->bus->bus_type === 'deluxe' ? 'primary' : 'secondary' }}">
                                {{ $reservation->returnTrip->bus->formatted_bus_type }}
                            </span>
                        </p>
                    </div>
                </div>
            @endif

            <!-- Seat Information -->
            <h5 class="border-bottom pb-2 mb-3">
                <i class="fas fa-chair text-primary"></i> Seat Information
            </h5>
            <div class="row mb-4">
                <div class="col-md-12">
                    <p><strong>Outbound Trip Seats:</strong></p>
                    <div class="mb-3">
                        @foreach($reservation->reservedSeats->where('trip_id', $reservation->trip_id) as $seat)
                            <span class="badge bg-primary me-1 mb-1" style="font-size: 1rem; padding: 0.5rem 0.8rem;">
                                <i class="fas fa-chair"></i> Seat {{ $seat->seat_number }}
                            </span>
                        @endforeach
                    </div>

                    @if($reservation->return_trip_id)
                        <p><strong>Return Trip Seats:</strong></p>
                        <div class="mb-3">
                            @foreach($reservation->reservedSeats->where('trip_id', $reservation->return_trip_id) as $seat)
                                <span class="badge bg-info me-1 mb-1" style="font-size: 1rem; padding: 0.5rem 0.8rem;">
                                    <i class="fas fa-chair"></i> Seat {{ $seat->seat_number }}
                                </span>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <!-- Passenger Details -->
            <h5 class="border-bottom pb-2 mb-3">
                <i class="fas fa-users text-primary"></i> Passenger Details
            </h5>
            <div class="row mb-4">
                <div class="col-md-6">
                    <p><strong>Adults:</strong> {{ $reservation->adults }}</p>
                    <p><strong>Children:</strong> {{ $reservation->children }}</p>
                    <p><strong>Total Passengers:</strong> {{ $reservation->total_passengers }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Passenger Names:</strong></p>
                    <ul class="list-unstyled">
                        @foreach($reservation->passenger_names as $index => $name)
                            <li>
                                <i class="fas fa-user-circle text-secondary"></i>
                                {{ $index + 1 }}. {{ $name }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Payment Information (only if not cancelled) -->
            @if($reservation->status !== 'cancelled')
                <h5 class="border-bottom pb-2 mb-3">
                    <i class="fas fa-money-bill-wave text-primary"></i> Payment Information
                </h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card bg-light">
                            <div class="card-body">
                                <p class="mb-2">
                                    <strong>Outbound Trip:</strong><br>
                                    {{ $reservation->trip->formatted_price }} × {{ $reservation->total_passengers }} passengers
                                </p>
                                @if($reservation->return_trip_id)
                                    <p class="mb-2">
                                        <strong>Return Trip:</strong><br>
                                        {{ $reservation->returnTrip->formatted_price }} × {{ $reservation->total_passengers }} passengers
                                    </p>
                                @endif
                                <hr>
                                <h4 class="text-success mb-0">
                                    <strong>Total Amount: {{ $reservation->formatted_total_price }}</strong>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-light">
                            <div class="card-body">
                                <p><strong>Payment Status:</strong>
                                    <span class="badge bg-{{ $reservation->status === 'confirmed' ? 'success' : 'warning' }}">
                                        {{ ucfirst($reservation->status) }}
                                    </span>
                                </p>
                                <p><strong>Booking Date:</strong> {{ $reservation->created_at->format('M d, Y') }}</p>
                                <p><strong>Booking Time:</strong> {{ $reservation->created_at->format('H:i A') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Trip Status -->
            <div class="alert alert-info mt-4" role="alert">
                <i class="fas fa-info-circle"></i>
                <strong>Important Information:</strong>
                <ul class="mb-0 mt-2">
                    <li>Passenger must arrive at least 30 minutes before departure</li>
                    <li>Valid ID required for verification</li>
                    <li>This reservation is {{ $reservation->status === 'confirmed' ? 'confirmed and active' : ($reservation->status === 'pending' ? 'pending' : 'cancelled') }}</li>
                </ul>
            </div>
        </div>
        <div class="card-footer bg-light">
            <div class="row">
                <div class="col-md-6">
                    <small class="text-muted">
                        <i class="fas fa-clock"></i> Last updated: {{ $reservation->updated_at->diffForHumans() }}
                    </small>
                </div>
                <div class="col-md-6 text-end">
                    <button class="btn btn-secondary btn-sm" onclick="window.print()">
                        <i class="fas fa-print"></i> Print Details
                    </button>
                    <a href="{{ route('admin.reservations.index') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-list"></i> Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Booking Timeline -->
    <div class="card mt-4">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-history"></i> Booking Timeline</h5>
        </div>
        <div class="card-body">
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-marker bg-success"></div>
                    <div class="timeline-content">
                        <p class="mb-1"><strong>Booking Created</strong></p>
                        <small class="text-muted">{{ $reservation->created_at->format('M d, Y H:i A') }}</small>
                    </div>
                </div>
                @if($reservation->status === 'cancelled')
                    <div class="timeline-item">
                        <div class="timeline-marker bg-danger"></div>
                        <div class="timeline-content">
                            <p class="mb-1"><strong>Booking Cancelled</strong></p>
                            <small class="text-muted">{{ $reservation->updated_at->format('M d, Y H:i A') }}</small>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .timeline {
            position: relative;
            padding-left: 40px;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 10px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #dee2e6;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 20px;
        }

        .timeline-marker {
            position: absolute;
            left: -35px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 3px solid white;
            box-shadow: 0 0 0 2px #dee2e6;
        }

        .timeline-content {
            padding: 10px 15px;
            background: #f8f9fa;
            border-radius: 5px;
        }

        @media print {
            .btn, .card-footer, nav, footer {
                display: none !important;
            }
        }
    </style>
@endpush
