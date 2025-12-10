@extends('layouts.admin')

@section('title', 'Edit Bus')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Bus: {{ $bus->bus_number }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.buses.update', $bus) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="bus_number" class="form-label">Bus Number *</label>
                            <input type="text" class="form-control @error('bus_number') is-invalid @enderror"
                                   id="bus_number" name="bus_number" value="{{ old('bus_number', $bus->bus_number) }}" required>
                            @error('bus_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="bus_type" class="form-label">Bus Type *</label>
                            <select class="form-select @error('bus_type') is-invalid @enderror"
                                    id="bus_type" name="bus_type" required>
                                <option value="deluxe" {{ old('bus_type', $bus->bus_type) === 'deluxe' ? 'selected' : '' }}>
                                    Deluxe (20 seats)
                                </option>
                                <option value="regular" {{ old('bus_type', $bus->bus_type) === 'regular' ? 'selected' : '' }}>
                                    Regular (40 seats)
                                </option>
                            </select>
                            @error('bus_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status *</label>
                            <select class="form-select @error('status') is-invalid @enderror"
                                    id="status" name="status" required>
                                <option value="active" {{ old('status', $bus->status) === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status', $bus->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                <option value="maintenance" {{ old('status', $bus->status) === 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.buses.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Bus
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
