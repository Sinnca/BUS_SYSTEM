@extends('layouts.admin')

@section('title', 'Manage Trips')

@section('content')
    <div class="row mb-3">
        <div class="col-md-6">
            <h1>Trips</h1>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.trips.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Create New Trip
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Route</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Bus</th>
                        <th>Available Seats</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($trips as $trip)
                        <tr>
                            <td><strong>{{ $trip->origin }} → {{ $trip->destination }}</strong></td>
                            <td>{{ $trip->formatted_date }}</td>
                            <td>{{ $trip->formatted_time }}</td>
                            <td>
                                {{ $trip->bus->bus_number }}
                                <span class="badge bg-{{ $trip->bus->bus_type === 'deluxe' ? 'primary' : 'secondary' }}">
                                    {{ $trip->bus->formatted_bus_type }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $trip->available_seats > 10 ? 'success' : ($trip->available_seats > 0 ? 'warning' : 'danger') }}">
                                    {{ $trip->available_seats }} / {{ $trip->bus->capacity }}
                                </span>
                            </td>
                            <td>{{ $trip->formatted_price }}</td>
                            <td>
                                <a href="{{ route('admin.trips.edit', $trip) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.trips.destroy', $trip) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Delete this trip?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No trips found</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            {{ $trips->links() }}
        </div>
    </div>
@endsection
