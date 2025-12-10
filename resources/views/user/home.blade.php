@extends('layouts.app')

@section('title', 'Find Your Bus Trip')

@section('content')
    <div class="container">
        <!-- Hero Section -->
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h1 class="display-4 mb-3">Book Your Bus Trip</h1>
                <p class="lead text-muted">Safe, comfortable, and affordable bus travel across the Philippines</p>
            </div>
        </div>

        <!-- Search Form -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg">
                    <div class="card-body p-4">
                        <form action="{{ route('trips.search') }}" method="GET">
                            <!-- Trip Type -->
                            <div class="form-check form-check-inline mb-3">
                                <input class="form-check-input" type="checkbox" name="is_round_trip"
                                       id="is_round_trip" value="1">
                                <label class="form-check-label" for="is_round_trip">
                                    <strong>Round Trip</strong>
                                </label>
                            </div>

                            <!-- Origin & Destination -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="origin" class="form-label">From *</label>
                                    <input type="text" class="form-control" id="origin" name="origin"
                                           list="origin-list" placeholder="e.g., Manila" required>
                                    <datalist id="origin-list">
                                        <option value="Manila">
                                        <option value="Cebu">
                                        <option value="Davao">
                                        <option value="Baguio">
                                        <option value="Iloilo">
                                    </datalist>
                                </div>
                                <div class="col-md-6">
                                    <label for="destination" class="form-label">To *</label>
                                    <input type="text" class="form-control" id="destination" name="destination"
                                           list="destination-list" placeholder="e.g., Cebu" required>
                                    <datalist id="destination-list">
                                        <option value="Manila">
                                        <option value="Cebu">
                                        <option value="Davao">
                                        <option value="Baguio">
                                        <option value="Iloilo">
                                    </datalist>
                                </div>
                            </div>

                            <!-- Dates -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="departure_date" class="form-label">Departure Date *</label>
                                    <input type="date" class="form-control" id="departure_date"
                                           name="departure_date" min="{{ date('Y-m-d') }}" required>
                                </div>
                                <div class="col-md-6" id="return-date-group" style="display: none;">
                                    <label for="return_date" class="form-label">Return Date</label>
                                    <input type="date" class="form-control" id="return_date" name="return_date">
                                </div>
                            </div>

                            <!-- Passengers -->
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="adults" class="form-label">Adults *</label>
                                    <select class="form-select" id="adults" name="adults" required>
                                        @for($i = 1; $i <= 10; $i++)
                                            <option value="{{ $i }}" {{ $i === 1 ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="children" class="form-label">Children</label>
                                    <select class="form-select" id="children" name="children">
                                        @for($i = 0; $i <= 10; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="bus_type" class="form-label">Bus Type</label>
                                    <select class="form-select" id="bus_type" name="bus_type">
                                        <option value="any">Any</option>
                                        <option value="deluxe">Deluxe (20 seats)</option>
                                        <option value="regular">Regular (40 seats)</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-search"></i> Search Trips
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Popular Routes -->
        <div class="row mt-5">
            <div class="col-12">
                <h3 class="text-center mb-4">Popular Routes</h3>
            </div>
            @foreach($popular_routes as $route)
                <div class="col-md-3 mb-3">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-route fa-3x text-primary mb-3"></i>
                            <h5>{{ $route['origin'] }} → {{ $route['destination'] }}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @push('scripts')
        <script>
            document.getElementById('is_round_trip').addEventListener('change', function() {
                const returnDateGroup = document.getElementById('return-date-group');
                const returnDateInput = document.getElementById('return_date');

                if (this.checked) {
                    returnDateGroup.style.display = 'block';
                    returnDateInput.required = true;
                } else {
                    returnDateGroup.style.display = 'none';
                    returnDateInput.required = false;
                }
            });

            // Set minimum return date based on departure date
            document.getElementById('departure_date').addEventListener('change', function() {
                const returnDate = document.getElementById('return_date');
                const nextDay = new Date(this.value);
                nextDay.setDate(nextDay.getDate() + 1);
                returnDate.min = nextDay.toISOString().split('T')[0];
            });
        </script>
    @endpush
@endsection
