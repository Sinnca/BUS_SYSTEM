@extends('layouts.admin')

@section('title', 'Manage Trips')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap');

        .trips-container {
            font-family: 'Inter', sans-serif;
            animation: fadeIn 0.6s ease-out;
        }

        /* Page Header */
        .page-header-trips {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.08) 0%, rgba(139, 92, 246, 0.08) 100%);
            border-radius: 28px;
            padding: 45px 50px;
            margin-bottom: 35px;
            border: 3px solid rgba(99, 102, 241, 0.15);
            position: relative;
            overflow: hidden;
            animation: slideInDown 0.7s ease-out;
        }

        .page-header-trips::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(139, 92, 246, 0.15) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }

        .header-content-trips {
            position: relative;
            z-index: 1;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-left-trips {
            flex: 1;
        }

        .trips-badge {
            display: inline-block;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            color: white;
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
            margin-bottom: 15px;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .trips-title {
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

        .trips-subtitle {
            color: #64748b;
            font-size: 1rem;
            font-weight: 500;
        }

        .btn-create-trip {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
            color: white;
            border: none;
            border-radius: 14px;
            padding: 14px 28px;
            font-weight: 700;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            font-family: 'Space Grotesk', sans-serif;
            letter-spacing: 0.3px;
            box-shadow: 0 4px 20px rgba(99, 102, 241, 0.4);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-create-trip:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(99, 102, 241, 0.5);
            color: white;
        }

        /* Filter Card */
        .filter-card {
            background: white;
            border-radius: 24px;
            box-shadow: 0 8px 35px rgba(99, 102, 241, 0.1);
            border: 2px solid rgba(99, 102, 241, 0.15);
            margin-bottom: 30px;
            overflow: hidden;
            animation: slideInUp 0.7s ease-out 0.1s both;
        }

        .filter-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
        }

        .filter-card-body {
            padding: 30px 40px;
            position: relative;
        }

        .filter-input {
            border: 2px solid rgba(99, 102, 241, 0.2);
            border-radius: 14px;
            padding: 14px 18px;
            font-size: 0.95rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .filter-input:focus {
            border-color: #8b5cf6;
            box-shadow: 0 0 0 4px rgba(139, 92, 246, 0.1);
            outline: none;
        }

        .btn-filter {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            color: white;
            border: none;
            border-radius: 14px;
            padding: 14px 20px;
            font-weight: 700;
            font-size: 0.95rem;
            font-family: 'Space Grotesk', sans-serif;
            letter-spacing: 0.3px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
        }

        .btn-filter:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.5);
        }

        .btn-reset {
            background: linear-gradient(135deg, #64748b 0%, #475569 100%);
            color: white;
            border: none;
            border-radius: 14px;
            padding: 14px 20px;
            font-weight: 700;
            font-size: 0.95rem;
            font-family: 'Space Grotesk', sans-serif;
            letter-spacing: 0.3px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(100, 116, 139, 0.3);
        }

        .btn-reset:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(100, 116, 139, 0.5);
        }

        /* Table Card */
        .trips-table-card {
            background: white;
            border-radius: 24px;
            box-shadow: 0 10px 45px rgba(99, 102, 241, 0.12);
            border: 2px solid rgba(99, 102, 241, 0.15);
            overflow: visible;
            animation: slideInUp 0.7s ease-out 0.2s both;
            position: relative;
            z-index: 1;
        }

        .trips-table-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
        }

        .table-responsive {
            overflow-x: auto;
            overflow-y: visible;
            position: relative;
            z-index: 1;
        }

        .table-trips {
            width: 100%;
            margin: 0;
        }

        .table-trips thead {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.08) 0%, rgba(139, 92, 246, 0.08) 100%);
        }

        .table-trips thead th {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 0.85rem;
            color: #475569;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 18px 25px;
            border: none;
            white-space: nowrap;
        }

        .table-trips tbody tr {
            border-bottom: 2px solid #f1f5f9;
            transition: all 0.3s ease;
        }

        .table-trips tbody tr:hover {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.02) 0%, rgba(139, 92, 246, 0.02) 100%);
            transform: scale(1.01);
        }

        .table-trips tbody td {
            padding: 20px 25px;
            vertical-align: middle;
            font-size: 0.95rem;
            color: #334155;
            font-weight: 500;
        }

        .route-display {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 800;
            font-size: 1.1rem;
            color: #1e293b;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .route-arrow {
            color: #8b5cf6;
            font-size: 1.3rem;
        }

        .trip-date {
            font-weight: 600;
            font-size: 0.95rem;
            color: #475569;
        }

        .trip-time {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 1.1rem;
            color: #6366f1;
        }

        .bus-info {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .bus-number {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 800;
            font-size: 1rem;
            color: #1e293b;
        }

        .trip-badge {
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 0.3px;
            text-transform: uppercase;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .badge-deluxe {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            color: white;
            box-shadow: 0 3px 10px rgba(99, 102, 241, 0.4);
        }

        .badge-regular {
            background: linear-gradient(135deg, #64748b 0%, #475569 100%);
            color: white;
            box-shadow: 0 3px 10px rgba(100, 116, 139, 0.4);
        }

        .seats-display {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 1rem;
            padding: 6px 14px;
            border-radius: 50px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .seats-high {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            box-shadow: 0 3px 12px rgba(16, 185, 129, 0.4);
        }

        .seats-medium {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            box-shadow: 0 3px 12px rgba(245, 158, 11, 0.4);
        }

        .seats-low {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            box-shadow: 0 3px 12px rgba(239, 68, 68, 0.4);
        }

        .price-display {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 800;
            font-size: 1.2rem;
            color: #6366f1;
        }

        .action-btns {
            display: flex;
            gap: 10px;
        }

        .btn-edit-trip {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 8px 16px;
            font-weight: 700;
            font-size: 0.85rem;
            transition: all 0.3s ease;
            font-family: 'Space Grotesk', sans-serif;
            box-shadow: 0 2px 8px rgba(245, 158, 11, 0.3);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-edit-trip:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.4);
            color: white;
        }

        .btn-delete-trip {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 8px 16px;
            font-weight: 700;
            font-size: 0.85rem;
            transition: all 0.3s ease;
            font-family: 'Space Grotesk', sans-serif;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-delete-trip:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
        }

        .empty-state-trips {
            padding: 100px 50px;
            text-align: center;
        }

        .empty-icon-trips {
            width: 120px;
            height: 120px;
            margin: 0 auto 30px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.15) 0%, rgba(139, 92, 246, 0.15) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            color: #8b5cf6;
        }

        .empty-title-trips {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 10px;
        }

        .empty-text-trips {
            color: #64748b;
            font-size: 1rem;
            margin-bottom: 25px;
            font-weight: 500;
        }

        /* Pagination Styling - AGGRESSIVE FIX */
        .pagination-wrapper {
            padding: 20px 25px !important;
            background: white !important;
            border-top: 1px solid #e2e8f0 !important;
            display: flex !important;
            justify-content: center !important;
            align-items: center !important;
        }

        .pagination {
            display: flex !important;
            gap: 6px !important;
            margin: 0 !important;
            padding: 0 !important;
            list-style: none !important;
            align-items: center !important;
        }

        .pagination .page-item {
            margin: 0 !important;
        }

        .pagination .page-link {
            font-family: 'Inter', sans-serif !important;
            font-weight: 600 !important;
            font-size: 0.813rem !important;
            color: #64748b !important;
            background: white !important;
            border: 1.5px solid #e2e8f0 !important;
            border-radius: 6px !important;
            padding: 6px 10px !important;
            transition: all 0.2s ease !important;
            text-decoration: none !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            min-width: 32px !important;
            max-width: 32px !important;
            width: 32px !important;
            height: 32px !important;
            line-height: 1 !important;
            overflow: hidden !important;
        }

        .pagination .page-link:hover {
            background: #f8fafc !important;
            border-color: #cbd5e1 !important;
            color: #475569 !important;
            transform: translateY(-1px) !important;
        }

        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%) !important;
            border-color: #6366f1 !important;
            color: white !important;
            font-weight: 700 !important;
            box-shadow: 0 2px 8px rgba(99, 102, 241, 0.3) !important;
        }

        .pagination .page-item.disabled .page-link {
            background: #f8fafc !important;
            border-color: #e2e8f0 !important;
            color: #cbd5e1 !important;
            cursor: not-allowed !important;
            opacity: 0.6 !important;
        }

        .pagination .page-item.disabled .page-link:hover {
            background: #f8fafc !important;
            border-color: #e2e8f0 !important;
            transform: none !important;
        }

        /* Aggressive SVG and Icon sizing */
        .pagination .page-link svg {
            width: 14px !important;
            height: 14px !important;
            max-width: 14px !important;
            max-height: 14px !important;
            min-width: 14px !important;
            min-height: 14px !important;
        }
        
        .pagination .page-link i {
            font-size: 14px !important;
        }

        /* Target all possible SVG paths and elements */
        .pagination .page-link svg path,
        .pagination .page-link svg * {
            width: inherit !important;
            height: inherit !important;
        }

        /* Dots spacing */
        .pagination .page-item .page-link[aria-label*="..."] {
            border: none !important;
            background: transparent !important;
            pointer-events: none !important;
            min-width: 24px !important;
        }
        
        /* Hide any wrapper spans that might be enlarging content */
        .pagination .page-link span {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: 100% !important;
            height: 100% !important;
        }
      
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
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

        /* Modal backdrop fix */
        .modal-backdrop {
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 1055;
        }

        .modal {
            z-index: 1060;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header-content-trips {
                flex-direction: column;
                gap: 25px;
                align-items: flex-start;
            }

            .trips-title {
                font-size: 2.2rem;
            }

            .table-trips {
                font-size: 0.9rem;
            }

            .action-btns {
                flex-direction: column;
                width: 100%;
            }

            .btn-edit-trip,
            .btn-delete-trip {
                width: 100%;
                justify-content: center;
            }
          
        }
    </style>

    <div class="trips-container">
        <!-- Page Header -->
        <div class="page-header-trips">
            <div class="header-content-trips">
                <div class="header-left-trips">
                    <span class="trips-badge">
                        <i class="fas fa-route"></i> Trip Management
                    </span>
                    <h1 class="trips-title">Trips</h1>
                    <p class="trips-subtitle">Schedule and manage all your trip routes</p>
                </div>
                <div class="header-right-trips">
                    <a href="{{ route('admin.trips.create') }}" class="btn-create-trip">
                        <i class="fas fa-plus"></i>
                        Create New Trip
                    </a>
                </div>
            </div>
        </div>

        <!-- Filter Form -->
        <div class="filter-card">
            <div class="filter-card-body">
                <form action="{{ route('admin.trips.index') }}" method="GET" class="row g-3 align-items-center">
                    <div class="col-md-4">
                        <input type="text" name="origin" class="form-control filter-input" placeholder="🚩 Origin" value="{{ request('origin') }}">
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="destination" class="form-control filter-input" placeholder="📍 Destination" value="{{ request('destination') }}">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-filter w-100">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('admin.trips.index') }}" class="btn btn-reset w-100">
                            <i class="fas fa-times"></i> Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Table Card -->
        <div class="trips-table-card">
            <div class="table-responsive">
                <table class="table-trips">
                    <thead>
                        <tr>
                            <th>Route</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Bus</th>
                            <th>Available Seats</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($trips as $trip)
                        <tr>
                            <td>
                                <div class="route-display">
                                    {{ $trip->origin }}
                                    <span class="route-arrow">→</span>
                                    {{ $trip->destination }}
                                </div>
                            </td>
                            <td>
                                <span class="trip-date">{{ $trip->formatted_date }}</span>
                            </td>
                            <td>
                                <span class="trip-time">{{ $trip->formatted_time }}</span>
                            </td>
                            <td>
                                <div class="bus-info">
                                    <span class="bus-number">{{ $trip->bus->bus_number }}</span>
                                    <span class="trip-badge {{ $trip->bus->bus_type === 'deluxe' ? 'badge-deluxe' : 'badge-regular' }}">
                                        @if($trip->bus->bus_type === 'deluxe')
                                            <i class="fas fa-star"></i>
                                        @endif
                                        {{ $trip->bus->formatted_bus_type }}
                                    </span>
                                </div>
                            </td>
                            <td>
                                <span class="seats-display {{ $trip->available_seats > 10 ? 'seats-high' : ($trip->available_seats > 0 ? 'seats-medium' : 'seats-low') }}">
                                    <i class="fas fa-users"></i>
                                    {{ $trip->available_seats }} / {{ $trip->bus->capacity }}
                                </span>
                            </td>
                            <td>
                                <span class="price-display">{{ $trip->formatted_price }}</span>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <a href="{{ route('admin.trips.edit', $trip) }}" class="btn-edit-trip">
                                        <i class="fas fa-edit"></i>
                                        Edit
                                    </a>
                                    <button type="button" class="btn-delete-trip" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $trip->id }}">
                                        <i class="fas fa-trash"></i>
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state-trips">
                                    <div class="empty-icon-trips">
                                        <i class="fas fa-route"></i>
                                    </div>
                                    <h3 class="empty-title-trips">No Trips Found</h3>
                                    <p class="empty-text-trips">Start by creating your first trip route</p>
                                    <a href="{{ route('admin.trips.create') }}" class="btn-create-trip">
                                        <i class="fas fa-plus"></i>
                                        Create Your First Trip
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
@if($trips->hasPages())
<div class="pagination-wrapper">
    {{ $trips->onEachSide(1)->links('pagination-custom') }}
