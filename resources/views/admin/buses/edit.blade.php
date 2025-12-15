@extends('layouts.admin')

@section('title', 'Edit Bus')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap');

        .edit-bus-container {
            font-family: 'Inter', sans-serif;
            animation: fadeInUp 0.6s ease-out;
        }

        .form-header-wrapper {
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.05) 0%, rgba(217, 119, 6, 0.05) 100%);
            border-radius: 24px;
            padding: 40px;
            margin-bottom: 30px;
            border: 2px solid rgba(245, 158, 11, 0.15);
            position: relative;
            overflow: hidden;
        }

        .form-header-wrapper::before {
            content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
            background: radial-gradient(circle, rgba(245, 158, 11, 0.1) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }

        .form-header-content {
            position: relative;
            z-index: 1;
        }

        .form-badge {
            display: inline-block;
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 700;
            margin-bottom: 15px;
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .form-main-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 10px;
            letter-spacing: -1px;
        }

        .bus-number-highlight {
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.1) 0%, rgba(217, 119, 6, 0.1) 100%);
            padding: 8px 16px;
            border-radius: 12px;
            display: inline-block;
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            color: #d97706;
            border: 2px solid rgba(245, 158, 11, 0.2);
        }

        .form-subtitle {
            color: #64748b;
            font-size: 1.05rem;
            font-weight: 500;
            margin-top: 15px;
        }

        .modern-card {
            background: white;
            border-radius: 28px;
            box-shadow: 0 10px 40px rgba(245, 158, 11, 0.08);
            border: 2px solid rgba(245, 158, 11, 0.1);
            padding: 45px;
            position: relative;
            overflow: hidden;
            animation: fadeInUp 0.6s ease-out 0.2s both;
        }

        .modern-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #f59e0b 0%, #d97706 50%, #b45309 100%);
        }

        .info-banner {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.05) 0%, rgba(37, 99, 235, 0.05) 100%);
            border: 2px solid rgba(59, 130, 246, 0.15);
            border-radius: 16px;
            padding: 18px 22px;
            margin-bottom: 35px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .info-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .info-text {
            color: #475569;
            font-size: 0.95rem;
            font-weight: 600;
            margin: 0;
        }

        .form-section-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 25px;
            padding-bottom: 12px;
            border-bottom: 2px solid rgba(245, 158, 11, 0.1);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-section-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            border-radius: 10px;
            color: white;
            font-size: 0.9rem;
        }

        .modern-form-group {
            margin-bottom: 28px;
            animation: fadeInUp 0.6s ease-out both;
        }

        .modern-form-group:nth-child(1) {
            animation-delay: 0.1s;
        }

        .modern-form-group:nth-child(2) {
            animation-delay: 0.2s;
        }

        .modern-form-group:nth-child(3) {
            animation-delay: 0.3s;
        }

        .modern-label {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 10px;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 8px;
            letter-spacing: 0.3px;
        }

        .label-icon {
            color: #f59e0b;
            font-size: 1rem;
        }

        .required-asterisk {
            color: #ef4444;
            font-weight: 700;
        }

        .modern-input, .modern-select {
            border: 2px solid #e2e8f0;
            border-radius: 14px;
            padding: 14px 18px;
            font-size: 1rem;
            font-weight: 500;
            transition: all 0.3s ease;
            background: #f8fafc;
            color: #1e293b;
            font-family: 'Inter', sans-serif;
        }

        .modern-input:focus, .modern-select:focus {
            border-color: #f59e0b;
            box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.1);
            outline: none;
            background: white;
        }

        .modern-input:hover, .modern-select:hover {
            border-color: #cbd5e1;
            background: white;
        }

        .input-hint {
            font-size: 0.85rem;
            color: #64748b;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 500;
        }

        .input-hint i {
            color: #f59e0b;
            font-size: 0.9rem;
        }

        .current-value-badge {
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.1) 0%, rgba(217, 119, 6, 0.1) 100%);
            border: 2px solid rgba(245, 158, 11, 0.2);
            border-radius: 8px;
            padding: 4px 10px;
            font-size: 0.8rem;
            font-weight: 700;
            color: #d97706;
            display: inline-block;
            margin-left: 8px;
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 40px;
            padding-top: 30px;
            border-top: 2px solid rgba(245, 158, 11, 0.1);
            animation: fadeInUp 0.6s ease-out 0.4s both;
        }

        .btn-modern-cancel {
            background: #f1f5f9;
            color: #475569;
            border: 2px solid #e2e8f0;
            border-radius: 14px;
            padding: 14px 32px;
            font-weight: 700;
            font-size: 1rem;
            transition: all 0.3s ease;
            font-family: 'Space Grotesk', sans-serif;
            letter-spacing: 0.3px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-modern-cancel:hover {
            background: #e2e8f0;
            color: #1e293b;
            border-color: #cbd5e1;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .btn-modern-submit {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 50%, #b45309 100%);
            color: white;
            border: none;
            border-radius: 14px;
            padding: 14px 36px;
            font-weight: 700;
            font-size: 1rem;
            transition: all 0.3s ease;
            font-family: 'Space Grotesk', sans-serif;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 20px rgba(245, 158, 11, 0.4);
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-modern-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(245, 158, 11, 0.5);
        }

        .btn-modern-submit i {
            font-size: 1.1rem;
        }

        .invalid-feedback {
            font-size: 0.85rem;
            font-weight: 600;
            color: #ef4444;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .invalid-feedback::before {
            content: "⚠";
            font-size: 1rem;
        }

        .is-invalid {
            border-color: #ef4444 !important;
            background-color: #fef2f2 !important;
        }

        .is-invalid:focus {
            box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1) !important;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }
         @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

        @media (max-width: 768px) {
            .form-main-title {
                font-size: 2rem;
            }

            .form-header-wrapper {
                padding: 25px;
            }

            .modern-card {
                padding: 25px;
            }

            .form-actions {
                flex-direction: column;
                gap: 15px;
            }

            .btn-modern-cancel,
            .btn-modern-submit {
                width: 100%;
                justify-content: center;
            }
        }
    </style>

    <div class="edit-bus-container">
        <!-- Header Section -->
        <div class="form-header-wrapper">
            <div class="form-header-content">
                <span class="form-badge">
                    <i class="fas fa-edit"></i> Edit Mode
                </span>
                <h1 class="form-main-title">
                    Edit Bus: <span class="bus-number-highlight">{{ $bus->bus_number }}</span>
                </h1>
                <p class="form-subtitle">Update bus information and modify settings</p>
            </div>
        </div>

        <!-- Form Card -->
        <div class="row">
            <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-2">
                <div class="modern-card">
                    <!-- Info Banner -->
                    <div class="info-banner">
                        <div class="info-icon">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <p class="info-text">
                            You are editing <strong>{{ $bus->bus_number }}</strong>. Changes will be applied immediately after saving.
                        </p>
                    </div>

                    <div class="form-section-title">
                        <span class="form-section-icon">
                            <i class="fas fa-cog"></i>
                        </span>
                        Bus Configuration
                    </div>

                    <form action="{{ route('admin.buses.update', $bus) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="modern-form-group">
                            <label for="bus_number" class="modern-label">
                                <i class="fas fa-hashtag label-icon"></i>
                                Bus Number
                                <span class="required-asterisk">*</span>
                                <span class="current-value-badge">Current</span>
                            </label>
                            <input type="text" 
                                   class="form-control modern-input @error('bus_number') is-invalid @enderror"
                                   id="bus_number" 
                                   name="bus_number" 
                                   value="{{ old('bus_number', $bus->bus_number) }}" 
                                   placeholder="e.g., DLX-001 or REG-001"
                                   required>
                            @error('bus_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="input-hint">
                                <i class="fas fa-info-circle"></i>
                                Modify the unique identifier for this bus
                            </div>
                        </div>

                        <div class="modern-form-group">
                            <label for="bus_type" class="modern-label">
                                <i class="fas fa-layer-group label-icon"></i>
                                Bus Type
                                <span class="required-asterisk">*</span>
                                @if($bus->bus_type === 'deluxe')
                                    <span class="current-value-badge">Deluxe</span>
                                @else
                                    <span class="current-value-badge">Regular</span>
                                @endif
                            </label>
                            <select class="form-select modern-select @error('bus_type') is-invalid @enderror"
                                    id="bus_type" 
                                    name="bus_type" 
                                    required>
                                <option value="deluxe" {{ old('bus_type', $bus->bus_type) === 'deluxe' ? 'selected' : '' }}>
                                    🌟 Deluxe (20 seats)
                                </option>
                                <option value="regular" {{ old('bus_type', $bus->bus_type) === 'regular' ? 'selected' : '' }}>
                                    🚌 Regular (40 seats)
                                </option>
                            </select>
                            @error('bus_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="input-hint">
                                <i class="fas fa-info-circle"></i>
                                Change the seating capacity and comfort level
                            </div>
                        </div>

                        <div class="modern-form-group">
                            <label for="status" class="modern-label">
                                <i class="fas fa-toggle-on label-icon"></i>
                                Bus Status
                                <span class="required-asterisk">*</span>
                                <span class="current-value-badge">{{ ucfirst($bus->status) }}</span>
                            </label>
                            <select class="form-select modern-select @error('status') is-invalid @enderror"
                                    id="status" 
                                    name="status" 
                                    required>
                                <option value="active" {{ old('status', $bus->status) === 'active' ? 'selected' : '' }}>
                                    ✅ Active - Ready for scheduling
                                </option>
                                <option value="inactive" {{ old('status', $bus->status) === 'inactive' ? 'selected' : '' }}>
                                    ⏸️ Inactive - Not in service
                                </option>
                                <option value="maintenance" {{ old('status', $bus->status) === 'maintenance' ? 'selected' : '' }}>
                                    🔧 Maintenance - Under repair
                                </option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="input-hint">
                                <i class="fas fa-info-circle"></i>
                                Update the current operational status
                            </div>
                        </div>

                        <div class="form-actions">
                            <a href="{{ route('admin.buses.index') }}" class="btn-modern-cancel">
                                <i class="fas fa-times"></i>
                                Cancel
                            </a>
                            <button type="submit" class="btn-modern-submit">
                                <i class="fas fa-save"></i>
                                Update Bus
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection