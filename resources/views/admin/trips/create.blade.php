@extends('layouts.admin')

@section('title', 'Create New Trip')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap');

        .create-trip-container {
            font-family: 'Inter', sans-serif;
            animation: fadeIn 0.6s ease-out;
        }

        /* Page Header */
        .create-trip-header {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.05) 0%, rgba(139, 92, 246, 0.05) 100%);
            border-radius: 24px;
            padding: 35px 40px;
            margin-bottom: 30px;
            border: 2px solid rgba(99, 102, 241, 0.1);
            position: relative;
            overflow: hidden;
            animation: fadeInDown 0.6s ease-out;
        }

        .create-trip-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(139, 92, 246, 0.15) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }

        .header-content-create {
            position: relative;
            z-index: 1;
        }

        .create-badge {
            display: inline-block;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            color: white;
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
            margin-bottom: 12px;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .create-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 8px;
            letter-spacing: -1px;
        }

        .create-subtitle {
            color: #64748b;
            font-size: 1rem;
            font-weight: 500;
        }

        /* Form Card */
        .form-card {
            background: white;
            border-radius: 24px;
            box-shadow: 0 10px 40px rgba(99, 102, 241, 0.08);
            border: 2px solid rgba(99, 102, 241, 0.1);
            overflow: hidden;
            animation: fadeInUp 0.6s ease-out 0.2s both;
            position: relative;
        }

        .form-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
        }

        .form-card-header {
            padding: 25px 35px;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.02) 0%, rgba(139, 92, 246, 0.02) 100%);
            border-bottom: 2px solid rgba(99, 102, 241, 0.1);
        }

        .form-card-header h3 {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 800;
            font-size: 1.5rem;
            color: #1e293b;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .form-card-header h3 i {
            color: #8b5cf6;
            font-size: 1.3rem;
        }

        .form-card-body {
            padding: 35px;
        }

        /* Form Styling */
        .form-label {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 0.9rem;
            color: #475569;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .form-label i {
            color: #8b5cf6;
            font-size: 0.85rem;
        }

        .form-control,
        .form-select {
            border: 2px solid rgba(99, 102, 241, 0.2);
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 0.95rem;
            font-weight: 500;
            transition: all 0.3s ease;
            font-family: 'Inter', sans-serif;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #8b5cf6;
            box-shadow: 0 0 0 4px rgba(139, 92, 246, 0.1);
            outline: none;
        }

        .form-control::placeholder {
            color: #94a3b8;
            font-weight: 400;
        }

        .form-control.is-invalid,
        .form-select.is-invalid {
            border-color: #ef4444;
        }

        .invalid-feedback {
            color: #ef4444;
            font-size: 0.85rem;
            font-weight: 600;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .invalid-feedback::before {
            content: '⚠';
            font-size: 1rem;
        }

        /* Form Groups */
        .mb-3 {
            margin-bottom: 25px !important;
        }

        /* Buttons */
        .btn-cancel {
            background: linear-gradient(135deg, #64748b 0%, #475569 100%);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 12px 28px;
            font-weight: 700;
            font-size: 0.95rem;
            font-family: 'Space Grotesk', sans-serif;
            letter-spacing: 0.3px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(100, 116, 139, 0.3);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-cancel:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(100, 116, 139, 0.4);
            color: white;
        }

        .btn-create {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 12px 28px;
            font-weight: 700;
            font-size: 0.95rem;
            font-family: 'Space Grotesk', sans-serif;
            letter-spacing: 0.3px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(99, 102, 241, 0.4);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-create:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(99, 102, 241, 0.5);
            color: white;
        }

        /* Input Icons */
        .input-group-icon {
            position: relative;
        }

        .input-group-icon .form-control,
        .input-group-icon .form-select {
            padding-left: 45px;
        }

        .input-group-icon i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #8b5cf6;
            font-size: 1rem;
            z-index: 10;
        }

        /* Required Indicator */
        .required-indicator {
            color: #ef4444;
            font-weight: 700;
            margin-left: 2px;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .create-title {
                font-size: 2rem;
            }

            .form-card-body {
                padding: 25px;
            }

            .d-flex.justify-content-between {
                flex-direction: column;
                gap: 12px;
            }

            .btn-cancel,
            .btn-create {
                width: 100%;
                justify-content: center;
            }
        }
    </style>

    <div class="create-trip-container">
        <!-- Page Header -->
        <div class="create-trip-header">
            <div class="header-content-create">
                <span class="create-badge">
                    <i class="fas fa-plus"></i> New Entry
                </span>
                <h1 class="create-title">Create New Trip</h1>
                <p class="create-subtitle">Schedule a new trip route for your fleet</p>
            </div>
        </div>

        <!-- Form Card -->
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="form-card">
                    <div class="form-card-header">
                        <h3>
                            <i class="fas fa-route"></i>
                            Trip Information
                        </h3>
                    </div>
                    <div class="form-card-body">
                        <form action="{{ route('admin.trips.store') }}" method="POST">
                            @csrf

                            <!-- Bus Selection -->
                            <div class="mb-3">
                                <label for="bus_id" class="form-label">
                                    <i class="fas fa-bus"></i>
                                    Bus <span class="required-indicator">*</span>
                                </label>
                                <div class="input-group-icon">
                                    <i class="fas fa-bus"></i>
                                    <select class="form-select @error('bus_id') is-invalid @enderror"
                                            id="bus_id" name="bus_id" required>
                                        <option value="">Select Bus</option>
                                        @foreach($buses as $bus)
                                            <option value="{{ $bus->id }}" {{ old('bus_id') == $bus->id ? 'selected' : '' }}>
                                                {{ $bus->bus_number }} - {{ $bus->formatted_bus_type }} ({{ $bus->capacity }} seats)
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('bus_id')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Origin and Destination -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="origin" class="form-label">
                                        <i class="fas fa-map-marker-alt"></i>
                                        Origin <span class="required-indicator">*</span>
                                    </label>
                                    <input type="text" class="form-control @error('origin') is-invalid @enderror"
                                           id="origin" name="origin" value="{{ old('origin') }}"
                                           placeholder="e.g., Manila" required>
                                    @error('origin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="destination" class="form-label">
                                        <i class="fas fa-map-pin"></i>
                                        Destination <span class="required-indicator">*</span>
                                    </label>
                                    <input type="text" class="form-control @error('destination') is-invalid @enderror"
                                           id="destination" name="destination" value="{{ old('destination') }}"
                                           placeholder="e.g., Cebu" required>
                                    @error('destination')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Date and Time -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="departure_date" class="form-label">
                                        <i class="fas fa-calendar-alt"></i>
                                        Departure Date <span class="required-indicator">*</span>
                                    </label>
                                    <input type="date" class="form-control @error('departure_date') is-invalid @enderror"
                                           id="departure_date" name="departure_date" value="{{ old('departure_date') }}"
                                           min="{{ date('Y-m-d') }}" required>
                                    @error('departure_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="departure_time" class="form-label">
                                        <i class="fas fa-clock"></i>
                                        Departure Time <span class="required-indicator">*</span>
                                    </label>
                                    <div class="input-group-icon">
                                        <i class="fas fa-clock"></i>
                                        <select class="form-select @error('departure_time') is-invalid @enderror"
                                                id="departure_time" name="departure_time" required>
                                            <option value="">Select Time</option>
                                            <option value="08:00:00" {{ old('departure_time') === '08:00:00' ? 'selected' : '' }}>8:00 AM</option>
                                            <option value="12:00:00" {{ old('departure_time') === '12:00:00' ? 'selected' : '' }}>12:00 PM</option>
                                            <option value="16:00:00" {{ old('departure_time') === '16:00:00' ? 'selected' : '' }}>4:00 PM</option>
                                        </select>
                                    </div>
                                    @error('departure_time')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Price -->
                            <div class="mb-3">
                                <label for="price" class="form-label">
                                    <i class="fas fa-peso-sign"></i>
                                    Price (₱) <span class="required-indicator">*</span>
                                </label>
                                <input type="number" class="form-control @error('price') is-invalid @enderror"
                                       id="price" name="price" value="{{ old('price') }}"
                                       step="0.01" min="0" placeholder="e.g., 1200.00" required>
                                @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex justify-content-between" style="margin-top: 35px;">
                                <a href="{{ route('admin.trips.index') }}" class="btn-cancel">
                                    <i class="fas fa-times"></i>
                                    Cancel
                                </a>
                                <button type="submit" class="btn-create">
                                    <i class="fas fa-save"></i>
                                    Create Trip
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection