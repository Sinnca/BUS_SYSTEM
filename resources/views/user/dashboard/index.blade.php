@extends('layouts.app')

@section('title', 'My Dashboard')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <h1>Welcome, {{ auth()->user()->name }}!</h1>
                <p class="text-muted">Manage your bus reservations</p>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title">Upcoming Trips</h5>
                        <h2>{{ $upcomingReservations->count() }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">Past Trips</h5>
                        <h2>{{ $pastReservations->count() }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h5 class="card-title">Total Spent</h5>
                        <h2>₱{{ number_format(auth()->user()->reservations()->where('status', 'confirmed')->sum('total_price'), 2) }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Upcoming Trips -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="fas fa-calendar-alt"></i> Upcoming Trips
                </h5>
            </div>
            <div class="card-body">
                @forelse($upcomingReservations as $reservation)
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <div class="text-center">
                                        <h3 class="mb-0">{{ $reservation->trip->departure_date->format('d') }}</h3>
                                        <p class="mb-0 text-muted">{{ $reservation->trip->departure_date->format('M Y') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="mb-1">{{ $reservation->trip->origin }} → {{ $reservation->trip->destination }}</h5>
                                    <p class="mb-1">
                                        <i class="fas fa-clock"></i> {{ $reservation->trip->formatted_time }} |
                                        <i class="fas fa-bus"></i> {{ $reservation->trip->bus->bus_number }}
                                    </p>
                                    <p class="mb-0">
                                        <span class="badge bg-primary">{{ $reservation->reservation_code }}</span>
                                        @if($reservation->is_round_trip)
                                            <span class="badge bg-info">Round Trip</span>
                                        @endif
                                    </p>
                                </div>
                                <div class="col-md-2 text-center">
                                    <small class="text-muted">Passengers</small>
                                    <h5 class="mb-0">{{ $reservation->total_passengers }}</h5>
                                </div>
                                <div class="col-md-2 text-end">
                                    <a href="{{ route('my.bookings') }}" class="btn btn-primary btn-sm">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> You have no upcoming trips.
                        <a href="{{ route('home') }}" class="alert-link">Book a trip now!</a>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Past Trips -->
        @if($pastReservations->isNotEmpty())
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-history"></i> Recent Past Trips
                    </h5>
                </div>
                <div class="card-body">
                    @foreach($pastReservations as $reservation)
                        <div class="card mb-2">
                            <div class="card-body py-2">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <strong>{{ $reservation->trip->origin }} → {{ $reservation->trip->destination }}</strong>
                                        <small class="text-muted">
                                            | {{ $reservation->trip->formatted_date }}
                                            | {{ $reservation->reservation_code }}
                                        </small>
                                    </div>
                                    <div class="col-md-4 text-end">
                                        <span class="badge bg-success">Completed</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <a href="{{ route('my.bookings') }}" class="btn btn-outline-secondary btn-sm mt-2">
                        View All Bookings
                    </a>
                </div>
            </div>
        @endif

        <!-- Quick Actions -->
        <div class="row mt-4">
            <div class="col-md-6 mb-3">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-search fa-3x text-primary mb-3"></i>
                        <h5>Book a New Trip</h5>
                        <p class="text-muted">Search and book your next bus trip</p>
                        <a href="{{ route('home') }}" class="btn btn-primary">
                            Search Trips
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-list fa-3x text-success mb-3"></i>
                        <h5>View All Bookings</h5>
                        <p class="text-muted">See your complete booking history</p>
                        <a href="{{ route('my.bookings') }}" class="btn btn-success">
                            My Bookings
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
