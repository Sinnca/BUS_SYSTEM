@extends('layouts.admin')

@section('title', 'Automatic Schedule Generator')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap');

        .schedule-container {
            font-family: 'Inter', sans-serif;
            animation: fadeIn 0.6s ease-out;
        }

        .schedule-header {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.05) 0%, rgba(139, 92, 246, 0.05) 100%);
            border-radius: 24px;
            padding: 35px 40px;
            margin-bottom: 30px;
            border: 2px solid rgba(99, 102, 241, 0.1);
            position: relative;
            overflow: hidden;
            animation: fadeInDown 0.6s ease-out;
        }

        .schedule-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(139, 92, 246, 0.15) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }

        .header-content-schedule {
            position: relative;
            z-index: 1;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .schedule-badge {
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

        .schedule-title {
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

        .schedule-subtitle {
            color: #64748b;
            font-size: 1rem;
            font-weight: 500;
        }

        .btn-view-trips {
            background: linear-gradient(135deg, #64748b 0%, #475569 100%);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 12px 24px;
            font-weight: 700;
            font-size: 0.95rem;
            font-family: 'Space Grotesk', sans-serif;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(100, 116, 139, 0.3);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-view-trips:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(100, 116, 139, 0.4);
            color: white;
        }

        .how-it-works-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(99, 102, 241, 0.1);
            border: 2px solid rgba(99, 102, 241, 0.1);
            padding: 25px;
            position: sticky;
            top: 20px;
            animation: fadeInUp 0.6s ease-out 0.1s both;
        }

        .how-it-works-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
            border-radius: 20px 20px 0 0;
        }

        .how-it-works-title {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 800;
            font-size: 1.2rem;
            color: #1e293b;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .how-it-works-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .how-it-works-list li {
            padding: 10px 0;
            color: #475569;
            font-weight: 500;
            display: flex;
            gap: 10px;
        }

        .how-it-works-list li::before {
            content: '✓';
            color: #10b981;
            font-weight: 800;
            font-size: 1.2rem;
        }

        .results-card {
            background: white;
            border-radius: 24px;
            box-shadow: 0 10px 40px rgba(16, 185, 129, 0.15);
            border: 2px solid rgba(16, 185, 129, 0.2);
            overflow: hidden;
            animation: fadeInUp 0.6s ease-out 0.2s both;
            margin-bottom: 30px;
        }

        .results-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #10b981 0%, #059669 100%);
        }

        .form-card-schedule {
            background: white;
            border-radius: 24px;
            box-shadow: 0 10px 40px rgba(99, 102, 241, 0.08);
            border: 2px solid rgba(99, 102, 241, 0.1);
            overflow: hidden;
            animation: fadeInUp 0.6s ease-out 0.3s both;
        }

        .form-card-schedule::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
        }

        .section-label {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 800;
            font-size: 1.1rem;
            color: #1e293b;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .section-number {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
        }

        .form-control, .form-select {
            border: 2px solid rgba(99, 102, 241, 0.2);
            border-radius: 12px;
            padding: 12px 16px;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #8b5cf6;
            box-shadow: 0 0 0 4px rgba(139, 92, 246, 0.1);
            outline: none;
        }

        .btn-generate {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border: none;
            border-radius: 14px;
            padding: 14px 32px;
            font-weight: 800;
            font-size: 1.05rem;
            font-family: 'Space Grotesk', sans-serif;
            box-shadow: 0 6px 25px rgba(16, 185, 129, 0.4);
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-generate:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 35px rgba(16, 185, 129, 0.5);
        }

        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes fadeInDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes rotate { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
    </style>

    <!-- Modal HTML -->
    <div class="modal fade" id="alertModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 20px; border: 2px solid rgba(99, 102, 241, 0.2);">
                <div class="modal-header" style="background: linear-gradient(135deg, rgba(99, 102, 241, 0.05) 0%, rgba(139, 92, 246, 0.05) 100%); border-bottom: 2px solid rgba(99, 102, 241, 0.1); border-radius: 20px 20px 0 0;">
                    <h5 class="modal-title" style="font-family: 'Space Grotesk', sans-serif; font-weight: 800; color: #6366f1;" id="alertModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 30px; color: #64748b; font-family: 'Inter', sans-serif;" id="alertModalBody"></div>
                <div class="modal-footer" style="border-top: 2px solid rgba(99, 102, 241, 0.1); padding: 20px;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 12px; padding: 10px 24px; font-family: 'Space Grotesk', sans-serif; font-weight: 700;">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 20px; border: 2px solid rgba(99, 102, 241, 0.2);">
                <div class="modal-header" style="background: linear-gradient(135deg, rgba(99, 102, 241, 0.05) 0%, rgba(139, 92, 246, 0.05) 100%); border-bottom: 2px solid rgba(99, 102, 241, 0.1); border-radius: 20px 20px 0 0;">
                    <h5 class="modal-title" style="font-family: 'Space Grotesk', sans-serif; font-weight: 800; color: #6366f1;">Confirm Generation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 30px; color: #64748b; font-family: 'Inter', sans-serif;">
                    <p style="font-size: 1.05rem; margin: 0;">Are you sure you want to generate these trips? This action will create multiple trip entries.</p>
                </div>
                <div class="modal-footer" style="border-top: 2px solid rgba(99, 102, 241, 0.1); padding: 20px;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 12px; padding: 10px 24px; font-family: 'Space Grotesk', sans-serif; font-weight: 700;">Cancel</button>
                    <button type="button" class="btn btn-success" id="confirmGenerateBtn" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none; border-radius: 12px; padding: 10px 24px; font-family: 'Space Grotesk', sans-serif; font-weight: 700;">Yes, Generate</button>
                </div>
            </div>
        </div>
    </div>

    <div class="schedule-container">
        <div class="schedule-header">
            <div class="header-content-schedule">
                <div>
                    <span class="schedule-badge"><i class="fas fa-wand-magic-sparkles"></i> Auto Generator</span>
                    <h1 class="schedule-title">Schedule Generator</h1>
                    <p class="schedule-subtitle">Automatically generate multiple trips for your fleet</p>
                </div>
                <a href="{{ route('admin.trips.index') }}" class="btn-view-trips"><i class="fas fa-list"></i> View All Trips</a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                @if(session('results'))
                <div class="results-card" style="position: relative;">
                    <div style="padding: 25px 30px; background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(5, 150, 105, 0.1) 100%); border-bottom: 2px solid rgba(16, 185, 129, 0.2);">
                        <h5 style="font-family: 'Space Grotesk', sans-serif; font-weight: 800; color: #059669; margin: 0;"><i class="fas fa-check-circle"></i> Generation Results</h5>
                    </div>
                    <table style="width: 100%; margin: 0;">
                        <thead style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.05) 0%, rgba(5, 150, 105, 0.05) 100%);">
                            <tr>
                                <th style="font-family: 'Space Grotesk', sans-serif; padding: 18px 25px; color: #059669; font-weight: 700;">Bus Number</th>
                                <th style="font-family: 'Space Grotesk', sans-serif; padding: 18px 25px; color: #059669; font-weight: 700;">Type</th>
                                <th style="font-family: 'Space Grotesk', sans-serif; padding: 18px 25px; color: #059669; font-weight: 700;">Created</th>
                                <th style="font-family: 'Space Grotesk', sans-serif; padding: 18px 25px; color: #059669; font-weight: 700;">Skipped</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach(session('results') as $result)
                            <tr>
                                <td style="padding: 20px 25px;"><strong>{{ $result['bus_number'] }}</strong></td>
                                <td style="padding: 20px 25px;"><span style="background: linear-gradient(135deg, #64748b 0%, #475569 100%); color: white; padding: 6px 14px; border-radius: 50px; font-family: 'Space Grotesk', sans-serif; font-weight: 700; font-size: 0.8rem;">{{ ucfirst(\App\Models\Bus::find($result['bus_id'])->bus_type) }}</span></td>
                                <td style="padding: 20px 25px;"><span style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; padding: 6px 14px; border-radius: 50px; font-family: 'Space Grotesk', sans-serif; font-weight: 700; font-size: 0.8rem;">{{ $result['created'] }}</span></td>
                                <td style="padding: 20px 25px;"><span style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; padding: 6px 14px; border-radius: 50px; font-family: 'Space Grotesk', sans-serif; font-weight: 700; font-size: 0.8rem;">{{ $result['skipped'] }}</span></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @endif

                <div class="form-card-schedule" style="position: relative;">
                    <div style="padding: 25px 30px; background: linear-gradient(135deg, rgba(99, 102, 241, 0.02) 0%, rgba(139, 92, 246, 0.02) 100%); border-bottom: 2px solid rgba(99, 102, 241, 0.1);">
                        <h5 style="font-family: 'Space Grotesk', sans-serif; font-weight: 800; color: #1e293b; margin: 0;"><i class="fas fa-calendar-plus"></i> Schedule Generation Form</h5>
                    </div>
                    <div style="padding: 30px;">
                        <form action="{{ route('admin.schedules.generate') }}" method="POST" id="generator-form">
                            @csrf
                            <div class="mb-4">
                                <label class="section-label"><span class="section-number">1</span> Select Buses *</label>
                                <div style="background: linear-gradient(135deg, rgba(99, 102, 241, 0.02) 0%, rgba(139, 92, 246, 0.02) 100%); border: 2px solid rgba(99, 102, 241, 0.1); border-radius: 16px; padding: 20px;">
                                    <div class="row">
                                        @forelse($buses as $bus)
                                        <div class="col-md-6 mb-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="bus_ids[]" value="{{ $bus->id }}" id="bus_{{ $bus->id }}" {{ in_array($bus->id, old('bus_ids', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="bus_{{ $bus->id }}"><strong>{{ $bus->bus_number }}</strong> - {{ ucfirst($bus->bus_type) }} ({{ $bus->capacity }} seats)</label>
                                            </div>
                                        </div>
                                        @empty
                                        <div class="col-12"><p class="text-danger">No active buses available.</p></div>
                                        @endforelse
                                    </div>
                                    @error('bus_ids')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    <div class="mt-3">
                                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="selectAllBuses()"><i class="fas fa-check-square"></i> Select All</button>
                                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="deselectAllBuses()"><i class="fas fa-square"></i> Deselect All</button>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="section-label"><span class="section-number">2</span> Route Information *</label>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Origin</label>
                                        <input type="text" class="form-control @error('origin') is-invalid @enderror" name="origin" value="{{ old('origin') }}" placeholder="e.g., Manila" required>
                                        @error('origin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Destination</label>
                                        <input type="text" class="form-control @error('destination') is-invalid @enderror" name="destination" value="{{ old('destination') }}" placeholder="e.g., Cebu" required>
                                        @error('destination')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="section-label"><span class="section-number">3</span> Date Range *</label>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Start Date</label>
                                        <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date', date('Y-m-d')) }}" min="{{ date('Y-m-d') }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">End Date</label>
                                        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date') }}" min="{{ date('Y-m-d') }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="section-label"><span class="section-number">4</span> Active Days *</label>
                                <div style="background: linear-gradient(135deg, rgba(99, 102, 241, 0.02) 0%, rgba(139, 92, 246, 0.02) 100%); border: 2px solid rgba(99, 102, 241, 0.1); border-radius: 16px; padding: 20px;">
                                    <div class="row">
                                        @foreach(['monday' => 'Monday', 'tuesday' => 'Tuesday', 'wednesday' => 'Wednesday', 'thursday' => 'Thursday', 'friday' => 'Friday', 'saturday' => 'Saturday', 'sunday' => 'Sunday'] as $value => $label)
                                        <div class="col-md-6 mb-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="days_of_week[]" value="{{ $value }}" id="day_{{ $value }}" {{ in_array($value, old('days_of_week', ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="day_{{ $value }}">{{ $label }}</label>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="mt-3">
                                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="selectWeekdays()"><i class="fas fa-briefcase"></i> Weekdays</button>
                                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="selectWeekends()"><i class="fas fa-calendar-week"></i> Weekends</button>
                                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="selectAllDays()"><i class="fas fa-check-double"></i> All</button>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="section-label"><span class="section-number">5</span> Price *</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-text">₱</span>
                                        <input type="number" class="form-control" name="price" value="{{ old('price', '1200.00') }}" step="0.01" min="0" required>
                                    </div>
                                </div>
                            </div>

                            <div style="background: linear-gradient(135deg, rgba(245, 158, 11, 0.08) 0%, rgba(217, 119, 6, 0.08) 100%); border: 2px solid rgba(245, 158, 11, 0.2); border-radius: 16px; padding: 20px; margin-bottom: 25px;">
                                <h6 style="font-family: 'Space Grotesk', sans-serif; font-weight: 700; color: #d97706;"><i class="fas fa-calculator"></i> Estimated Generation:</h6>
                                <p id="estimate-text" style="margin: 0; color: #475569;">Select buses and date range to see estimate</p>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.trips.index') }}" class="btn btn-secondary"><i class="fas fa-times"></i> Cancel</a>
                                <button type="button" class="btn-generate" id="generate-btn"><i class="fas fa-wand-magic-sparkles"></i> Generate Trips</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="how-it-works-card">
                    <h5 class="how-it-works-title"><i class="fas fa-info-circle"></i> How It Works</h5>
                    <ul class="how-it-works-list">
                        <li>Select one or more buses</li>
                        <li>Choose route (origin and destination)</li>
                        <li>Set date range</li>
                        <li>Select which days of the week to run buses</li>
                        <li>System will automatically generate trips at <strong>8:00 AM, 12:00 PM, and 4:00 PM</strong></li>
                        <li>Existing trips will be skipped (no duplicates)</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
let formToSubmit = null;

function showAlertModal(title, message) {
    document.getElementById('alertModalLabel').textContent = title;
    document.getElementById('alertModalBody').textContent = message;
    const alertModal = new bootstrap.Modal(document.getElementById('alertModal'));
    alertModal.show();
}

function showConfirmModal() {
    const confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));
    confirmModal.show();
}

