@extends('layouts.app')

@section('title', 'Search Results')

@section('content')
    <div class="container">
        <h2 class="mb-4">Available Trips</h2>

        @if($trips->isEmpty())
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle"></i>
                No trips found for your search criteria. Please try different dates or routes.
            </div>
            <a href="{{ route('home') }}" class="btn btn-primary">Search Again</a>
        @else
            <!-- Outbound Trips -->
            <h4 class="mb-3">Outbound Trips</h4>
            <div class="row mb-5">
                @foreach($trips as $trip)
                    <div class="col-md-6 mb-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h5 class="card-title">{{ $trip->origin }} → {{ $trip->destination }}</h5>
                                        <p class="mb-2">
                                            <i class="fas fa-calendar"></i> {{ $trip->formatted_date }}<br>
                                            <i class="fas fa-clock"></i> {{ $trip->formatted_time }}
                                        </p>
                                    </div>
                                    <span class="badge bg-{{ $trip->bus->bus_type === 'deluxe' ? 'primary' : 'secondary' }}">
                                    {{ $trip->bus->formatted_bus_type }}
                                </span>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-6">
                                        <small class="text-muted">Bus Number</small>
                                        <p class="mb-0"><strong>{{ $trip->bus->bus_number }}</strong></p>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted">Available Seats</small>
                                        <p class="mb-0">
                                            <strong class="text-{{ $trip->available_seats > 10 ? 'success' : 'warning' }}">
                                                {{ $trip->available_seats }} / {{ $trip->bus->capacity }}
                                            </strong>
                                        </p>
                                    </div>
                                </div>

                                <hr>

                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <small class="text-muted">Price per seat</small>
                                        <h4 class="text-primary mb-0">{{ $trip->formatted_price }}</h4>
                                    </div>
                                    @auth
                                        <a href="{{ route('booking.seats', $trip) }}" class="btn btn-primary">
                                            Select Seats
                                        </a>
                                    @else
                                        <a href="{{ route('login') }}" class="btn btn-primary">
                                            Login to Book
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Return Trips (if round trip) -->
            @if($returnTrips)
                <h4 class="mb-3">Return Trips</h4>
                @if($returnTrips->isEmpty())
                    <div class="alert alert-warning">
                        No return trips available for selected date.
                    </div>
                @else
                    <div class="row">
                        @foreach($returnTrips as $trip)
                            <div class="col-md-6 mb-3">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h5 class="card-title">{{ $trip->origin }} → {{ $trip->destination }}</h5>
                                                <p class="mb-2">
                                                    <i class="fas fa-calendar"></i> {{ $trip->formatted_date }}<br>
                                                    <i class="fas fa-clock"></i> {{ $trip->formatted_time }}
                                                </p>
                                            </div>
                                            <span class="badge bg-{{ $trip->bus->bus_type === 'deluxe' ? 'primary' : 'secondary' }}">
                                            {{ $trip->bus->formatted_bus_type }}
                                        </span>
                                        </div>

                                        <hr>

                                        <div class="row">
                                            <div class="col-6">
                                                <small class="text-muted">Available Seats</small>
                                                <p class="mb-0">
                                                    <strong>{{ $trip->available_seats }} / {{ $trip->bus->capacity }}</strong>
                                                </p>
                                            </div>
                                            <div class="col-6">
                                                <small class="text-muted">Price</small>
                                                <h5 class="text-primary mb-0">{{ $trip->formatted_price }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            @endif
        @endif
    </div>
@endsection
