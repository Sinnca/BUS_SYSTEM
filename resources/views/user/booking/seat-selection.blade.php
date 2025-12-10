@extends('layouts.app')

@section('title', 'Select Seats')

@push('styles')
    <style>
        .seat-map {
            display: flex;
            flex-direction: column;
            gap: 10px;
            max-width: 400px;
            margin: 0 auto;
        }

        .seat-row {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .seat {
            width: 50px;
            height: 50px;
            border: 2px solid #ddd;
            background: #fff;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .seat.available:hover {
            background: #e3f2fd;
            border-color: #2196F3;
            transform: scale(1.05);
        }

        .seat.selected {
            background: #2196F3;
            color: white;
            border-color: #1976D2;
        }

        .seat.reserved {
            background: #ccc;
            cursor: not-allowed;
            color: #666;
        }

        .seat.driver {
            background: #333;
            color: white;
            cursor: default;
        }

        .legend {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .legend-box {
            width: 30px;
            height: 30px;
            border: 2px solid #ddd;
            border-radius: 5px;
        }

        .booking-summary {
            position: sticky;
            top: 20px;
        }
    </style>
@endpush

@section('content')
    <div class="container py-4">
        <div class="row">
            <!-- Seat Map -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">
                            <i class="fas fa-chair"></i> Select Your Seats
                        </h4>
                    </div>
                    <div class="card-body">
                        <!-- Trip Info -->
                        <div class="alert alert-info">
                            <h5>{{ $trip->origin }} → {{ $trip->destination }}</h5>
                            <p class="mb-0">
                                <i class="fas fa-calendar"></i> {{ $trip->formatted_date }} |
                                <i class="fas fa-clock"></i> {{ $trip->formatted_time }} |
                                <i class="fas fa-bus"></i> {{ $trip->bus->formatted_bus_type }} ({{ $trip->bus->bus_number }})
                            </p>
                        </div>

                        <!-- Instructions -->
                        <div class="alert alert-warning">
                            <i class="fas fa-info-circle"></i>
                            Please select <strong>{{ $search['adults'] + $search['children'] }}</strong> seat(s)
                            ({{ $search['adults'] }} adult{{ $search['adults'] > 1 ? 's' : '' }}
                            @if($search['children'] > 0), {{ $search['children'] }} child(ren)@endif)
                        </div>

                        <!-- Bus Front Indicator -->
                        <div class="text-center mb-3">
                            <div class="badge bg-dark" style="padding: 10px 50px;">
                                <i class="fas fa-steering-wheel"></i> FRONT
                            </div>
                        </div>

                        <!-- Seat Map -->
                        <div class="seat-map">
                            @php
                                $capacity = $trip->bus->capacity;
                                $cols = 4; // 4 seats per row
                                $rows = ceil($capacity / $cols);
                            @endphp

                            @for($row = 1; $row <= $rows; $row++)
                                <div class="seat-row">
                                    @for($col = 1; $col <= $cols; $col++)
                                        @php
                                            $seatNum = ($row - 1) * $cols + $col;
                                        @endphp

                                        @if($seatNum <= $capacity)
                                            @php
                                                $isReserved = in_array($seatNum, $reservedSeats);
                                            @endphp

                                            <button
                                                type="button"
                                                class="seat {{ $isReserved ? 'reserved' : 'available' }}"
                                                data-seat="{{ $seatNum }}"
                                                {{ $isReserved ? 'disabled' : '' }}>
                                                {{ $seatNum }}
                                            </button>
                                        @else
                                            <div style="width: 50px;"></div>
                                        @endif

                                        {{-- Add aisle after 2nd seat --}}
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
                                <div class="legend-box" style="background: #fff; border-color: #ddd;"></div>
                                <span>Available</span>
                            </div>
                            <div class="legend-item">
                                <div class="legend-box" style="background: #2196F3; border-color: #1976D2;"></div>
                                <span>Selected</span>
                            </div>
                            <div class="legend-item">
                                <div class="legend-box" style="background: #ccc; border-color: #999;"></div>
                                <span>Reserved</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Booking Summary & Form -->
            <div class="col-lg-4">
                <div class="booking-summary">
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">Booking Summary</h5>
                        </div>
                        <div class="card-body">
                            <!-- Selected Seats Display -->
                            <div class="mb-3">
                                <strong>Selected Seats:</strong>
                                <div id="selected-seats-display" class="mt-2">
                                    <span class="text-muted">No seats selected</span>
                                </div>
                            </div>

                            <hr>

                            <!-- Price Breakdown -->
                            <div class="mb-3">
                                <div class="d-flex justify-content-between">
                                    <span>Adults ({{ $search['adults'] }}):</span>
                                    <span>{{ $trip->formatted_price }}</span>
                                </div>
                                @if($search['children'] > 0)
                                    <div class="d-flex justify-content-between">
                                        <span>Children ({{ $search['children'] }}):</span>
                                        <span>{{ $trip->formatted_price }}</span>
                                    </div>
                                @endif
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <strong>Total:</strong>
                                    <strong class="text-success" id="total-price">
                                        ₱{{ number_format($trip->price * ($search['adults'] + $search['children']), 2) }}
                                    </strong>
                                </div>
                            </div>

                            <hr>

                            <!-- Booking Form -->
                            <form action="{{ route('booking.store') }}" method="POST" id="booking-form">
                                @csrf

                                <input type="hidden" name="trip_id" value="{{ $trip->id }}">

                                <!-- Hidden inputs for selected seats -->
                                <div id="seat-inputs"></div>

                                <!-- Passenger Names -->
                                <div id="passenger-names" class="mb-3"></div>

                                <!-- Submit Button -->
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
                let selectedSeats = [];

                const confirmBtn = document.getElementById('confirm-btn');
                const seatInputsContainer = document.getElementById('seat-inputs');
                const passengerNamesContainer = document.getElementById('passenger-names');
                const selectedSeatsDisplay = document.getElementById('selected-seats-display');

                // Handle seat clicks
                document.querySelectorAll('.seat.available').forEach(seat => {
                    seat.addEventListener('click', function() {
                        const seatNum = parseInt(this.dataset.seat);

                        if (this.classList.contains('selected')) {
                            // Deselect seat
                            this.classList.remove('selected');
                            selectedSeats = selectedSeats.filter(s => s !== seatNum);
                        } else {
                            // Check if max seats reached
                            if (selectedSeats.length >= maxSeats) {
                                alert(`You can only select ${maxSeats} seat(s)`);
                                return;
                            }

                            // Select seat
                            this.classList.add('selected');
                            selectedSeats.push(seatNum);
                        }

                        // Sort seats numerically
                        selectedSeats.sort((a, b) => a - b);

                        updateForm();
                    });
                });

                function updateForm() {
                    // Update selected seats display
                    if (selectedSeats.length === 0) {
                        selectedSeatsDisplay.innerHTML = '<span class="text-muted">No seats selected</span>';
                    } else {
                        selectedSeatsDisplay.innerHTML = selectedSeats
                            .map(seat => `<span class="badge bg-primary me-1">${seat}</span>`)
                            .join('');
                    }

                    // Clear previous inputs
                    seatInputsContainer.innerHTML = '';
                    passengerNamesContainer.innerHTML = '';

                    // Add hidden inputs for seats
                    selectedSeats.forEach(seat => {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'seat_numbers[]';
                        input.value = seat;
                        seatInputsContainer.appendChild(input);
                    });

                    // Add passenger name inputs
                    if (selectedSeats.length > 0) {
                        passengerNamesContainer.innerHTML = '<strong class="d-block mb-2">Passenger Names:</strong>';

                        selectedSeats.forEach((seat, index) => {
                            const formGroup = document.createElement('div');
                            formGroup.className = 'mb-2';

                            const label = document.createElement('label');
                            label.className = 'form-label small mb-1';
                            label.textContent = `Seat ${seat}:`;

                            const input = document.createElement('input');
                            input.type = 'text';
                            input.className = 'form-control form-control-sm';
                            input.name = 'passenger_names[]';
                            input.placeholder = 'Full Name';
                            input.required = true;
                            input.pattern = '[a-zA-Z\\s]+';
                            input.title = 'Letters and spaces only';

                            formGroup.appendChild(label);
                            formGroup.appendChild(input);
                            passengerNamesContainer.appendChild(formGroup);
                        });
                    }

                    // Enable/disable confirm button
                    confirmBtn.disabled = selectedSeats.length !== maxSeats;
                }

                // Form validation before submit
                document.getElementById('booking-form').addEventListener('submit', function(e) {
                    if (selectedSeats.length !== maxSeats) {
                        e.preventDefault();
                        alert(`Please select exactly ${maxSeats} seat(s)`);
                        return false;
                    }

                    // Check if all passenger names are filled
                    const nameInputs = document.querySelectorAll('input[name="passenger_names[]"]');
                    let allFilled = true;
                    nameInputs.forEach(input => {
                        if (!input.value.trim()) {
                            allFilled = false;
                            input.classList.add('is-invalid');
                        } else {
                            input.classList.remove('is-invalid');
                        }
                    });

                    if (!allFilled) {
                        e.preventDefault();
                        alert('Please enter all passenger names');
                        return false;
                    }

                    // Show loading state
                    confirmBtn.disabled = true;
                    confirmBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Processing...';
                });
            });
        </script>
    @endpush
@endsection
