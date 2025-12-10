@extends('layouts.app')

@section('title', 'Booking Confirmed')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Success Message -->
                <div class="text-center mb-4">
                    <i class="fas fa-check-circle text-success" style="font-size: 5rem;"></i>
                    <h1 class="mt-3">Booking Confirmed!</h1>
                    <p class="lead">Your reservation has been successfully confirmed</p>
                </div>

                <!-- Reservation Details -->
                <div class="card shadow-lg">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0">Reservation Details</h4>
                    </div>
                    <div class="card-body">
                        <!-- Reservation Code -->
                        <div class="alert alert-info text-center">
                            <h5 class="mb-0">Reservation Code</h5>
                            <h2 class="mb-0">{{ $reservation->reservation_code }}</h2>
                            <small>Please save this code for your reference</small>
                        </div>

                        <!-- Trip Details -->
                        <h5 class="border-bottom pb-2">Trip Information</h5>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <strong>Route:</strong><br>
                                {{ $reservation->trip->origin }} → {{ $reservation->trip->destination }}
                            </div>
                            <div class="col-md-6">
                                <strong>Date & Time:</strong><br>
                                {{ $reservation->trip->formatted_date }}<br>
                                {{ $reservation->trip->formatted_time }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <strong>Bus:</strong><br>
                                {{ $reservation->trip->bus->bus_number }}
                                ({{ $reservation->trip->bus->formatted_bus_type }})
                            </div>
                            <div class="col-md-6">
                                <strong>Seats:</strong><br>
                                @foreach($reservation->reservedSeats->where('trip_id', $reservation->trip_id) as $seat)
                                    <span class="badge bg-primary">{{ $seat->seat_number }}</span>
                                @endforeach
                            </div>
                        </div>

                        <!-- Return Trip (if round trip) -->
                        @if($reservation->is_round_trip)
                            <hr>
                            <h5 class="border-bottom pb-2">Return Trip</h5>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong>Route:</strong><br>
                                    {{ $reservation->returnTrip->origin }} → {{ $reservation->returnTrip->destination }}
                                </div>
                                <div class="col-md-6">
                                    <strong>Date & Time:</strong><br>
                                    {{ $reservation->returnTrip->formatted_date }}<br>
                                    {{ $reservation->returnTrip->formatted_time }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong>Bus:</strong><br>
                                    {{ $reservation->returnTrip->bus->bus_number }}
                                </div>
                                <div class="col-md-6">
                                    <strong>Seats:</strong><br>
                                    @foreach($reservation->reservedSeats->where('trip_id', $reservation->return_trip_id) as $seat)
                                        <span class="badge bg-primary">{{ $seat->seat_number }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Passengers -->
                        <hr>
                        <h5 class="border-bottom pb-2">Passenger Information</h5>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <strong>Passengers:</strong>
                                <ul class="list-unstyled mt-2">
                                    @foreach($reservation->passenger_names as $name)
                                        <li><i class="fas fa-user"></i> {{ $name }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <!-- Payment -->
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <strong>Adults:</strong> {{ $reservation->adults }}<br>
                                <strong>Children:</strong> {{ $reservation->children }}
                            </div>
                            <div class="col-md-6 text-end">
                                <strong>Total Amount:</strong><br>
                                <h3 class="text-success mb-0">{{ $reservation->formatted_total_price }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-light">
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
                <div class="alert alert-warning mt-4">
                    <h6><i class="fas fa-exclamation-triangle"></i> Important Reminders:</h6>
                    <ul class="mb-0">
                        <li>Please arrive at least 30 minutes before departure</li>
                        <li>Bring a valid ID for verification</li>
                        <li>Show your reservation code to the conductor</li>
                        <li>This reservation is non-refundable</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
