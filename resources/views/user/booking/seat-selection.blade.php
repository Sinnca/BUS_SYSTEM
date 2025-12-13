{{--@extends('layouts.app')--}}

{{--@section('title', 'Select Seats')--}}

{{--@push('styles')--}}
{{--    <style>--}}
{{--        .seat-map {--}}
{{--            display: flex;--}}
{{--            flex-direction: column;--}}
{{--            gap: 10px;--}}
{{--            max-width: 400px;--}}
{{--            margin: 0 auto;--}}
{{--        }--}}

{{--        .seat-row {--}}
{{--            display: flex;--}}
{{--            justify-content: center;--}}
{{--            gap: 10px;--}}
{{--        }--}}

{{--        .seat {--}}
{{--            width: 50px;--}}
{{--            height: 50px;--}}
{{--            border: 2px solid #ddd;--}}
{{--            background: #fff;--}}
{{--            border-radius: 5px;--}}
{{--            cursor: pointer;--}}
{{--            font-size: 14px;--}}
{{--            font-weight: bold;--}}
{{--            transition: all 0.3s ease;--}}
{{--            display: flex;--}}
{{--            align-items: center;--}}
{{--            justify-content: center;--}}
{{--        }--}}

{{--        .seat.available:hover {--}}
{{--            background: #e3f2fd;--}}
{{--            border-color: #2196F3;--}}
{{--            transform: scale(1.05);--}}
{{--        }--}}

{{--        .seat.selected {--}}
{{--            background: #2196F3;--}}
{{--            color: white;--}}
{{--            border-color: #1976D2;--}}
{{--        }--}}

{{--        .seat.reserved {--}}
{{--            background: #ccc;--}}
{{--            cursor: not-allowed;--}}
{{--            color: #666;--}}
{{--        }--}}

{{--        .seat.driver {--}}
{{--            background: #333;--}}
{{--            color: white;--}}
{{--            cursor: default;--}}
{{--        }--}}

{{--        .legend {--}}
{{--            display: flex;--}}
{{--            justify-content: center;--}}
{{--            gap: 20px;--}}
{{--            margin-top: 20px;--}}
{{--        }--}}

{{--        .legend-item {--}}
{{--            display: flex;--}}
{{--            align-items: center;--}}
{{--            gap: 8px;--}}
{{--        }--}}

{{--        .legend-box {--}}
{{--            width: 30px;--}}
{{--            height: 30px;--}}
{{--            border: 2px solid #ddd;--}}
{{--            border-radius: 5px;--}}
{{--        }--}}

{{--        .booking-summary {--}}
{{--            position: sticky;--}}
{{--            top: 20px;--}}
{{--        }--}}
{{--    </style>--}}
{{--@endpush--}}

{{--@section('content')--}}
{{--    <div class="container py-4">--}}
{{--        <div class="row">--}}
{{--            <!-- Seat Map -->--}}
{{--            <div class="col-lg-8">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header bg-primary text-white">--}}
{{--                        <h4 class="mb-0">--}}
{{--                            <i class="fas fa-chair"></i> Select Your Seats--}}
{{--                        </h4>--}}
{{--                    </div>--}}
{{--                    <div class="card-body">--}}
{{--                        <!-- Trip Info -->--}}
{{--                        <div class="alert alert-info">--}}
{{--                            <h5>{{ $trip->origin }} → {{ $trip->destination }}</h5>--}}
{{--                            <p class="mb-0">--}}
{{--                                <i class="fas fa-calendar"></i> {{ $trip->formatted_date }} |--}}
{{--                                <i class="fas fa-clock"></i> {{ $trip->formatted_time }} |--}}
{{--                                <i class="fas fa-bus"></i> {{ $trip->bus->formatted_bus_type }} ({{ $trip->bus->bus_number }})--}}
{{--                            </p>--}}
{{--                        </div>--}}

{{--                        <!-- Instructions -->--}}
{{--                        <div class="alert alert-warning">--}}
{{--                            <i class="fas fa-info-circle"></i>--}}
{{--                            Please select <strong>{{ $search['adults'] + $search['children'] }}</strong> seat(s)--}}
{{--                            ({{ $search['adults'] }} adult{{ $search['adults'] > 1 ? 's' : '' }}--}}
{{--                            @if($search['children'] > 0), {{ $search['children'] }} child(ren)@endif)--}}
{{--                        </div>--}}

{{--                        <!-- Bus Front Indicator -->--}}
{{--                        <div class="text-center mb-3">--}}
{{--                            <div class="badge bg-dark" style="padding: 10px 50px;">--}}
{{--                                <i class="fas fa-steering-wheel"></i> FRONT--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <!-- Seat Map -->--}}
{{--                        <div class="seat-map">--}}
{{--                            @php--}}
{{--                                $capacity = $trip->bus->capacity;--}}
{{--                                $cols = 4; // 4 seats per row--}}
{{--                                $rows = ceil($capacity / $cols);--}}
{{--                            @endphp--}}

{{--                            @for($row = 1; $row <= $rows; $row++)--}}
{{--                                <div class="seat-row">--}}
{{--                                    @for($col = 1; $col <= $cols; $col++)--}}
{{--                                        @php--}}
{{--                                            $seatNum = ($row - 1) * $cols + $col;--}}
{{--                                        @endphp--}}

{{--                                        @if($seatNum <= $capacity)--}}
{{--                                            @php--}}
{{--                                                $isReserved = in_array($seatNum, $reservedSeats);--}}
{{--                                            @endphp--}}

{{--                                            <button--}}
{{--                                                type="button"--}}
{{--                                                class="seat {{ $isReserved ? 'reserved' : 'available' }}"--}}
{{--                                                data-seat="{{ $seatNum }}"--}}
{{--                                                {{ $isReserved ? 'disabled' : '' }}>--}}
{{--                                                {{ $seatNum }}--}}
{{--                                            </button>--}}
{{--                                        @else--}}
{{--                                            <div style="width: 50px;"></div>--}}
{{--                                        @endif--}}

{{--                                        --}}{{-- Add aisle after 2nd seat --}}
{{--                                        @if($col == 2)--}}
{{--                                            <div style="width: 30px;"></div>--}}
{{--                                        @endif--}}
{{--                                    @endfor--}}
{{--                                </div>--}}
{{--                            @endfor--}}
{{--                        </div>--}}

{{--                        <!-- Legend -->--}}
{{--                        <div class="legend mt-4">--}}
{{--                            <div class="legend-item">--}}
{{--                                <div class="legend-box" style="background: #fff; border-color: #ddd;"></div>--}}
{{--                                <span>Available</span>--}}
{{--                            </div>--}}
{{--                            <div class="legend-item">--}}
{{--                                <div class="legend-box" style="background: #2196F3; border-color: #1976D2;"></div>--}}
{{--                                <span>Selected</span>--}}
{{--                            </div>--}}
{{--                            <div class="legend-item">--}}
{{--                                <div class="legend-box" style="background: #ccc; border-color: #999;"></div>--}}
{{--                                <span>Reserved</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <!-- Booking Summary & Form -->--}}
{{--            <div class="col-lg-4">--}}
{{--                <div class="booking-summary">--}}
{{--                    <div class="card">--}}
{{--                        <div class="card-header bg-success text-white">--}}
{{--                            <h5 class="mb-0">Booking Summary</h5>--}}
{{--                        </div>--}}
{{--                        <div class="card-body">--}}
{{--                            <!-- Selected Seats Display -->--}}
{{--                            <div class="mb-3">--}}
{{--                                <strong>Selected Seats:</strong>--}}
{{--                                <div id="selected-seats-display" class="mt-2">--}}
{{--                                    <span class="text-muted">No seats selected</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <hr>--}}

{{--                            <!-- Price Breakdown -->--}}
{{--                            <div class="mb-3">--}}
{{--                                <div class="d-flex justify-content-between">--}}
{{--                                    <span>Adults ({{ $search['adults'] }}):</span>--}}
{{--                                    <span>{{ $trip->formatted_price }}</span>--}}
{{--                                </div>--}}
{{--                                @if($search['children'] > 0)--}}
{{--                                    <div class="d-flex justify-content-between">--}}
{{--                                        <span>Children ({{ $search['children'] }}):</span>--}}
{{--                                        <span>{{ $trip->formatted_price }}</span>--}}
{{--                                    </div>--}}
{{--                                @endif--}}
{{--                                <hr>--}}
{{--                                <div class="d-flex justify-content-between">--}}
{{--                                    <strong>Total:</strong>--}}
{{--                                    <strong class="text-success" id="total-price">--}}
{{--                                        ₱{{ number_format($trip->price * ($search['adults'] + $search['children']), 2) }}--}}
{{--                                    </strong>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <hr>--}}

{{--                            <!-- Booking Form -->--}}
{{--                            <form action="{{ route('booking.store') }}" method="POST" id="booking-form">--}}
{{--                                @csrf--}}

{{--                                <input type="hidden" name="trip_id" value="{{ $trip->id }}">--}}

{{--                                <!-- Hidden inputs for selected seats -->--}}
{{--                                <div id="seat-inputs"></div>--}}

{{--                                <!-- Passenger Names -->--}}
{{--                                <div id="passenger-names" class="mb-3"></div>--}}

{{--                                <!-- Submit Button -->--}}
{{--                                <button type="submit" class="btn btn-success btn-lg w-100" id="confirm-btn" disabled>--}}
{{--                                    <i class="fas fa-check"></i> Confirm Booking--}}
{{--                                </button>--}}
{{--                            </form>--}}

{{--                            <a href="{{ route('trips.search') }}" class="btn btn-outline-secondary w-100 mt-2">--}}
{{--                                <i class="fas fa-arrow-left"></i> Back to Search--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    @push('scripts')--}}
{{--        <script>--}}
{{--            document.addEventListener('DOMContentLoaded', function() {--}}
{{--                const maxSeats = {{ $search['adults'] + $search['children'] }};--}}
{{--                let selectedSeats = [];--}}

{{--                const confirmBtn = document.getElementById('confirm-btn');--}}
{{--                const seatInputsContainer = document.getElementById('seat-inputs');--}}
{{--                const passengerNamesContainer = document.getElementById('passenger-names');--}}
{{--                const selectedSeatsDisplay = document.getElementById('selected-seats-display');--}}

{{--                // Handle seat clicks--}}
{{--                document.querySelectorAll('.seat.available').forEach(seat => {--}}
{{--                    seat.addEventListener('click', function() {--}}
{{--                        const seatNum = parseInt(this.dataset.seat);--}}

{{--                        if (this.classList.contains('selected')) {--}}
{{--                            // Deselect seat--}}
{{--                            this.classList.remove('selected');--}}
{{--                            selectedSeats = selectedSeats.filter(s => s !== seatNum);--}}
{{--                        } else {--}}
{{--                            // Check if max seats reached--}}
{{--                            if (selectedSeats.length >= maxSeats) {--}}
{{--                                alert(`You can only select ${maxSeats} seat(s)`);--}}
{{--                                return;--}}
{{--                            }--}}

{{--                            // Select seat--}}
{{--                            this.classList.add('selected');--}}
{{--                            selectedSeats.push(seatNum);--}}
{{--                        }--}}

{{--                        // Sort seats numerically--}}
{{--                        selectedSeats.sort((a, b) => a - b);--}}

{{--                        updateForm();--}}
{{--                    });--}}
{{--                });--}}

{{--                function updateForm() {--}}
{{--                    // Update selected seats display--}}
{{--                    if (selectedSeats.length === 0) {--}}
{{--                        selectedSeatsDisplay.innerHTML = '<span class="text-muted">No seats selected</span>';--}}
{{--                    } else {--}}
{{--                        selectedSeatsDisplay.innerHTML = selectedSeats--}}
{{--                            .map(seat => `<span class="badge bg-primary me-1">${seat}</span>`)--}}
{{--                            .join('');--}}
{{--                    }--}}

{{--                    // Clear previous inputs--}}
{{--                    seatInputsContainer.innerHTML = '';--}}
{{--                    passengerNamesContainer.innerHTML = '';--}}

{{--                    // Add hidden inputs for seats--}}
{{--                    selectedSeats.forEach(seat => {--}}
{{--                        const input = document.createElement('input');--}}
{{--                        input.type = 'hidden';--}}
{{--                        input.name = 'seat_numbers[]';--}}
{{--                        input.value = seat;--}}
{{--                        seatInputsContainer.appendChild(input);--}}
{{--                    });--}}

{{--                    // Add passenger name inputs--}}
{{--                    if (selectedSeats.length > 0) {--}}
{{--                        passengerNamesContainer.innerHTML = '<strong class="d-block mb-2">Passenger Names:</strong>';--}}

{{--                        selectedSeats.forEach((seat, index) => {--}}
{{--                            const formGroup = document.createElement('div');--}}
{{--                            formGroup.className = 'mb-2';--}}

{{--                            const label = document.createElement('label');--}}
{{--                            label.className = 'form-label small mb-1';--}}
{{--                            label.textContent = `Seat ${seat}:`;--}}

{{--                            const input = document.createElement('input');--}}
{{--                            input.type = 'text';--}}
{{--                            input.className = 'form-control form-control-sm';--}}
{{--                            input.name = 'passenger_names[]';--}}
{{--                            input.placeholder = 'Full Name';--}}
{{--                            input.required = true;--}}
{{--                            input.pattern = '[a-zA-Z\\s]+';--}}
{{--                            input.title = 'Letters and spaces only';--}}

{{--                            formGroup.appendChild(label);--}}
{{--                            formGroup.appendChild(input);--}}
{{--                            passengerNamesContainer.appendChild(formGroup);--}}
{{--                        });--}}
{{--                    }--}}

{{--                    // Enable/disable confirm button--}}
{{--                    confirmBtn.disabled = selectedSeats.length !== maxSeats;--}}
{{--                }--}}

{{--                // Form validation before submit--}}
{{--                document.getElementById('booking-form').addEventListener('submit', function(e) {--}}
{{--                    if (selectedSeats.length !== maxSeats) {--}}
{{--                        e.preventDefault();--}}
{{--                        alert(`Please select exactly ${maxSeats} seat(s)`);--}}
{{--                        return false;--}}
{{--                    }--}}

{{--                    // Check if all passenger names are filled--}}
{{--                    const nameInputs = document.querySelectorAll('input[name="passenger_names[]"]');--}}
{{--                    let allFilled = true;--}}
{{--                    nameInputs.forEach(input => {--}}
{{--                        if (!input.value.trim()) {--}}
{{--                            allFilled = false;--}}
{{--                            input.classList.add('is-invalid');--}}
{{--                        } else {--}}
{{--                            input.classList.remove('is-invalid');--}}
{{--                        }--}}
{{--                    });--}}

{{--                    if (!allFilled) {--}}
{{--                        e.preventDefault();--}}
{{--                        alert('Please enter all passenger names');--}}
{{--                        return false;--}}
{{--                    }--}}

{{--                    // Show loading state--}}
{{--                    confirmBtn.disabled = true;--}}
{{--                    confirmBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Processing...';--}}
{{--                });--}}
{{--            });--}}
{{--        </script>--}}
{{--    @endpush--}}
{{--@endsection--}}
{{-- ============================================================ --}}
{{-- FILE: resources/views/user/booking/seat-selection.blade.php --}}
{{-- SEAT SELECTION WITH ROUND TRIP SUPPORT --}}
{{-- ============================================================ --}}
@extends('layouts.app')

@section('title', 'Select Seats')

@push('styles')
    <style>
        .seat-map { display: flex; flex-direction: column; gap: 10px; max-width: 400px; margin: 0 auto; }
        .seat-row { display: flex; justify-content: center; gap: 10px; }
        .seat { width: 50px; height: 50px; border: 2px solid #ddd; background: #fff; border-radius: 5px; cursor: pointer; font-size: 14px; font-weight: bold; transition: all 0.3s ease; display: flex; align-items: center; justify-content: center; }
        .seat.available:hover { background: #e3f2fd; border-color: #2196F3; transform: scale(1.05); }
        .seat.selected { background: #2196F3; color: white; border-color: #1976D2; }
        .seat.reserved { background: #ccc; cursor: not-allowed; color: #666; }
        .legend { display: flex; justify-content: center; gap: 20px; margin-top: 20px; }
        .legend-item { display: flex; align-items: center; gap: 8px; }
        .legend-box { width: 30px; height: 30px; border: 2px solid #ddd; border-radius: 5px; }
        .booking-summary { position: sticky; top: 20px; }
        .trip-section { margin-bottom: 40px; padding: 20px; border: 2px solid #e0e0e0; border-radius: 10px; }
        .trip-section.active { border-color: #2196F3; background: #f0f7ff; }
    </style>
@endpush

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-12 mb-3">
                <h2>
                    <i class="fas fa-chair"></i> Select Your Seats
                    @if($returnTrip)
                        <span class="badge bg-info">Round Trip</span>
                    @endif
                </h2>
            </div>
        </div>

        <div class="row">
            <!-- Seat Maps -->
            <div class="col-lg-8">
                <!-- OUTBOUND TRIP -->
                <div class="trip-section active" id="outbound-section">
                    <h4 class="text-primary mb-3">
                        <i class="fas fa-arrow-right"></i> Outbound Trip
                    </h4>

                    <div class="alert alert-info">
                        <h5>{{ $trip->origin }} → {{ $trip->destination }}</h5>
                        <p class="mb-0">
                            <i class="fas fa-calendar"></i> {{ $trip->formatted_date }} |
                            <i class="fas fa-clock"></i> {{ $trip->formatted_time }} |
                            <i class="fas fa-bus"></i> {{ $trip->bus->bus_number }} ({{ $trip->bus->formatted_bus_type }})
                        </p>
                    </div>

                    <div class="alert alert-warning">
                        <i class="fas fa-info-circle"></i>
                        Select <strong>{{ $search['adults'] + $search['children'] }}</strong> seat(s) for outbound trip
                    </div>

                    <!-- Outbound Seat Map -->
                    <div class="text-center mb-3">
                        <div class="badge bg-dark" style="padding: 10px 50px;">
                            <i class="fas fa-steering-wheel"></i> FRONT
                        </div>
                    </div>

                    <div class="seat-map" id="outbound-seat-map">
                        @php
                            $capacity = $trip->bus->capacity;
                            $cols = 4;
                            $rows = ceil($capacity / $cols);
                        @endphp

                        @for($row = 1; $row <= $rows; $row++)
                            <div class="seat-row">
                                @for($col = 1; $col <= $cols; $col++)
                                    @php $seatNum = ($row - 1) * $cols + $col; @endphp

                                    @if($seatNum <= $capacity)
                                        @php $isReserved = in_array($seatNum, $reservedSeats); @endphp

                                        <button type="button"
                                                class="seat {{ $isReserved ? 'reserved' : 'available' }}"
                                                data-seat="{{ $seatNum }}"
                                                data-trip="outbound"
                                            {{ $isReserved ? 'disabled' : '' }}>
                                            {{ $seatNum }}
                                        </button>
                                    @else
                                        <div style="width: 50px;"></div>
                                    @endif

                                    @if($col == 2)
                                        <div style="width: 30px;"></div>
                                    @endif
                                @endfor
                            </div>
                        @endfor
                    </div>

                    <!-- Legend -->
                    <div class="legend mt-4">
                        <div class="legend-item">
                            <div class="legend-box" style="background: #fff;"></div>
                            <span>Available</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-box" style="background: #2196F3;"></div>
                            <span>Selected</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-box" style="background: #ccc;"></div>
                            <span>Reserved</span>
                        </div>
                    </div>
                </div>

                <!-- RETURN TRIP -->
                @if($returnTrip)
                    <div class="trip-section" id="return-section" style="display: none;">
                        <h4 class="text-success mb-3">
                            <i class="fas fa-arrow-left"></i> Return Trip
                        </h4>

                        <div class="alert alert-info">
                            <h5>{{ $returnTrip->origin }} → {{ $returnTrip->destination }}</h5>
                            <p class="mb-0">
                                <i class="fas fa-calendar"></i> {{ $returnTrip->formatted_date }} |
                                <i class="fas fa-clock"></i> {{ $returnTrip->formatted_time }} |
                                <i class="fas fa-bus"></i> {{ $returnTrip->bus->bus_number }}
                            </p>
                        </div>

                        <div class="alert alert-warning">
                            <i class="fas fa-info-circle"></i>
                            Select <strong>{{ $search['adults'] + $search['children'] }}</strong> seat(s) for return trip
                        </div>

                        <!-- Return Seat Map -->
                        <div class="text-center mb-3">
                            <div class="badge bg-dark" style="padding: 10px 50px;">
                                <i class="fas fa-steering-wheel"></i> FRONT
                            </div>
                        </div>

                        <div class="seat-map" id="return-seat-map">
                            @php
                                $returnCapacity = $returnTrip->bus->capacity;
                                $returnRows = ceil($returnCapacity / 4);
                            @endphp

                            @for($row = 1; $row <= $returnRows; $row++)
                                <div class="seat-row">
                                    @for($col = 1; $col <= 4; $col++)
                                        @php $seatNum = ($row - 1) * 4 + $col; @endphp

                                        @if($seatNum <= $returnCapacity)
                                            @php $isReserved = in_array($seatNum, $returnReservedSeats); @endphp

                                            <button type="button"
                                                    class="seat {{ $isReserved ? 'reserved' : 'available' }}"
                                                    data-seat="{{ $seatNum }}"
                                                    data-trip="return"
                                                {{ $isReserved ? 'disabled' : '' }}>
                                                {{ $seatNum }}
                                            </button>
                                        @else
                                            <div style="width: 50px;"></div>
                                        @endif

                                        @if($col == 2)
                                            <div style="width: 30px;"></div>
                                        @endif
                                    @endfor
                                </div>
                            @endfor
                        </div>

                        <div class="legend mt-4">
                            <div class="legend-item">
                                <div class="legend-box" style="background: #fff;"></div>
                                <span>Available</span>
                            </div>
                            <div class="legend-item">
                                <div class="legend-box" style="background: #2196F3;"></div>
                                <span>Selected</span>
                            </div>
                            <div class="legend-item">
                                <div class="legend-box" style="background: #ccc;"></div>
                                <span>Reserved</span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Booking Summary -->
            <div class="col-lg-4">
                <div class="booking-summary">
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">Booking Summary</h5>
                        </div>
                        <div class="card-body">
                            <!-- Outbound Seats -->
                            <div class="mb-3">
                                <strong>Outbound Seats:</strong>
                                <div id="outbound-seats-display" class="mt-2">
                                    <span class="text-muted">No seats selected</span>
                                </div>
                            </div>

                            @if($returnTrip)
                                <div class="mb-3">
                                    <strong>Return Seats:</strong>
                                    <div id="return-seats-display" class="mt-2">
                                        <span class="text-muted">No seats selected</span>
                                    </div>
                                </div>
                            @endif

                            <hr>

                            <!-- Price Breakdown -->
                            <div class="mb-3">
                                <div class="d-flex justify-content-between">
                                    <span>Outbound ({{$search['adults'] + $search['children']}} seats):</span>
                                    <span>{{ $trip->formatted_price }}</span>
                                </div>
                                @if($returnTrip)
                                    <div class="d-flex justify-content-between">
                                        <span>Return ({{$search['adults'] + $search['children']}} seats):</span>
                                        <span>{{ $returnTrip->formatted_price }}</span>
                                    </div>
                                @endif
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <strong>Total:</strong>
                                    <strong class="text-success" id="total-price">
                                        ₱{{ number_format(($trip->price + ($returnTrip ? $returnTrip->price : 0)) * ($search['adults'] + $search['children']), 2) }}
                                    </strong>
                                </div>
                            </div>

                            <hr>

                            <!-- Booking Form -->
                            <form action="{{ route('booking.store') }}" method="POST" id="booking-form">
                                @csrf

                                <input type="hidden" name="trip_id" value="{{ $trip->id }}">
                                @if($returnTrip)
                                    <input type="hidden" name="return_trip_id" value="{{ $returnTrip->id }}">
                                @endif

                                <!-- Hidden inputs for selected seats -->
                                <div id="outbound-seat-inputs"></div>
                                <div id="return-seat-inputs"></div>

                                <!-- Original search parameters -->
                                <input type="hidden" name="origin" value="{{ session('search_params')['origin'] }}">
                                <input type="hidden" name="destination" value="{{ session('search_params')['destination'] }}">
                                <input type="hidden" name="departure_date" value="{{ session('search_params')['departure_date'] }}">
                                <input type="hidden" name="adults" value="{{ session('search_params')['adults'] }}">
                                <input type="hidden" name="children" value="{{ session('search_params')['children'] }}">


                                <!-- Passenger Names -->
                                <div id="passenger-names" class="mb-3"></div>

                                <!-- Navigation & Submit Buttons -->
                                @if($returnTrip)
                                    <button type="button" class="btn btn-secondary w-100 mb-2" id="prev-btn" style="display: none;">
                                        <i class="fas fa-arrow-left"></i> Back to Outbound
                                    </button>
                                    <button type="button" class="btn btn-primary w-100 mb-2" id="next-btn" disabled>
                                        Continue to Return <i class="fas fa-arrow-right"></i>
                                    </button>
                                @endif

                                <button type="submit" class="btn btn-success btn-lg w-100" id="confirm-btn" disabled>
                                    <i class="fas fa-check"></i> Confirm Booking
                                </button>
                            </form>


                            <a href="{{ route('trips.search') }}" class="btn btn-outline-secondary w-100 mt-2">
                                <i class="fas fa-arrow-left"></i> Back to Search
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const maxSeats = {{ $search['adults'] + $search['children'] }};
                const hasReturnTrip = {{ $returnTrip ? 'true' : 'false' }};

                let outboundSeats = [];
                let returnSeats = [];
                let currentSection = 'outbound';

                const confirmBtn = document.getElementById('confirm-btn');
                const nextBtn = document.getElementById('next-btn');
                const prevBtn = document.getElementById('prev-btn');

                // Handle seat selection
                document.querySelectorAll('.seat.available').forEach(seat => {
                    seat.addEventListener('click', function() {
                        const seatNum = parseInt(this.dataset.seat);
                        const tripType = this.dataset.trip;

                        if (tripType === 'outbound') {
                            toggleSeat(this, seatNum, outboundSeats, 'outbound');
                        } else {
                            toggleSeat(this, seatNum, returnSeats, 'return');
                        }

                        updateForm();
                    });
                });

                function toggleSeat(element, seatNum, seatsArray, tripType) {
                    if (element.classList.contains('selected')) {
                        element.classList.remove('selected');
                        const index = seatsArray.indexOf(seatNum);
                        if (index > -1) seatsArray.splice(index, 1);
                    } else {
                        if (seatsArray.length >= maxSeats) {
                            alert(`You can only select ${maxSeats} seat(s)`);
                            return;
                        }
                        element.classList.add('selected');
                        seatsArray.push(seatNum);
                    }
                    seatsArray.sort((a, b) => a - b);
                }

                // function updateForm() {
                //     // Update outbound display
                //     updateSeatDisplay('outbound', outboundSeats);
                //
                //     // Update return display if applicable
                //     if (hasReturnTrip) {
                //         updateSeatDisplay('return', returnSeats);
                //     }
                //
                //     // Update buttons
                //     if (hasReturnTrip) {
                //         nextBtn.disabled = outboundSeats.length !== maxSeats;
                //         confirmBtn.style.display = (outboundSeats.length === maxSeats && returnSeats.length === maxSeats) ? 'block' : 'none';
                //     } else {
                //         confirmBtn.disabled = outboundSeats.length !== maxSeats;
                //     }
                //
                //     // Update hidden inputs and passenger names
                //     if (outboundSeats.length === maxSeats && (!hasReturnTrip || returnSeats.length === maxSeats)) {
                //         updateHiddenInputs();
                //         updatePassengerNames();
                //     }
                // }
                function updateForm() {
                    // Update seat displays
                    updateSeatDisplay('outbound', outboundSeats);
                    if (hasReturnTrip) updateSeatDisplay('return', returnSeats);

                    // Update hidden inputs and passenger names (always)
                    updateHiddenInputs();
                    updatePassengerNames();

                    // Update buttons
                    if (hasReturnTrip) {
                        // Next button is enabled only if outbound seats are fully selected
                        nextBtn.disabled = outboundSeats.length !== maxSeats;

                        // Confirm button enabled only if both outbound and return seats are fully selected
                        confirmBtn.disabled = !(outboundSeats.length === maxSeats && returnSeats.length === maxSeats);
                        confirmBtn.style.display = confirmBtn.disabled ? 'none' : 'block';
                    } else {
                        // Single trip
                        confirmBtn.disabled = outboundSeats.length !== maxSeats;
                        confirmBtn.style.display = 'block';
                    }
                }


                function updateSeatDisplay(tripType, seats) {
                    const displayId = tripType + '-seats-display';
                    const display = document.getElementById(displayId);

                    if (seats.length === 0) {
                        display.innerHTML = '<span class="text-muted">No seats selected</span>';
                    } else {
                        display.innerHTML = seats.map(s => `<span class="badge bg-primary me-1">${s}</span>`).join('');
                    }
                }

                function updateHiddenInputs() {
                    // Outbound seats
                    const outboundContainer = document.getElementById('outbound-seat-inputs');
                    outboundContainer.innerHTML = '';
                    outboundSeats.forEach(seat => {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'seat_numbers[]';
                        input.value = seat;
                        outboundContainer.appendChild(input);
                    });

                    // Return seats
                    if (hasReturnTrip) {
                        const returnContainer = document.getElementById('return-seat-inputs');
                        returnContainer.innerHTML = '';
                        returnSeats.forEach(seat => {
                            const input = document.createElement('input');
                            input.type = 'hidden';
                            input.name = 'return_seat_numbers[]';
                            input.value = seat;
                            returnContainer.appendChild(input);
                        });
                    }
                }
                //
                // function updatePassengerNames() {
                //     const container = document.getElementById('passenger-names');
                //     container.innerHTML = '<strong class="d-block mb-2">Passenger Names:</strong>';
                //
                //     outboundSeats.forEach((seat, index) => {
                //         const div = document.createElement('div');
                //         div.className = 'mb-2';
                //
                //         const label = document.createElement('label');
                //         label.className = 'form-label small mb-1';
                //         label.textContent = `Passenger ${index + 1}:`;
                //
                //         const input = document.createElement('input');
                //         input.type = 'text';
                //         input.className = 'form-control form-control-sm';
                //         input.name = 'passenger_names[]';
                //         input.placeholder = 'Full Name';
                //         input.required = true;
                //         input.pattern = '[a-zA-Z\\s]+';
                //
                //         div.appendChild(label);
                //         div.appendChild(input);
                //         container.appendChild(div);
                //     });
                // }
                function updatePassengerNames() {
                    const container = document.getElementById('passenger-names');
                    container.innerHTML = '<strong class="d-block mb-2">Passenger Names:</strong>';

                    // Outbound
                    outboundSeats.forEach((seat, index) => {
                        const div = document.createElement('div');
                        div.className = 'mb-2';
                        const label = document.createElement('label');
                        label.className = 'form-label small mb-1';
                        label.textContent = `Outbound Seat ${seat}:`;
                        const input = document.createElement('input');
                        input.type = 'text';
                        input.className = 'form-control form-control-sm';
                        input.name = 'passenger_names[]';
                        input.placeholder = 'Full Name';
                        input.required = true;
                        input.pattern = '[a-zA-Z\\s]+';
                        div.appendChild(label);
                        div.appendChild(input);
                        container.appendChild(div);
                    });

                    // Return
                    if (hasReturnTrip) {
                        returnSeats.forEach((seat, index) => {
                            const div = document.createElement('div');
                            div.className = 'mb-2';
                            const label = document.createElement('label');
                            label.className = 'form-label small mb-1';
                            label.textContent = `Return Seat ${seat}:`;
                            const input = document.createElement('input');
                            input.type = 'text';
                            input.className = 'form-control form-control-sm';
                            input.name = 'return_passenger_names[]';
                            input.placeholder = 'Full Name';
                            input.required = true;
                            input.pattern = '[a-zA-Z\\s]+';
                            div.appendChild(label);
                            div.appendChild(input);
                            container.appendChild(div);
                        });
                    }
                }

                // Navigation for round trip
                if (nextBtn) {
                    nextBtn.addEventListener('click', function() {
                        document.getElementById('outbound-section').style.display = 'none';
                        document.getElementById('return-section').style.display = 'block';
                        document.getElementById('return-section').classList.add('active');
                        document.getElementById('outbound-section').classList.remove('active');
                        prevBtn.style.display = 'block';
                        nextBtn.style.display = 'none';
                        currentSection = 'return';
                    });
                }

                if (prevBtn) {
                    prevBtn.addEventListener('click', function() {
                        document.getElementById('return-section').style.display = 'none';
                        document.getElementById('outbound-section').style.display = 'block';
                        document.getElementById('outbound-section').classList.add('active');
                        document.getElementById('return-section').classList.remove('active');
                        prevBtn.style.display = 'none';
                        nextBtn.style.display = 'block';
                        currentSection = 'outbound';
                    });
                }

                // Form submission
                document.getElementById('booking-form').addEventListener('submit', function(e) {
                    const requiredSeats = hasReturnTrip ? maxSeats * 2 : maxSeats;
                    const selectedSeats = outboundSeats.length + returnSeats.length;

                    if (selectedSeats < requiredSeats) {
                        e.preventDefault();
                        alert('Please select all required seats');
                        return false;
                    }

                    confirmBtn.disabled = true;
                    confirmBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Processing...';
                });
            });
        </script>
    @endpush
@endsection
