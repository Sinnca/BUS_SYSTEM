@extends('layouts.admin')

@section('title', 'Edit Trip')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap');

        .edit-trip-container {
            font-family: 'Inter', sans-serif;
            animation: fadeIn 0.6s ease-out;
        }

        /* Page Header */
        .edit-trip-header {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.05) 0%, rgba(139, 92, 246, 0.05) 100%);
            border-radius: 24px;
            padding: 35px 40px;
            margin-bottom: 30px;
            border: 2px solid rgba(99, 102, 241, 0.1);
            position: relative;
            overflow: hidden;
            animation: fadeInDown 0.6s ease-out;
        }

        .edit-trip-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(139, 92, 246, 0.15) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }

        .header-content-edit {
            position: relative;
            z-index: 1;
        }

        .edit-badge {
            display: inline-block;
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
            margin-bottom: 12px;
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.4);
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .edit-title {
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

        .edit-subtitle {
            color: #64748b;
            font-size: 1rem;
            font-weight: 500;
        }

        .route-highlight {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 800;
            color: #8b5cf6;
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

        /* Info Alert */
        .info-alert {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.05) 0%, rgba(139, 92, 246, 0.05) 100%);
            border: 2px solid rgba(99, 102, 241, 0.2);
            border-radius: 16px;
            padding: 20px 25px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .info-alert-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.3rem;
            flex-shrink: 0;
        }

        .info-alert-content {
            flex: 1;
        }

        .info-alert-title {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 800;
            font-size: 1rem;
            color: #1e293b;
            margin-bottom: 4px;
        }

        .info-alert-text {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 1.3rem;
            color: #6366f1;
            margin: 0;
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

        .btn-update {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 12px 28px;
            font-weight: 700;
            font-size: 0.95rem;
            font-family: 'Space Grotesk', sans-serif;
            letter-spacing: 0.3px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(245, 158, 11, 0.4);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-update:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(245, 158, 11, 0.5);
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
            .edit-title {
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
            .btn-update {
                width: 100%;
                justify-content: center;
            }

            .info-alert {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>

    <div class="edit-trip-container">
        <!-- Page Header -->
        <div class="edit-trip-header">
            <div class="header-content-edit">
                <span class="edit-badge">
                    <i class="fas fa-edit"></i> Edit Mode
                </span>
                <h1 class="edit-title">Edit Trip</h1>
                <p class="edit-subtitle">
                    Updating trip: <span class="route-highlight">{{ $trip->origin }} → {{ $trip->destination }}</span>
                </p>
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
                        <form action="{{ route('admin.trips.update', $trip) }}" method="POST">
                            @csrf
                            @method('PUT')

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
                                            <option value="{{ $bus->id }}"
                                                {{ old('bus_id', $trip->bus_id) == $bus->id ? 'selected' : '' }}>
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
                                           id="origin" name="origin" value="{{ old('origin', $trip->origin) }}"
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
                                           id="destination" name="destination" value="{{ old('destination', $trip->destination) }}"
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
                                           id="departure_date" name="departure_date"
                                           value="{{ old('departure_date', $trip->departure_date->format('Y-m-d')) }}" required>
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
                                            <option value="08:00:00" {{ old('departure_time', $trip->departure_time->format('H:i:s')) === '08:00:00' ? 'selected' : '' }}>8:00 AM</option>
                                            <option value="12:00:00" {{ old('departure_time', $trip->departure_time->format('H:i:s')) === '12:00:00' ? 'selected' : '' }}>12:00 PM</option>
                                            <option value="16:00:00" {{ old('departure_time', $trip->departure_time->format('H:i:s')) === '16:00:00' ? 'selected' : '' }}>4:00 PM</option>
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
                                       id="price" name="price" value="{{ old('price', $trip->price) }}"
                                       step="0.01" min="0" placeholder="e.g., 1200.00" required>
                                @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Current Seats Info -->
                            <div class="info-alert">
                                <div class="info-alert-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="info-alert-content">
                                    <div class="info-alert-title">Current Available Seats</div>
                                    <div class="info-alert-text">
                                        {{ $trip->available_seats }} / {{ $trip->bus->capacity }}
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex justify-content-between" style="margin-top: 35px;">
                                <a href="{{ route('admin.trips.index') }}" class="btn-cancel">
                                    <i class="fas fa-times"></i>
                                    Cancel
                                </a>
                                <button type="submit" class="btn-update">
                                    <i class="fas fa-save"></i>
                                    Update Trip
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection