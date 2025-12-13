{{--@extends('layouts.app')--}}

{{--@section('title', 'Search Results')--}}

{{--@section('content')--}}
{{--    <div class="container">--}}
{{--        <h2 class="mb-4">Available Trips</h2>--}}

{{--        @if($trips->isEmpty())--}}
{{--            <div class="alert alert-warning">--}}
{{--                <i class="fas fa-exclamation-triangle"></i>--}}
{{--                No trips found for your search criteria. Please try different dates or routes.--}}
{{--            </div>--}}
{{--            <a href="{{ route('home') }}" class="btn btn-primary">Search Again</a>--}}
{{--        @else--}}
{{--            <!-- Outbound Trips -->--}}
{{--            <h4 class="mb-3">Outbound Trips</h4>--}}
{{--            <div class="row mb-5">--}}
{{--                @foreach($trips as $trip)--}}
{{--                    <div class="col-md-6 mb-3">--}}
{{--                        <div class="card h-100">--}}
{{--                            <div class="card-body">--}}
{{--                                <div class="d-flex justify-content-between align-items-start">--}}
{{--                                    <div>--}}
{{--                                        <h5 class="card-title">{{ $trip->origin }} → {{ $trip->destination }}</h5>--}}
{{--                                        <p class="mb-2">--}}
{{--                                            <i class="fas fa-calendar"></i> {{ $trip->formatted_date }}<br>--}}
{{--                                            <i class="fas fa-clock"></i> {{ $trip->formatted_time }}--}}
{{--                                        </p>--}}
{{--                                    </div>--}}
{{--                                    <span class="badge bg-{{ $trip->bus->bus_type === 'deluxe' ? 'primary' : 'secondary' }}">--}}
{{--                                    {{ $trip->bus->formatted_bus_type }}--}}
{{--                                </span>--}}
{{--                                </div>--}}

{{--                                <hr>--}}

