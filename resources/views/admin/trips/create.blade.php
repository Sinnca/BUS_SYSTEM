@extends('layouts.admin')

@section('title', 'Create New Trip')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3>Create New Trip</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.trips.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="bus_id" class="form-label">Bus *</label>
                            <select class="form-select @error('bus_id') is-invalid @enderror"
                                    id="bus_id" name="bus_id" required>
                                <option value="">Select Bus</option>
                                @foreach($buses as $bus)
                                    <option value="{{ $bus->id }}" {{ old('bus_id') == $bus->id ? 'selected' : '' }}>
                                        {{ $bus->bus_number }} - {{ $bus->formatted_bus_type }} ({{ $bus->capacity }} seats)
                                    </option>
                                @endforeach
                            </select>
                            @error('bus_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="origin" class="form-label">Origin *</label>
                                <input type="text" class="form-control @error('origin') is-invalid @enderror"
                                       id="origin" name="origin" value="{{ old('origin') }}"
                                       placeholder="e.g., Manila" required>
                                @error('origin')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="destination" class="form-label">Destination *</label>
                                <input type="text" class="form-control @error('destination') is-invalid @enderror"
                                       id="destination" name="destination" value="{{ old('destination') }}"
                                       placeholder="e.g., Cebu" required>
                                @error('destination')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="departure_date" class="form-label">Departure Date *</label>
                                <input type="date" class="form-control @error('departure_date') is-invalid @enderror"
                                       id="departure_date" name="departure_date" value="{{ old('departure_date') }}"
                                       min="{{ date('Y-m-d') }}" required>
                                @error('departure_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="departure_time" class="form-label">Departure Time *</label>
                                <select class="form-select @error('departure_time') is-invalid @enderror"
                                        id="departure_time" name="departure_time" required>
                                    <option value="">Select Time</option>
                                    <option value="08:00:00" {{ old('departure_time') === '08:00:00' ? 'selected' : '' }}>8:00 AM</option>
                                    <option value="12:00:00" {{ old('departure_time') === '12:00:00' ? 'selected' : '' }}>12:00 PM</option>
                                    <option value="16:00:00" {{ old('departure_time') === '16:00:00' ? 'selected' : '' }}>4:00 PM</option>
                                </select>
                                @error('departure_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Price (₱) *</label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror"
                                   id="price" name="price" value="{{ old('price') }}"
                                   step="0.01" min="0" placeholder="e.g., 1200.00" required>
                            @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.trips.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Create Trip
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
