@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Dashboard</h1>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Buses</h5>
                    <h2>{{ $stats['total_buses'] }}</h2>
                    <small>{{ $stats['active_buses'] }} active</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Upcoming Trips</h5>
                    <h2>{{ $stats['upcoming_trips'] }}</h2>
                    <small>of {{ $stats['total_trips'] }} total</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">Reservations</h5>
                    <h2>{{ $stats['total_reservations'] }}</h2>
                    <small>{{ $stats['confirmed_reservations'] }} confirmed</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Revenue</h5>
                    <h2>₱{{ number_format($stats['revenue'], 2) }}</h2>
                    <small>{{ $stats['total_users'] }} users</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Reservations -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Recent Reservations</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Code</th>
                            <th>User</th>
                            <th>Trip</th>
                            <th>Date</th>
                            <th>Passengers</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($recent_reservations as $reservation)
                            <tr>
                                <td><strong>{{ $reservation->reservation_code }}</strong></td>
                                <td>{{ $reservation->user->name }}</td>
                                <td>{{ $reservation->trip->origin }} → {{ $reservation->trip->destination }}</td>
                                <td>{{ $reservation->trip->formatted_date }}</td>
                                <td>{{ $reservation->total_passengers }}</td>
                                <td>{{ $reservation->formatted_total_price }}</td>
                                <td>
                                    <span class="badge bg-{{ $reservation->status === 'confirmed' ? 'success' : 'danger' }}">
                                        {{ ucfirst($reservation->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No reservations yet</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
