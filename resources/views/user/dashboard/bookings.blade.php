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
                                <span class="badge bg-light text-dark">{{ ucfirst($reservation->status) }}</span>
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
                                    <i class="fas fa-info-circle"></i> Arrive 30 minutes before departure
                                </small>
                            </div>
                            <div class="col-md-6 text-end">
                                <!-- Print Button (only if not cancelled) -->
                                @if($reservation->status !== 'cancelled')
                                    <button class="btn btn-sm btn-outline-secondary" onclick="window.print()">
                                        <i class="fas fa-print"></i> Print
                                    </button>
                                @endif

                                <!-- Cancel Reservation Button -->
                                @if($reservation->status === 'confirmed' && $reservation->trip->departure_date > now()->toDateString())
                                    <button type="button" class="btn btn-sm btn-outline-danger ms-2" data-bs-toggle="modal" data-bs-target="#cancelModal{{ $reservation->id }}">
                                        <i class="fas fa-times"></i> Cancel
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cancel Modal -->
                @if($reservation->status === 'confirmed' && $reservation->trip->departure_date > now()->toDateString())
                    <div class="modal fade" id="cancelModal{{ $reservation->id }}" tabindex="-1" aria-labelledby="cancelModalLabel{{ $reservation->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-danger" id="cancelModalLabel{{ $reservation->id }}">
                                        Cancel Reservation
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to cancel this reservation? <br>
                                    <strong>Note:</strong> You will need to book a new trip if you cancel.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, Keep Booking</button>
                                    <form action="{{ route('reservation.cancel', $reservation->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Yes, Cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $reservations->links() }}
            </div>
        @endif
    </div>

    <!-- Cancelled Confirmation Modal -->
    @if(session('success'))
        <div class="modal fade" id="cancelledModal" tabindex="-1" aria-labelledby="cancelledModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="cancelledModalLabel">Reservation Cancelled</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <h4>Your reservation has been cancelled.</h4>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Trigger Modal Automatically -->
        <script>
            var cancelledModal = new bootstrap.Modal(document.getElementById('cancelledModal'));
            cancelledModal.show();
        </script>
    @endif

@endsection
