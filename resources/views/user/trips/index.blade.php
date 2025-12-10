@extends('layouts.app')

@section('title', 'Available Trips')

@section('content')
    <div class="container">
        <h2 class="mb-4 fw-bold">
            <i class="fas fa-route"></i> Available Trips
        </h2>

        @if($trips->count() == 0)
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> No trips available.
            </div>
        @endif

        <div class="row">
            @foreach($trips as $trip)
                <div class="col-md-4 mb-4">
                    <div class="card p-3">
                        <h5 class="fw-bold">{{ $trip->origin }} → {{ $trip->destination }}</h5>

                        <p class="mb-1">
                            <i class="fas fa-calendar"></i>
                            {{ $trip->formatted_date }}
                        </p>

                        <p class="mb-1">
                            <i class="fas fa-clock"></i>
                            {{ $trip->formatted_time }}
                        </p>

                        <p class="mb-1">
                            <i class="fas fa-bus"></i>
                            Bus: {{ $trip->bus->bus_number }} ({{ $trip->bus->bus_type }})
                        </p>

                        <p class="mb-2">
                            <i class="fas fa-user"></i>
                            Seats Left: <strong>{{ $trip->available_seats }}</strong>
                        </p>

                        <p class="mb-2">
                            <i class="fas fa-money-bill"></i>
                            ₱{{ number_format($trip->price, 2) }}
                        </p>

                        <a href="{{ route('trips.show', $trip->id) }}" class="btn btn-primary w-100">
                            View Trip
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $trips->links() }}
        </div>
    </div>
@endsection