{{--                                <div class="row">--}}
{{--                                    <div class="col-6">--}}
{{--                                        <small class="text-muted">Bus Number</small>--}}
{{--                                        <p class="mb-0"><strong>{{ $trip->bus->bus_number }}</strong></p>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-6">--}}
{{--                                        <small class="text-muted">Available Seats</small>--}}
{{--                                        <p class="mb-0">--}}
{{--                                            <strong class="text-{{ $trip->available_seats > 10 ? 'success' : 'warning' }}">--}}
{{--                                                {{ $trip->available_seats }} / {{ $trip->bus->capacity }}--}}
{{--                                            </strong>--}}
{{--                                        </p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <hr>--}}

{{--                                <div class="d-flex justify-content-between align-items-center">--}}
{{--                                    <div>--}}
{{--                                        <small class="text-muted">Price per seat</small>--}}
{{--                                        <h4 class="text-primary mb-0">{{ $trip->formatted_price }}</h4>--}}
{{--                                    </div>--}}
{{--                                    @auth--}}
{{--                                        <a href="{{ route('booking.seats', $trip) }}" class="btn btn-primary">--}}
{{--                                            Select Seats--}}
{{--                                        </a>--}}
{{--                                    @else--}}
{{--                                        <a href="{{ route('login') }}" class="btn btn-primary">--}}
{{--                                            Login to Book--}}
{{--                                        </a>--}}
{{--                                    @endauth--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}

{{--            <!-- Return Trips (if round trip) -->--}}
{{--            @if($returnTrips)--}}
{{--                <h4 class="mb-3">Return Trips</h4>--}}
{{--                @if($returnTrips->isEmpty())--}}
{{--                    <div class="alert alert-warning">--}}
{{--                        No return trips available for selected date.--}}
{{--                    </div>--}}
{{--                @else--}}
{{--                    <div class="row">--}}
{{--                        @foreach($returnTrips as $trip)--}}
{{--                            <div class="col-md-6 mb-3">--}}
{{--                                <div class="card h-100">--}}
{{--                                    <div class="card-body">--}}
{{--                                        <div class="d-flex justify-content-between align-items-start">--}}
{{--                                            <div>--}}
{{--                                                <h5 class="card-title">{{ $trip->origin }} → {{ $trip->destination }}</h5>--}}
{{--                                                <p class="mb-2">--}}
{{--                                                    <i class="fas fa-calendar"></i> {{ $trip->formatted_date }}<br>--}}
{{--                                                    <i class="fas fa-clock"></i> {{ $trip->formatted_time }}--}}
{{--                                                </p>--}}
{{--                                            </div>--}}
{{--                                            <span class="badge bg-{{ $trip->bus->bus_type === 'deluxe' ? 'primary' : 'secondary' }}">--}}
{{--                                            {{ $trip->bus->formatted_bus_type }}--}}
{{--                                        </span>--}}
{{--                                        </div>--}}

{{--                                        <hr>--}}

{{--                                        <div class="row">--}}
{{--                                            <div class="col-6">--}}
{{--                                                <small class="text-muted">Available Seats</small>--}}
{{--                                                <p class="mb-0">--}}
{{--                                                    <strong>{{ $trip->available_seats }} / {{ $trip->bus->capacity }}</strong>--}}
{{--                                                </p>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-6">--}}
{{--                                                <small class="text-muted">Price</small>--}}
{{--                                                <h5 class="text-primary mb-0">{{ $trip->formatted_price }}</h5>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--            @endif--}}
{{--        @endif--}}
{{--    </div>--}}
{{--@endsection--}}
{{-- ============================================================ --}}
{{-- FILE 2: resources/views/user/trips/search-results.blade.php --}}
{{-- SEARCH RESULTS WITH ROUND TRIP SUPPORT --}}
{{-- ============================================================ --}}
@extends('layouts.app')

@section('title', 'Search Results')

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-6">
                <h2>Available Trips</h2>
                @if(session('search_params.is_round_trip'))
                    <span class="badge bg-info">Round Trip Search</span>
                @endif
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('home') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> New Search
                </a>
            </div>
        </div>

        @if($trips->isEmpty())
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle"></i>
                No outbound trips found for your search criteria. Please try different dates or routes.
            </div>
            <a href="{{ route('home') }}" class="btn btn-primary">Search Again</a>
        @else
            <!-- Outbound Trips -->
            <h4 class="mb-3">
                <i class="fas fa-arrow-right text-primary"></i> Outbound Trips
            </h4>
            <div class="row mb-5">
                @foreach($trips as $trip)
                    <div class="col-md-6 mb-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h5 class="card-title">{{ $trip->origin }} → {{ $trip->destination }}</h5>
                                        <p class="mb-2">
                                            <i class="fas fa-calendar text-primary"></i> {{ $trip->formatted_date }}<br>
                                            <i class="fas fa-clock text-primary"></i> {{ $trip->formatted_time }}
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
                                        @if(session('search_params.is_round_trip'))
                                            <button class="btn btn-primary btn-select-outbound" data-trip-id="{{ $trip->id }}">
                                                Select This Trip
                                            </button>
                                        @else
                                            <a href="{{ route('booking.seats', $trip) }}" class="btn btn-primary">
                                                Select Seats
                                            </a>
                                        @endif
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

            <!-- Return Trips (for round trip) -->
            @if($returnTrips !== null)
                <h4 class="mb-3">
                    <i class="fas fa-arrow-left text-success"></i> Return Trips
                </h4>

                @if($returnTrips->isEmpty())
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i>
                        No return trips available for selected date. Please select outbound trip only or change dates.
                    </div>
                @else
                    <div class="row" id="return-trips-section" style="display: none;">
                        @foreach($returnTrips as $trip)
                            <div class="col-md-6 mb-3">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h5 class="card-title">{{ $trip->origin }} → {{ $trip->destination }}</h5>
                                                <p class="mb-2">
                                                    <i class="fas fa-calendar text-success"></i> {{ $trip->formatted_date }}<br>
                                                    <i class="fas fa-clock text-success"></i> {{ $trip->formatted_time }}
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
                                                <h5 class="text-success mb-0">{{ $trip->formatted_price }}</h5>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="text-center">
                                            <button class="btn btn-success btn-select-return" data-trip-id="{{ $trip->id }}">
                                                Select Return Trip
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Selected Trips Summary -->
                    <div id="selected-summary" style="display: none;" class="card bg-light mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Selected Trips</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Outbound:</strong>
                                    <span id="outbound-summary"></span>
                                </div>
                                <div class="col-md-6">
                                    <strong>Return:</strong>
                                    <span id="return-summary"></span>
                                </div>
                            </div>
                            <div class="text-end mt-3">
                                <form action="{{ route('booking.seats', ':tripId') }}" method="GET" id="proceed-form">
                                    <input type="hidden" name="return_trip_id" id="return_trip_id">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-arrow-right"></i> Proceed to Seat Selection
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        @endif
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let selectedOutbound = null;
                let selectedReturn = null;

                // Handle outbound trip selection
                document.querySelectorAll('.btn-select-outbound').forEach(btn => {
                    btn.addEventListener('click', function() {
                        selectedOutbound = this.dataset.tripId;

                        // Visual feedback
                        document.querySelectorAll('.btn-select-outbound').forEach(b => {
                            b.classList.remove('btn-success');
                            b.classList.add('btn-primary');
                            b.innerHTML = 'Select This Trip';
                        });

                        this.classList.remove('btn-primary');
                        this.classList.add('btn-success');
                        this.innerHTML = '<i class="fas fa-check"></i> Selected';

                        // Show return trips section
                        document.getElementById('return-trips-section').style.display = 'block';

                        // Scroll to return trips
                        document.getElementById('return-trips-section').scrollIntoView({ behavior: 'smooth' });

                        // Update summary
                        const card = this.closest('.card-body');
                        const route = card.querySelector('.card-title').textContent;
                        const date = card.querySelector('.fa-calendar').parentElement.textContent.trim().split('\n')[0];
                        document.getElementById('outbound-summary').textContent = route + ' on ' + date;
                    });
                });

                // Handle return trip selection
                document.querySelectorAll('.btn-select-return').forEach(btn => {
                    btn.addEventListener('click', function() {
                        if (!selectedOutbound) {
                            alert('Please select an outbound trip first!');
                            return;
                        }

                        selectedReturn = this.dataset.tripId;

                        // Visual feedback
                        document.querySelectorAll('.btn-select-return').forEach(b => {
                            b.classList.remove('btn-success');
                            b.classList.add('btn-outline-success');
                            b.innerHTML = 'Select Return Trip';
                        });

                        this.classList.remove('btn-outline-success');
                        this.classList.add('btn-success');
                        this.innerHTML = '<i class="fas fa-check"></i> Selected';

                        // Update summary
                        const card = this.closest('.card-body');
                        const route = card.querySelector('.card-title').textContent;
                        const date = card.querySelector('.fa-calendar').parentElement.textContent.trim().split('\n')[0];
                        document.getElementById('return-summary').textContent = route + ' on ' + date;

                        // Show summary and proceed button
                        document.getElementById('selected-summary').style.display = 'block';
                        document.getElementById('return_trip_id').value = selectedReturn;

                        // Update form action
                        const form = document.getElementById('proceed-form');
                        form.action = form.action.replace(':tripId', selectedOutbound);

                        // Scroll to summary
                        document.getElementById('selected-summary').scrollIntoView({ behavior: 'smooth' });
                    });
                });
            });
        </script>
    @endpush
@endsection
