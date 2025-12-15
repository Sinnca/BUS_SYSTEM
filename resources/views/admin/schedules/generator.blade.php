@extends('layouts.admin')

@section('title', 'Automatic Schedule Generator')

@section('content')
    <style>
        /* Google Fonts */
        @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap');

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

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes rotateGradient {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
        }
         @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

        /* Typography */
        h1, h2, h3, h4, h5, h6, .btn, strong, .form-label, .card-header {
            font-family: 'Space Grotesk', -apple-system, BlinkMacSystemFont, sans-serif !important;
        }

        body, p, span, small, .text-muted, input, select, textarea, .form-control {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif !important;
        }

        /* Page Header with Rotating Gradient */
        .page-header-animated {
           background: linear-gradient(135deg, rgba(99, 102, 241, 0.05) 0%, rgba(139, 92, 246, 0.05) 100%);
            border-radius: 24px;
            padding: 35px 40px;
            margin-bottom: 30px;
            border: 2px solid rgba(99, 102, 241, 0.1);
            position: relative;
            overflow: hidden;
            animation: fadeInDown 0.6s ease-out;
        }

        .page-header-animated::before {
            content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(139, 92, 246, 0.15) 0%, transparent 70%);
        animation: rotate 20s linear infinite;
        }

        .page-header-animated h1 {
            color:  rgba(99, 102, 241, 0.3);
            font-weight: 900;
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 20px rgba(0, 0, 0, 0.2);
            position: relative;
            z-index: 1;
        }

        .page-header-animated p {
            color: rgba(255, 255, 255, 0.95);
            font-size: 1.1rem;
            margin: 0;
            position: relative;
            z-index: 1;
        }

        .page-header-animated i {
            font-size: 2.5rem;
            animation: float 3s ease-in-out infinite;
        }

        /* Cards */
        .card {
            background: white;
            border: 2px solid rgba(99, 102, 241, 0.12);
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(99, 102, 241, 0.1);
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
            animation: fadeInUp 0.8s ease-out;
        }

        .card:hover {
            box-shadow: 0 10px 40px rgba(99, 102, 241, 0.2);
            transform: translateY(-5px);
        }

        .card-header {
            background: linear-gradient(135deg, #faf5ff 0%, #f3e8ff 100%);
            border-bottom: 2px solid rgba(99, 102, 241, 0.15);
            padding: 1.5rem;
            border-radius: 20px 20px 0 0;
            color: #6366f1;
        }

        .card-header h5 {
            margin: 0;
            font-weight: 700;
            color: #6366f1;
        }

        .card-body {
            padding: 2rem;
            color: #64748b;
        }

        /* Alert Styles */
        .alert {
            border: none;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(99, 102, 241, 0.1);
            animation: slideInLeft 0.6s ease-out;
        }

        .alert-info {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            color: #1e40af;
            border-left: 4px solid #3b82f6;
        }

        .alert-info h5 {
            color: #1e3a8a;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .alert-secondary {
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
            color: #475569;
            border-left: 4px solid #64748b;
        }

        .alert-secondary strong {
            color: #1e293b;
        }

        /* Success Results Card */
        .border-success {
            border: 2px solid #10b981 !important;
            box-shadow: 0 10px 40px rgba(16, 185, 129, 0.2);
        }

        .bg-success {
            background: linear-gradient(135deg, #10b981 0%, #34d399 100%) !important;
        }

        /* Form Controls */
        .form-label {
            font-weight: 700;
            color: #6366f1;
            margin-bottom: 0.75rem;
            font-size: 1.1rem;
        }

        .form-control, .form-select {
            border: 2px solid rgba(99, 102, 241, 0.2);
            border-radius: 12px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
            background: white;
            color: #64748b;
        }

        .form-control:focus, .form-select:focus {
            border-color: #8b5cf6;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
            outline: none;
            transform: translateY(-2px);
        }

        .form-control:hover, .form-select:hover {
            border-color: rgba(99, 102, 241, 0.4);
        }

        .form-check-input {
            width: 1.25rem;
            height: 1.25rem;
            border: 2px solid rgba(99, 102, 241, 0.3);
            transition: all 0.3s ease;
        }

        .form-check-input:checked {
            background-color: #6366f1;
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        }

        .form-check-label {
            color: #64748b;
            font-weight: 500;
            margin-left: 0.5rem;
        }

        /* Input Groups */
        .input-group-text {
            background: linear-gradient(135deg, #faf5ff 0%, #f3e8ff 100%);
            border: 2px solid rgba(99, 102, 241, 0.2);
            color: #6366f1;
            font-weight: 700;
            border-radius: 12px 0 0 12px;
        }

        /* Buttons */
        .btn {
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            font-weight: 700;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-primary, .btn-outline-primary {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
        }

        .btn-primary:hover, .btn-outline-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(99, 102, 241, 0.4);
            background: linear-gradient(135deg, #7c3aed 0%, #a855f7 100%);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #64748b 0%, #475569 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(100, 116, 139, 0.3);
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(100, 116, 139, 0.4);
        }

        .btn-success {
            background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(16, 185, 129, 0.4);
            animation: pulse 0.6s ease-in-out;
        }

        .btn-info {
            background: linear-gradient(135deg, #06b6d4 0%, #22d3ee 100%);
            color: white;
        }

        .btn-outline-info:hover, .btn-info:hover {
            transform: translateY(-2px);
        }

        /* Badges */
        .badge {
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.85rem;
        }

        .bg-secondary {
            background: linear-gradient(135deg, #64748b 0%, #475569 100%) !important;
        }

        .bg-warning {
            background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%) !important;
        }

        /* Background Cards */
        .bg-light {
            background: linear-gradient(135deg, #faf5ff 0%, #f8f9fa 100%) !important;
            border: 2px solid rgba(99, 102, 241, 0.1);
            border-radius: 16px;
        }

        .bg-warning.bg-opacity-10 {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%) !important;
            border: 2px solid rgba(245, 158, 11, 0.2);
        }

        /* Table */
        .table {
            color: #64748b;
        }

        .table thead {
            background: linear-gradient(135deg, #faf5ff 0%, #f8f9fa 100%);
        }

        .table thead th {
            color: #6366f1;
            font-weight: 700;
            border-bottom: 2px solid rgba(99, 102, 241, 0.15);
            padding: 1rem;
        }

        .table tbody tr {
            transition: all 0.2s ease;
        }

        .table tbody tr:hover {
            background: rgba(99, 102, 241, 0.04);
            transform: scale(1.01);
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background: rgba(99, 102, 241, 0.02);
        }

        /* Text Colors */
        .text-muted {
            color: #94a3b8 !important;
        }

        .text-success {
            color: #10b981 !important;
        }

        .text-danger {
            color: #ef4444 !important;
        }

        /* Staggered Animation */
        .card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .card:nth-child(3) {
            animation-delay: 0.3s;
        }

        .card:nth-child(4) {
            animation-delay: 0.4s;
        }

        /* Small Buttons */
        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }

        /* Large Buttons */
        .btn-lg {
            padding: 1rem 2rem;
            font-size: 1.125rem;
        }
    </style>

    <div class="row mb-4">
        <div class="col-12">
            <div class="page-header-animated">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1><i class="fas fa-wand-magic-sparkles"></i> Automatic Schedule Generator</h1>
                        <p>Generate multiple trips automatically for selected buses and date range</p>
                    </div>
                    <div>
                        <a href="{{ route('admin.trips.index') }}" class="btn btn-secondary">
                            <i class="fas fa-list"></i> View All Trips
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Instructions -->
    <div class="alert alert-info">
        <h5><i class="fas fa-info-circle"></i> How it works:</h5>
        <ul class="mb-0">
            <li>Select one or more buses</li>
            <li>Choose route (origin and destination)</li>
            <li>Set date range</li>
            <li>Select which days of the week to run buses</li>
            <li>System will automatically generate trips at <strong>8:00 AM, 12:00 PM, and 4:00 PM</strong></li>
            <li>Existing trips will be skipped (no duplicates)</li>
        </ul>
    </div>

    <!-- Generation Results -->
    @if(session('results'))
        <div class="card mb-4 border-success">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0" style="color: white !important;"><i class="fas fa-check-circle"></i> Generation Results</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Bus Number</th>
                            <th>Bus Type</th>
                            <th>Trips Created</th>
                            <th>Trips Skipped</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(session('results') as $result)
                            <tr>
                                <td><strong>{{ $result['bus_number'] }}</strong></td>
                                <td>
                                    <span class="badge bg-secondary">
                                        {{ ucfirst(\App\Models\Bus::find($result['bus_id'])->bus_type) }}
                                    </span>
                                </td>
                                <td><span class="badge bg-success">{{ $result['created'] }}</span></td>
                                <td><span class="badge bg-warning">{{ $result['skipped'] }}</span></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif

    <!-- Generation Form -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-calendar-plus"></i> Schedule Generation Form</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.schedules.generate') }}" method="POST" id="generator-form">
                @csrf

                <!-- Bus Selection -->
                <div class="mb-4">
                    <label class="form-label"><strong>1. Select Buses *</strong></label>
                    <div class="card bg-light">
                        <div class="card-body">
                            <div class="row">
                                @forelse($buses as $bus)
                                    <div class="col-md-4 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox"
                                                   name="bus_ids[]" value="{{ $bus->id }}"
                                                   id="bus_{{ $bus->id }}"
                                                {{ in_array($bus->id, old('bus_ids', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="bus_{{ $bus->id }}">
                                                <strong>{{ $bus->bus_number }}</strong> -
                                                {{ ucfirst($bus->bus_type) }}
                                                ({{ $bus->capacity }} seats)
                                            </label>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12">
                                        <p class="text-danger">No active buses available. Please add buses first.</p>
                                    </div>
                                @endforelse
                            </div>
                            @error('bus_ids')
                            <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                            <button type="button" class="btn btn-sm btn-outline-primary mt-2" onclick="selectAllBuses()">
                                <i class="fas fa-check-square"></i> Select All
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-secondary mt-2" onclick="deselectAllBuses()">
                                <i class="fas fa-square"></i> Deselect All
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Route Information -->
                <div class="mb-4">
                    <label class="form-label"><strong>2. Route Information *</strong></label>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="origin" class="form-label">Origin</label>
                            <input type="text" class="form-control @error('origin') is-invalid @enderror"
                                   id="origin" name="origin" value="{{ old('origin') }}"
                                   placeholder="e.g., Manila" required>
                            @error('origin')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="destination" class="form-label">Destination</label>
                            <input type="text" class="form-control @error('destination') is-invalid @enderror"
                                   id="destination" name="destination" value="{{ old('destination') }}"
                                   placeholder="e.g., Cebu" required>
                            @error('destination')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Date Range -->
                <div class="mb-4">
                    <label class="form-label"><strong>3. Date Range *</strong></label>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                                   id="start_date" name="start_date" value="{{ old('start_date', date('Y-m-d')) }}"
                                   min="{{ date('Y-m-d') }}" required>
                            @error('start_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                                   id="end_date" name="end_date" value="{{ old('end_date') }}"
                                   min="{{ date('Y-m-d') }}" required>
                            @error('end_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Days of Week -->
                <div class="mb-4">
                    <label class="form-label"><strong>4. Active Days of Week *</strong></label>
                    <div class="card bg-light">
                        <div class="card-body">
                            <div class="row">
                                @php
                                    $days = [
                                        'monday' => 'Monday',
                                        'tuesday' => 'Tuesday',
                                        'wednesday' => 'Wednesday',
                                        'thursday' => 'Thursday',
                                        'friday' => 'Friday',
                                        'saturday' => 'Saturday',
                                        'sunday' => 'Sunday',
                                    ];
                                @endphp
                                @foreach($days as $value => $label)
                                    <div class="col-md-3 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox"
                                                   name="days_of_week[]" value="{{ $value }}"
                                                   id="day_{{ $value }}"
                                                {{ in_array($value, old('days_of_week', ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'])) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="day_{{ $value }}">
                                                {{ $label }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @error('days_of_week')
                            <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                            <button type="button" class="btn btn-sm btn-outline-primary mt-2" onclick="selectWeekdays()">
                                <i class="fas fa-briefcase"></i> Weekdays Only
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-info mt-2" onclick="selectWeekends()">
                                <i class="fas fa-calendar-week"></i> Weekends Only
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-success mt-2" onclick="selectAllDays()">
                                <i class="fas fa-check-double"></i> All Days
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Price -->
                <div class="mb-4">
                    <label class="form-label"><strong>5. Price per Seat *</strong></label>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input type="number" class="form-control @error('price') is-invalid @enderror"
                                       id="price" name="price" value="{{ old('price', '1200.00') }}"
                                       step="0.01" min="0" placeholder="1200.00" required>
                                @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="text-muted">Price applies to all generated trips</small>
                        </div>
                    </div>
                </div>

                <!-- Departure Times Info -->
                <div class="alert alert-secondary">
                    <strong><i class="fas fa-clock"></i> Automatic Departure Times:</strong>
                    <ul class="mb-0">
                        @foreach($departureTimes as $time)
                            <li>{{ \Carbon\Carbon::parse($time)->format('g:i A') }}</li>
                        @endforeach
                    </ul>
                    <small class="text-muted">Trips will be created for each of these times on selected days</small>
                </div>

                <!-- Summary -->
                <div class="card bg-warning bg-opacity-10 mb-4">
                    <div class="card-body">
                        <h6><i class="fas fa-calculator"></i> Estimated Generation:</h6>
                        <p class="mb-0" id="estimate-text">
                            Select buses and date range to see estimate
                        </p>
                    </div>
                </div>

                <!-- Submit -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.trips.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-success btn-lg" id="generate-btn">
                        <i class="fas fa-wand-magic-sparkles"></i> Generate Trips Automatically
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Select/Deselect buses
        function selectAllBuses() {
            document.querySelectorAll('input[name="bus_ids[]"]').forEach(cb => cb.checked = true);
            updateEstimate();
        }

        function deselectAllBuses() {
            document.querySelectorAll('input[name="bus_ids[]"]').forEach(cb => cb.checked = false);
            updateEstimate();
        }

        // Select days
        function selectWeekdays() {
            const weekdays = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'];
            document.querySelectorAll('input[name="days_of_week[]"]').forEach(cb => {
                cb.checked = weekdays.includes(cb.value);
            });
            updateEstimate();
        }

        function selectWeekends() {
            const weekends = ['saturday', 'sunday'];
            document.querySelectorAll('input[name="days_of_week[]"]').forEach(cb => {
                cb.checked = weekends.includes(cb.value);
            });
            updateEstimate();
        }

        function selectAllDays() {
            document.querySelectorAll('input[name="days_of_week[]"]').forEach(cb => cb.checked = true);
            updateEstimate();
        }

        // Update estimate
        function updateEstimate() {
            const busCount = document.querySelectorAll('input[name="bus_ids[]"]:checked').length;
            const startDate = document.getElementById('start_date').value;
            const endDate = document.getElementById('end_date').value;
            const daysChecked = document.querySelectorAll('input[name="days_of_week[]"]:checked').length;

            if (busCount && startDate && endDate && daysChecked) {
                const start = new Date(startDate);
                const end = new Date(endDate);
                const daysDiff = Math.ceil((end - start) / (1000 * 60 * 60 * 24)) + 1;
                const avgActiveDays = Math.ceil((daysDiff / 7) * daysChecked);
                const timesPerDay = 3; // 8 AM, 12 PM, 4 PM
                const estimatedTrips = busCount * avgActiveDays * timesPerDay;

                document.getElementById('estimate-text').innerHTML = `
            <strong>${busCount}</strong> bus(es) × approximately <strong>${avgActiveDays}</strong> active days × <strong>${timesPerDay}</strong> times/day
            = Approximately <strong class="text-success">${estimatedTrips} trips</strong> will be created
        `;
            }
        }

        // Update estimate on changes
        document.getElementById('generator-form').addEventListener('change', updateEstimate);
        document.getElementById('start_date').addEventListener('change', function() {
            document.getElementById('end_date').min = this.value;
            updateEstimate();
        });

        // Form submission confirmation
        document.getElementById('generate-btn').addEventListener('click', function(e) {
            const busCount = document.querySelectorAll('input[name="bus_ids[]"]:checked').length;
            if (busCount === 0) {
                e.preventDefault();
                alert('Please select at least one bus');
                return;
            }

            if (!confirm('Are you sure you want to generate these trips? This action will create multiple trip entries.')) {
                e.preventDefault();
            }
        });

        // Initial estimate
        updateEstimate();
    </script>
@endpush