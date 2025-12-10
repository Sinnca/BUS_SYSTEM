@extends('layouts.admin')

@section('title', 'Automatic Schedule Generator')

@section('content')
    <div class="row mb-3">
        <div class="col-md-6">
            <h1><i class="fas fa-magic"></i> Automatic Schedule Generator</h1>
            <p class="text-muted">Generate multiple trips automatically for selected buses and date range</p>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.trips.index') }}" class="btn btn-secondary">
                <i class="fas fa-list"></i> View All Trips
            </a>
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
                <h5 class="mb-0"><i class="fas fa-check-circle"></i> Generation Results</h5>
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
                        <i class="fas fa-magic"></i> Generate Trips Automatically
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
