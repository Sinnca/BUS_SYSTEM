@extends('layouts.admin')

@section('title', 'Manage Buses')

@section('content')
    <div class="row mb-3">
        <div class="col-md-6">
            <h1>Buses</h1>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.buses.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Bus
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Bus Number</th>
                    <th>Type</th>
                    <th>Capacity</th>
                    <th>Status</th>
                    <th>Total Trips</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($buses as $bus)
                    <tr>
                        <td><strong>{{ $bus->bus_number }}</strong></td>
                        <td>
                            <span class="badge bg-{{ $bus->bus_type === 'deluxe' ? 'primary' : 'secondary' }}">
                                {{ $bus->formatted_bus_type }}
                            </span>
                        </td>
                        <td>{{ $bus->capacity }} seats</td>
                        <td>
                            <span class="badge bg-{{ $bus->status === 'active' ? 'success' : 'warning' }}">
                                {{ ucfirst($bus->status) }}
                            </span>
                        </td>
                        <td>{{ $bus->trips_count }}</td>
                        <td>
                            <a href="{{ route('admin.buses.edit', $bus) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.buses.destroy', $bus) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No buses found</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            {{ $buses->links() }}
        </div>
    </div>
@endsection
