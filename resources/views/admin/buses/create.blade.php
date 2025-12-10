@extends('layouts.admin')

@section('title', 'Add New Bus')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3>Add New Bus</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.buses.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="bus_number" class="form-label">Bus Number *</label>
                            <input type="text" class="form-control @error('bus_number') is-invalid @enderror"
                                   id="bus_number" name="bus_number" value="{{ old('bus_number') }}" required>
                            @error('bus_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Example: DLX-001, REG-001</small>
                        </div>

                        <div class="mb-3">
                            <label for="bus_type" class="form-label">Bus Type *</label>
                            <select class="form-select @error('bus_type') is-invalid @enderror"
                                    id="bus_type" name="bus_type" required>
                                <option value="">Select Bus Type</option>
                                <option value="deluxe" {{ old('bus_type') === 'deluxe' ? 'selected' : '' }}>
                                    Deluxe (20 seats)
                                </option>
                                <option value="regular" {{ old('bus_type') === 'regular' ? 'selected' : '' }}>
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
                                <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                <option value="maintenance" {{ old('status') === 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.buses.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Create Bus
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
