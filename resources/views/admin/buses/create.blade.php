@extends('layouts.admin')

@section('title', 'Add New Bus')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap');

        .bus-form-container {
            font-family: 'Inter', sans-serif;
            animation: fadeInUp 0.6s ease-out;
        }

        .form-header-wrapper {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.05) 0%, rgba(139, 92, 246, 0.05) 100%);
            border-radius: 24px;
            padding: 40px;
            margin-bottom: 30px;
            border: 2px solid rgba(99, 102, 241, 0.1);
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
            background: radial-gradient(circle, rgba(99, 102, 241, 0.1) 0%, transparent 70%);
           animation: rotate 20s linear infinite;
        }

        .form-header-content {
            position: relative;
            z-index: 1;
        }

        .form-badge {
            display: inline-block;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            color: white;
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 700;
            margin-bottom: 15px;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .form-main-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 10px;
            letter-spacing: -1px;
        }

        .form-subtitle {
            color: #64748b;
            font-size: 1.05rem;
            font-weight: 500;
        }

        .modern-card {
            background: white;
            border-radius: 28px;
            box-shadow: 0 10px 40px rgba(99, 102, 241, 0.08);
            border: 2px solid rgba(99, 102, 241, 0.1);
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
            background: linear-gradient(90deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
        }

        .form-section-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 25px;
            padding-bottom: 12px;
            border-bottom: 2px solid rgba(99, 102, 241, 0.1);
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
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
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
            color: #8b5cf6;
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
            border-color: #8b5cf6;
            box-shadow: 0 0 0 4px rgba(139, 92, 246, 0.1);
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
            color: #8b5cf6;
            font-size: 0.9rem;
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 40px;
            padding-top: 30px;
            border-top: 2px solid rgba(99, 102, 241, 0.1);
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
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
            color: white;
            border: none;
            border-radius: 14px;
            padding: 14px 36px;
            font-weight: 700;
            font-size: 1rem;
            transition: all 0.3s ease;
            font-family: 'Space Grotesk', sans-serif;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 20px rgba(99, 102, 241, 0.4);
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-modern-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(99, 102, 241, 0.5);
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

    <div class="bus-form-container">
        <!-- Header Section -->
        <div class="form-header-wrapper">
            <div class="form-header-content">
                <span class="form-badge">
                    <i class="fas fa-bus"></i> Fleet Management
                </span>
                <h1 class="form-main-title">Add New Bus</h1>
                <p class="form-subtitle">Register a new bus to your fleet and start scheduling trips</p>
            </div>
        </div>

        <!-- Form Card -->
        <div class="row">
            <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-2">
                <div class="modern-card">
                    <div class="form-section-title">
                        <span class="form-section-icon">
                            <i class="fas fa-edit"></i>
                        </span>
                        Bus Information
                    </div>

                    <form action="{{ route('admin.buses.store') }}" method="POST">
                        @csrf

                        <div class="modern-form-group">
                            <label for="bus_number" class="modern-label">
                                <i class="fas fa-hashtag label-icon"></i>
                                Bus Number
                                <span class="required-asterisk">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control modern-input @error('bus_number') is-invalid @enderror"
                                   id="bus_number" 
                                   name="bus_number" 
                                   value="{{ old('bus_number') }}" 
                                   placeholder="e.g., DLX-001 or REG-001"
                                   required>
                            @error('bus_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="input-hint">
                                <i class="fas fa-info-circle"></i>
                                Enter a unique identifier for this bus
                            </div>
                        </div>

                        <div class="modern-form-group">
                            <label for="bus_type" class="modern-label">
                                <i class="fas fa-layer-group label-icon"></i>
                                Bus Type
                                <span class="required-asterisk">*</span>
                            </label>
                            <select class="form-select modern-select @error('bus_type') is-invalid @enderror"
                                    id="bus_type" 
                                    name="bus_type" 
                                    required>
                                <option value="">Choose bus type...</option>
                                <option value="deluxe" {{ old('bus_type') === 'deluxe' ? 'selected' : '' }}>
                                    🌟 Deluxe (20 seats)
                                </option>
                                <option value="regular" {{ old('bus_type') === 'regular' ? 'selected' : '' }}>
                                    🚌 Regular (40 seats)
                                </option>
                            </select>
                            @error('bus_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="input-hint">
                                <i class="fas fa-info-circle"></i>
                                Select the seating capacity and comfort level
                            </div>
                        </div>

                        <div class="modern-form-group">
                            <label for="status" class="modern-label">
                                <i class="fas fa-toggle-on label-icon"></i>
                                Bus Status
                                <span class="required-asterisk">*</span>
                            </label>
                            <select class="form-select modern-select @error('status') is-invalid @enderror"
                                    id="status" 
                                    name="status" 
                                    required>
                                <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>
                                    ✅ Active - Ready for scheduling
                                </option>
                                <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>
                                    ⏸️ Inactive - Not in service
                                </option>
                                <option value="maintenance" {{ old('status') === 'maintenance' ? 'selected' : '' }}>
                                    🔧 Maintenance - Under repair
                                </option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="input-hint">
                                <i class="fas fa-info-circle"></i>
                                Set the current operational status
                            </div>
                        </div>

                        <div class="form-actions">
                            <a href="{{ route('admin.buses.index') }}" class="btn-modern-cancel">
                                <i class="fas fa-arrow-left"></i>
                                Cancel
                            </a>
                            <button type="submit" class="btn-modern-submit">
                                <i class="fas fa-check-circle"></i>
                                Create Bus
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection