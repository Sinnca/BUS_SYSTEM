@extends('layouts.admin')

@section('title', 'Reservations')

@section('content')
    <div class="row mb-3">
        <div class="col-md-6">
            <h1>Reservations</h1>
        </div>
        <div class="col-md-6">
            <form method="GET" class="row g-2">
                <div class="col-auto">
                    <select name="status" class="form-select" onchange="this.form.submit()">
                        <option value="all">All Status</option>
                        <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                <div class="col-auto">
                    <input type="text" name="search" class="form-control"
                           placeholder="Search..." value="{{ request('search') }}">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
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
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($reservations as $reservation)
                        <tr>
                            <td><strong>{{ $reservation->reservation_code }}</strong></td>
                            <td>{{ $reservation->user->name }}</td>
                            <td>
                                {{ $reservation->trip->origin }} → {{ $reservation->trip->destination }}
                                @if($reservation->is_round_trip)
                                    <span class="badge bg-info">Round Trip</span>
                                @endif
                            </td>
                            <td>{{ $reservation->trip->formatted_date }}</td>
                            <td>
                                {{ $reservation->adults }} adults
                                @if($reservation->children > 0)
                                    , {{ $reservation->children }} children
                                @endif
                            </td>
                            <td>{{ $reservation->formatted_total_price }}</td>
                            <td>
                            <td>
                            <span class="badge
                                @if($reservation->status === 'confirmed') bg-success
                                @elseif($reservation->status === 'pending') bg-warning
                                @elseif($reservation->status === 'cancelled') bg-danger
                                @endif
                            ">
                                {{ ucfirst($reservation->status) }}
                            </span>
                            </td>

                            </td>
                            <td>
                                <a href="{{ route('admin.reservations.show', $reservation) }}"
                                   class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No reservations found</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            {{ $reservations->links() }}
        </div>
    </div>
@endsection