</div>
@endif
           
        </div>
    </div>

    <!-- Delete Modals - OUTSIDE TABLE -->
    @foreach($trips as $trip)
    <div class="modal fade" id="deleteModal{{ $trip->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $trip->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 20px; border: 2px solid rgba(239, 68, 68, 0.2); overflow: hidden; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);">
                <div class="modal-header" style="background: linear-gradient(135deg, rgba(239, 68, 68, 0.05) 0%, rgba(220, 38, 38, 0.05) 100%); border-bottom: 2px solid rgba(239, 68, 68, 0.1);">
                    <h5 class="modal-title" id="deleteModalLabel{{ $trip->id }}" style="font-family: 'Space Grotesk', sans-serif; font-weight: 700; color: #ef4444; display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-exclamation-triangle"></i>
                        Confirm Deletion
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 30px; font-family: 'Inter', sans-serif;">
                    <p style="font-size: 1rem; color: #334155; margin-bottom: 15px; font-weight: 500;">
                        Are you sure you want to delete this trip?
                    </p>
                    <div style="background: linear-gradient(135deg, rgba(239, 68, 68, 0.05) 0%, rgba(220, 38, 38, 0.05) 100%); border: 2px solid rgba(239, 68, 68, 0.15); border-radius: 12px; padding: 15px; margin-bottom: 15px;">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 40px; height: 40px; border-radius: 10px; background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); display: flex; align-items: center; justify-content: center; color: white;">
                                <i class="fas fa-route"></i>
                            </div>
                            <div>
                                <div style="font-family: 'Space Grotesk', sans-serif; font-weight: 700; font-size: 1.1rem; color: #1e293b;">
                                    {{ $trip->origin }} → {{ $trip->destination }}
                                </div>
                                <div style="font-size: 0.85rem; color: #64748b; font-weight: 600;">
                                    {{ $trip->formatted_date }} • {{ $trip->formatted_time }} • {{ $trip->bus->bus_number }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <p style="font-size: 0.9rem; color: #64748b; margin: 0; font-weight: 500;">
                        <i class="fas fa-info-circle" style="color: #ef4444;"></i>
                        This action cannot be undone. All data associated with this trip will be permanently removed.
                    </p>
                </div>
                <div class="modal-footer" style="background: linear-gradient(135deg, rgba(99, 102, 241, 0.02) 0%, rgba(139, 92, 246, 0.02) 100%); border-top: 2px solid rgba(99, 102, 241, 0.1); padding: 20px 30px;">
                    <button type="button" class="btn" data-bs-dismiss="modal" style="background: #f1f5f9; color: #475569; border: 2px solid #e2e8f0; border-radius: 10px; padding: 10px 24px; font-weight: 700; font-size: 0.9rem; font-family: 'Space Grotesk', sans-serif;">
                        Cancel
                    </button>
                    <form action="{{ route('admin.trips.destroy', $trip) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; border: none; border-radius: 10px; padding: 10px 24px; font-weight: 700; font-size: 0.9rem; font-family: 'Space Grotesk', sans-serif; box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);">
                            <i class="fas fa-trash"></i>
                            Delete Trip
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endsection