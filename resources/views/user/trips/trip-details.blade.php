@extends('layouts.app')

@section('title', 'Trip Details')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">
                            <i class="fas fa-route"></i> Trip Details
                        </h4>
                    </div>
                    <div class="card-body">
                        <!-- Route Info -->
                        <div class="row mb-4">
                            <div class="col-md-5 text-center">
                                <h2 class="text-primary">{{ $trip->origin }}</h2>
                                <p class="text-muted">Departure</p>
                            </div>
                            <div class="col-md-2 text-center">
                                <i class="fas fa-arrow-right fa-3x text-secondary"></i>
                            </div>
                            <div class="col-md-5 text-center">
                                <h2 class="text-primary">{{ $trip->destination }}</h2>
                                <p class="text-muted">Arrival</p>
                            </div>
                        </div>

                        <hr>

                        <!-- Trip Information -->
                        <h5 class="mb-3">Trip Information</h5>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p><strong>Date:</strong><br>{{ $trip->formatted_date }}</p>
                                <p><strong>Departure Time:</strong><br>{{ $trip->formatted_time }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Bus Number:</strong><br>{{ $trip->bus->bus_number }}</p>
                                <p><strong>Bus Type:</strong><br>
                                    <span class="badge bg-{{ $trip->bus->bus_type === 'deluxe' ? 'primary' : 'secondary' }}">
                                {{ $trip->bus->formatted_bus_type }}
                                </span>
                                </p>
                            </div>
                        </div>

                        <hr>

                        <!-- Availability -->
                        <h5 class="mb-3">Seat Availability</h5>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <h3 class="text-{{ $trip->available_seats > 10 ? 'success' : 'warning' }}">
                                            {{ $trip->available_seats }}
                                        </h3>
                                        <p class="mb-0">Available Seats</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <h3 class="text-muted">{{ $trip->bus->capacity }}</h3>
                                        <p class="mb-0">Total Capacity</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Occupancy Bar -->
                        <div class="mb-3">
                            <label class="form-label">Occupancy Rate</label>
                            <div class="progress" style="height: 25px;">
                                <div class="progress-bar bg-{{ $trip->occupancy_rate < 50 ? 'success' : ($trip->occupancy_rate < 80 ? 'warning' : 'danger') }}"
                                     role="progressbar"
                                     style="width: {{ $trip->occupancy_rate }}%"
                                     aria-valuenow="{{ $trip->occupancy_rate }}"
                                     aria-valuemin="0"
                                     aria-valuemax="100">
                                    {{ $trip->occupancy_rate }}%
                                </div>
                            </div>
                        </div>

                        <hr>

                        <!-- Pricing -->
                        <h5 class="mb-3">Pricing</h5>
                        <div class="row">
                            <div class="col-md-12">
                                <p><strong>Price per Seat:</strong> <span class="text-success h4">{{ $trip->formatted_price }}</span></p>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="row g-2 align-items-end">
                            <div class="col-md-6">
                                <a href="{{ route('trips.search') }}" class="btn btn-secondary w-100">
                                    <i class="fas fa-arrow-left"></i> Back to Search
                                </a>
                            </div>
                            <div class="col-md-6">
                                @auth
                                    @if($trip->available_seats > 0)
                                        <!-- Booking Form -->
                                        <form action="{{ route('booking.seats', $trip) }}" method="GET" class="row g-2 align-items-end" id="booking-form">
                                            <div class="col">
                                                <label for="adults" class="form-label mb-0">Adults</label>
                                                <input type="number" id="adults" name="adults" class="form-control" value="1" min="1" placeholder="Adults">
                                            </div>
                                            <div class="col">
                                                <label for="children" class="form-label mb-0">Children</label>
                                                <input type="number" id="children" name="children" class="form-control" value="0" min="0" placeholder="Children">
                                            </div>
                                            <div class="col-auto">
                                                <button type="submit" class="btn btn-success w-100">
                                                    <i class="fas fa-ticket-alt"></i> Book
                                                </button>
                                            </div>
                                        </form>
                                    @else
                                        <button class="btn btn-danger w-100" disabled>
                                            <i class="fas fa-times"></i> Fully Booked
                                        </button>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-success w-100">
                                        <i class="fas fa-sign-in-alt"></i> Login to Book
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Information -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-info-circle"></i> Important Information</h5>
                    </div>
                    <div class="card-body">
                        <ul class="mb-0">
                            <li>Please arrive at the terminal at least 30 minutes before departure</li>
                            <li>Bring a valid ID for verification purposes</li>
                            <li>Luggage allowance: 1 check-in bag + 1 carry-on</li>
                            <li>Cancellations must be made at least 24 hours in advance</li>
                            <li>Children under 12 years old must be accompanied by an adult</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-md-4">
                <!-- Bus Features -->
                <div class="card mb-3">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">Bus Features</h5>
                    </div>
                    <div class="card-body">
                        @if($trip->bus->bus_type === 'deluxe')
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check text-success"></i> Air Conditioning</li>
                                <li><i class="fas fa-check text-success"></i> Reclining Seats</li>
                                <li><i class="fas fa-check text-success"></i> Free WiFi</li>
                                <li><i class="fas fa-check text-success"></i> USB Charging Ports</li>
                                <li><i class="fas fa-check text-success"></i> Extra Legroom</li>
                                <li><i class="fas fa-check text-success"></i> Onboard Restroom</li>
                            </ul>
                        @else
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check text-success"></i> Air Conditioning</li>
                                <li><i class="fas fa-check text-success"></i> Comfortable Seats</li>
                                <li><i class="fas fa-check text-success"></i> Onboard Restroom</li>
                            </ul>
                        @endif
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="card mb-3">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">Quick Stats</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Trip ID:</strong> #{{ $trip->id }}</p>
                        <p><strong>Bus Capacity:</strong> {{ $trip->bus->capacity }} passengers</p>
                        <p><strong>Seats Left:</strong> {{ $trip->available_seats }}</p>
                        <p class="mb-0"><strong>Status:</strong>
                            <span class="badge bg-{{ $trip->is_sold_out ? 'danger' : 'success' }}">
                        {{ $trip->is_sold_out ? 'Sold Out' : 'Available' }}
                    </span>
                        </p>
                    </div>
                </div>

                <!-- Seat Map Preview -->
                <div class="card">
                    <div class="card-header bg-warning text-dark">
                        <h5 class="mb-0">Seat Map Preview</h5>
                    </div>
                    <div class="card-body text-center">
                        <div style="background: #f8f9fa; padding: 20px; border-radius: 10px;">
                            <div style="background: #333; color: white; padding: 10px; border-radius: 5px; margin-bottom: 10px;">
                                <i class="fas fa-steering-wheel"></i> DRIVER
                            </div>
                            @php
                                $rows = ceil($trip->bus->capacity / 4);
                            @endphp
                            @for($i = 0; $i < min($rows, 3); $i++)
                                <div style="display: flex; gap: 5px; justify-content: center; margin-bottom: 5px;">
                                    <div style="width: 30px; height: 30px; background: #28a745; border-radius: 3px;"></div>
                                    <div style="width: 30px; height: 30px; background: #28a745; border-radius: 3px;"></div>
                                    <div style="width: 20px;"></div>
                                    <div style="width: 30px; height: 30px; background: #28a745; border-radius: 3px;"></div>
                                    <div style="width: 30px; height: 30px; background: #28a745; border-radius: 3px;"></div>
                                </div>
                            @endfor
                            @if($rows > 3)
                                <p class="text-muted mt-2">... and {{ $rows - 3 }} more rows</p>
                            @endif
                        </div>
                        <small class="text-muted d-block mt-2">
                            <i class="fas fa-square" style="color: #28a745;"></i> Available
                            <i class="fas fa-square ms-2" style="color: #6c757d;"></i> Reserved
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Not Enough Seats Modal -->
    <div class="modal fade" id="notEnoughSeatsModal" tabindex="-1" aria-labelledby="notEnoughSeatsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-danger">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="notEnoughSeatsModalLabel">Not Enough Seats</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-body-text">
                    Sorry! There are not enough seats available for this trip.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const availableSeats = {{ $trip->available_seats }};
                const form = document.getElementById('booking-form');
                const adultsInput = document.getElementById('adults');
                const childrenInput = document.getElementById('children');
                const modal = new bootstrap.Modal(document.getElementById('notEnoughSeatsModal'));
                const modalBody = document.getElementById('modal-body-text');

                form.addEventListener('submit', function(e) {
                    const adults = parseInt(adultsInput.value) || 0;
                    const children = parseInt(childrenInput.value) || 0;
                    const totalSeats = adults + children;

                    if (totalSeats > availableSeats) {
                        e.preventDefault();
                        modalBody.innerHTML = `
                Sorry! There are not enough seats available for this trip.
                <br><strong>Requested:</strong> ${totalSeats} seat(s)
                <br><strong>Available:</strong> ${availableSeats} seat(s)
            `;
                        modal.show();
                        return false;
                    }
                });
            });
        </script>
    @endpush
@endsection
