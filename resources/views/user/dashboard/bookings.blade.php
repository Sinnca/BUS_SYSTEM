@extends('layouts.app')

@section('title', 'My Bookings')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-6">
                <h1>My Bookings</h1>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('home') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Book New Trip
                </a>
            </div>
        </div>

        @if($reservations->isEmpty())
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> You don't have any bookings yet.
                <a href="{{ route('home') }}" class="alert-link">Book your first trip!</a>
            </div>
        @else
            @foreach($reservations as $reservation)
                <div class="card mb-3">
                    <div class="card-header {{ $reservation->status === 'confirmed' ? 'bg-success' : 'bg-danger' }} text-white">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h5 class="mb-0">
                                    <i class="fas fa-ticket-alt"></i> {{ $reservation->reservation_code }}
                                </h5>
                            </div>
                            <div class="col-md-4 text-end">
                            <span class="badge bg-light text-dark">
                                {{ ucfirst($reservation->status) }}
                            </span>
                                @if($reservation->is_round_trip)
                                    <span class="badge bg-info">Round Trip</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Outbound Trip -->
                        <div class="row mb-3">
                            <div class="col-12">
                                <h6 class="text-primary">
                                    <i class="fas fa-arrow-right"></i> Outbound Trip
                                </h6>
                            </div>
                            <div class="col-md-4">
                                <strong>Route:</strong><br>
                                {{ $reservation->trip->origin }} → {{ $reservation->trip->destination }}
                            </div>
                            <div class="col-md-4">
                                <strong>Date & Time:</strong><br>
                                {{ $reservation->trip->formatted_date }}<br>
                                {{ $reservation->trip->formatted_time }}
                            </div>
                            <div class="col-md-4">
                                <strong>Bus:</strong><br>
                                {{ $reservation->trip->bus->bus_number }}
                                <span class="badge bg-secondary">{{ $reservation->trip->bus->formatted_bus_type }}</span>
                            </div>
                        </div>

                        <!-- Return Trip -->
                        @if($reservation->return_trip_id)
                            <hr>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <h6 class="text-primary">
                                        <i class="fas fa-arrow-left"></i> Return Trip
                                    </h6>
                                </div>
                                <div class="col-md-4">
                                    <strong>Route:</strong><br>
                                    {{ $reservation->returnTrip->origin }} → {{ $reservation->returnTrip->destination }}
                                </div>
                                <div class="col-md-4">
                                    <strong>Date & Time:</strong><br>
                                    {{ $reservation->returnTrip->formatted_date }}<br>
                                    {{ $reservation->returnTrip->formatted_time }}
                                </div>
                                <div class="col-md-4">
                                    <strong>Bus:</strong><br>
                                    {{ $reservation->returnTrip->bus->bus_number }}
                                </div>
                            </div>
                        @endif

                        <hr>

                        <!-- Booking Details -->
                        <div class="row">
                            <div class="col-md-3">
                                <strong>Seats:</strong><br>
                                @foreach($reservation->reservedSeats as $seat)
                                    <span class="badge bg-primary">{{ $seat->seat_number }}</span>
                                @endforeach
                            </div>
                            <div class="col-md-3">
                                <strong>Passengers:</strong><br>
                                {{ $reservation->adults }} adults
                                @if($reservation->children > 0)
                                    , {{ $reservation->children }} children
                                @endif
                            </div>
                            <div class="col-md-3">
                                <strong>Booked On:</strong><br>
                                {{ $reservation->created_at->format('M d, Y') }}
                            </div>
                            <div class="col-md-3 text-end">
                                <strong>Total:</strong><br>
                                <h4 class="text-success mb-0">{{ $reservation->formatted_total_price }}</h4>
                            </div>
                        </div>

                        <!-- Passenger Names -->
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <strong>Passenger Names:</strong><br>
                                <ul class="list-inline mb-0">
                                    @foreach($reservation->passenger_names as $name)
                                        <li class="list-inline-item">
                                            <i class="fas fa-user"></i> {{ $name }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-light">
                        <div class="row">
                            <div class="col-md-6">
                                <small class="text-muted">
                                    <i class="fas fa-info-circle"></i>
                                    Arrive 30 minutes before departure
                                </small>
                            </div>
                            <div class="col-md-6 text-end">
                                <button class="btn btn-sm btn-outline-secondary" onclick="window.print()">
                                    <i class="fas fa-print"></i> Print
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $reservations->links() }}
            </div>
        @endif
    </div>
@endsection