function selectAllBuses() { 
    document.querySelectorAll('input[name="bus_ids[]"]').forEach(cb => cb.checked = true); 
    updateEstimate(); 
}

function deselectAllBuses() { 
    document.querySelectorAll('input[name="bus_ids[]"]').forEach(cb => cb.checked = false); 
    updateEstimate(); 
}

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
        const estimatedTrips = busCount * avgActiveDays * 3;
        document.getElementById('estimate-text').innerHTML = `<strong>${busCount}</strong> bus(es) × <strong>${avgActiveDays}</strong> active days × <strong>3</strong> times/day = Approximately <strong style="color: #10b981;">${estimatedTrips} trips</strong>`;
    }
}

document.getElementById('generator-form').addEventListener('change', updateEstimate);
document.getElementById('start_date').addEventListener('change', function() { 
    document.getElementById('end_date').min = this.value; 
    updateEstimate(); 
});

document.getElementById('generate-btn').addEventListener('click', function(e) {
    e.preventDefault();
    const busCount = document.querySelectorAll('input[name="bus_ids[]"]:checked').length;
    if (busCount === 0) {
        showAlertModal('Selection Required', 'Please select at least one bus before generating trips.');
        return;
    }
    formToSubmit = document.getElementById('generator-form');
    showConfirmModal();
});

document.getElementById('confirmGenerateBtn').addEventListener('click', function() {
    if (formToSubmit) {
        const confirmModal = bootstrap.Modal.getInstance(document.getElementById('confirmModal'));
        confirmModal.hide();
        formToSubmit.submit();
    }
});

updateEstimate();
</script>
@endpush