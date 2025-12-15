@extends('layouts.admin')

@section('title', 'Manage Buses')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap');

        .buses-container {
            font-family: 'Inter', sans-serif;
            animation: fadeIn 0.6s ease-out;
        }

        .page-header-section {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.05) 0%, rgba(139, 92, 246, 0.05) 100%);
            border-radius: 24px;
            padding: 35px 40px;
            margin-bottom: 30px;
            border: 2px solid rgba(99, 102, 241, 0.1);
            position: relative;
            overflow: hidden;
            animation: fadeInDown 0.6s ease-out;
        }

        .page-header-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 150%;
            height: 200%;
            background: radial-gradient(circle, rgba(139, 92, 246, 0.1) 0%, transparent 70%);
            animation: pulse 4s ease-in-out infinite;
        }

        .header-content {
            position: relative;
            z-index: 1;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-left {
            flex: 1;
        }

        .page-badge {
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

        .page-title {
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

        .page-subtitle {
            color: #64748b;
            font-size: 1rem;
            font-weight: 500;
        }

        .btn-add-new {
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

        .btn-add-new:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(99, 102, 241, 0.5);
            color: white;
        }

        .btn-add-new i {
            font-size: 1rem;
        }

        ./* Fix the table card overflow */
.table-card {
    height: 50vh;
    background: white;
    border-radius: 24px;
    box-shadow: 0 10px 40px rgba(99, 102, 241, 0.08);
    border: 2px solid rgba(99, 102, 241, 0.1);
    overflow: visible; /* Keep this */
    animation: fadeInUp 0.6s ease-out 0.2s both;
    position: relative;
    z-index: 1; /* Add this - lower z-index */
}

/* Update modal z-indexes */
.modal-backdrop {
    background-color: rgba(0, 0, 0, 0.7);
    z-index: 1055 !important; /* Add !important */
}

.modal {
    z-index: 1060 !important; /* Add !important */
}

/* Ensure modal dialog is clickable */
.modal-dialog {
    z-index: 1061;
    pointer-events: auto;
}

/* Fix the table responsive container */
.table-responsive {
    overflow-x: auto;
    overflow-y: visible;
    position: relative;
    z-index: 1; /* Lower than modal */
}
        .table-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
        }

        .table-header-section {
            padding: 25px 30px;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.02) 0%, rgba(139, 92, 246, 0.02) 100%);
            border-bottom: 2px solid rgba(99, 102, 241, 0.1);
        }

        .table-stats {
            display: flex;
            gap: 30px;
            align-items: center;
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .stat-icon {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.1rem;
        }

        .stat-info h3 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.8rem;
            font-weight: 800;
            color: #1e293b;
            margin: 0;
            line-height: 1;
        }

        .stat-info p {
            font-size: 0.85rem;
            color: #64748b;
            margin: 0;
            font-weight: 600;
        }

        .modern-table {
            width: 100%;
            margin: 0;
        }

        .modern-table thead {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.05) 0%, rgba(139, 92, 246, 0.05) 100%);
        }

        .modern-table thead th {
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

        .modern-table tbody tr {
            border-bottom: 1px solid #f1f5f9;
            transition: all 0.3s ease;
        }

        .modern-table tbody tr:hover {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.02) 0%, rgba(139, 92, 246, 0.02) 100%);
            transform: scale(1.01);
        }

        .modern-table tbody td {
            padding: 20px 25px;
            vertical-align: middle;
            font-size: 0.95rem;
            color: #334155;
            font-weight: 500;
        }

        .bus-number {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 800;
            font-size: 1.1rem;
            color: #1e293b;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .bus-number-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.9rem;
        }

        .modern-badge {
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
            box-shadow: 0 2px 8px rgba(99, 102, 241, 0.3);
        }

        .badge-regular {
            background: linear-gradient(135deg, #64748b 0%, #475569 100%);
            color: white;
            box-shadow: 0 2px 8px rgba(100, 116, 139, 0.3);
        }

        .badge-active {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
        }

        .badge-warning {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            box-shadow: 0 2px 8px rgba(245, 158, 11, 0.3);
        }

        .badge-inactive {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
        }

        .capacity-info {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
            color: #475569;
        }

        .capacity-icon {
            color: #8b5cf6;
            font-size: 1rem;
        }

        .trips-count {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 1.2rem;
            color: #6366f1;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .btn-action-edit {
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

        .btn-action-edit:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.4);
            color: white;
        }

        .btn-action-delete {
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

        .btn-action-delete:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
        }

        .empty-state {
            padding: 80px 40px;
            text-align: center;
        }

        .empty-icon {
            width: 100px;
            height: 100px;
            margin: 0 auto 25px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, rgba(139, 92, 246, 0.1) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: #8b5cf6;
        }

        .empty-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 10px;
        }

        .empty-text {
            color: #64748b;
            font-size: 1rem;
            margin-bottom: 25px;
        }

        .pagination-wrapper {
            padding: 25px 30px;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.02) 0%, rgba(139, 92, 246, 0.02) 100%);
            border-top: 2px solid rgba(99, 102, 241, 0.1);
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
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

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }

        /* Modal backdrop fix */
        .modal-backdrop {
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 1055;
        }

        .modal {
            z-index: 1060;
        }

        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 20px;
                align-items: flex-start;
            }

            .page-title {
                font-size: 2rem;
            }

            .table-stats {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }

            .modern-table {
                font-size: 0.85rem;
            }

            .action-buttons {
                flex-direction: column;
                width: 100%;
            }

            .btn-action-edit,
            .btn-action-delete {
                width: 100%;
                justify-content: center;
            }
        }
    </style>

    <div class="buses-container">
        <!-- Page Header -->
        <div class="page-header-section">
            <div class="header-content">
                <div class="header-left">
                    <span class="page-badge">
                        <i class="fas fa-bus"></i> Fleet Management
                    </span>
                    <h1 class="page-title">Bus Fleet</h1>
                    <p class="page-subtitle">Manage and monitor your entire bus fleet</p>
                </div>
                <div class="header-right">
                    <a href="{{ route('admin.buses.create') }}" class="btn-add-new">
                        <i class="fas fa-plus"></i>
                        Add New Bus
                    </a>
                </div>
            </div>
        </div>

        <!-- Table Card -->
        <div class="table-card">
            <!-- Stats Section -->
            <div class="table-header-section">
                <div class="table-stats">
                    <div class="stat-item">
                        <div class="stat-icon">
                            <i class="fas fa-bus"></i>
                        </div>
                        <div class="stat-info">
                            <h3>{{ $buses->total() }}</h3>
                            <p>Total Buses</p>
                        </div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="stat-info">
                            <h3>{{ $buses->where('status', 'active')->count() }}</h3>
                            <p>Active</p>
                        </div>
                    </div>
                </div>
            </div>

             <!-- Table -->
            <div class="table-responsive">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th>Bus Number</th>
                            <th>Type</th>
                            <th>Capacity</th>
                            <th>Status</th>
                            <th>Total Trips</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($buses as $bus)
                        <tr>
                            <td>
                                <div class="bus-number">
                                    <div class="bus-number-icon">
                                        <i class="fas fa-bus"></i>
                                    </div>
                                    {{ $bus->bus_number }}
                                </div>
                            </td>
                            <td>
                                <span class="modern-badge {{ $bus->bus_type === 'deluxe' ? 'badge-deluxe' : 'badge-regular' }}">
                                    @if($bus->bus_type === 'deluxe')
                                        <i class="fas fa-star"></i>
                                    @else
                                        <i class="fas fa-bus-alt"></i>
                                    @endif
                                    {{ $bus->formatted_bus_type }}
                                </span>
                            </td>
                            <td>
                                <div class="capacity-info">
                                    <i class="fas fa-users capacity-icon"></i>
                                    {{ $bus->capacity }} seats
                                </div>
                            </td>
                            <td>
                                <span class="modern-badge {{ $bus->status === 'active' ? 'badge-active' : ($bus->status === 'maintenance' ? 'badge-warning' : 'badge-inactive') }}">
                                    @if($bus->status === 'active')
                                        <i class="fas fa-check-circle"></i>
                                    @elseif($bus->status === 'maintenance')
                                        <i class="fas fa-tools"></i>
                                    @else
                                        <i class="fas fa-pause-circle"></i>
                                    @endif
                                    {{ ucfirst($bus->status) }}
                                </span>
                            </td>
                            <td>
                                <span class="trips-count">{{ $bus->trips_count }}</span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.buses.edit', $bus) }}" class="btn-action-edit">
                                        <i class="fas fa-edit"></i>
                                        Edit
                                    </a>
                                    <button type="button" class="btn-action-delete" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $bus->id }}">
                                        <i class="fas fa-trash"></i>
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <div class="empty-icon">
                                        <i class="fas fa-bus"></i>
                                    </div>
                                    <h3 class="empty-title">No Buses Found</h3>
                                    <p class="empty-text">Start by adding your first bus to the fleet</p>
                                    <a href="{{ route('admin.buses.create') }}" class="btn-add-new">
                                        <i class="fas fa-plus"></i>
                                        Add Your First Bus
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($buses->hasPages())
            <div class="pagination-wrapper">
                {{ $buses->links() }}
            </div>
            @endif
        </div>
    </div>

    <!-- Delete Modals - MOVED OUTSIDE TABLE -->
    @foreach($buses as $bus)
    <div class="modal fade" id="deleteModal{{ $bus->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $bus->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 20px; border: 2px solid rgba(239, 68, 68, 0.2); overflow: hidden; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);">
                <div class="modal-header" style="background: linear-gradient(135deg, rgba(239, 68, 68, 0.05) 0%, rgba(220, 38, 38, 0.05) 100%); border-bottom: 2px solid rgba(239, 68, 68, 0.1);">
                    <h5 class="modal-title" id="deleteModalLabel{{ $bus->id }}" style="font-family: 'Space Grotesk', sans-serif; font-weight: 700; color: #ef4444; display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-exclamation-triangle"></i>
                        Confirm Deletion
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 30px; font-family: 'Inter', sans-serif;">
                    <p style="font-size: 1rem; color: #334155; margin-bottom: 15px; font-weight: 500;">
                        Are you sure you want to delete this bus?
                    </p>
                    <div style="background: linear-gradient(135deg, rgba(239, 68, 68, 0.05) 0%, rgba(220, 38, 38, 0.05) 100%); border: 2px solid rgba(239, 68, 68, 0.15); border-radius: 12px; padding: 15px; margin-bottom: 15px;">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 40px; height: 40px; border-radius: 10px; background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); display: flex; align-items: center; justify-content: center; color: white;">
                                <i class="fas fa-bus"></i>
                            </div>
                            <div>
                                <div style="font-family: 'Space Grotesk', sans-serif; font-weight: 700; font-size: 1.1rem; color: #1e293b;">
                                    {{ $bus->bus_number }}
                                </div>
                                <div style="font-size: 0.85rem; color: #64748b; font-weight: 600;">
                                    {{ $bus->formatted_bus_type }} • {{ $bus->capacity }} seats
                                </div>
                            </div>
                        </div>
                    </div>
                    <p style="font-size: 0.9rem; color: #64748b; margin: 0; font-weight: 500;">
                        <i class="fas fa-info-circle" style="color: #ef4444;"></i>
                        This action cannot be undone. All data associated with this bus will be permanently removed.
                    </p>
                </div>
                <div class="modal-footer" style="background: linear-gradient(135deg, rgba(99, 102, 241, 0.02) 0%, rgba(139, 92, 246, 0.02) 100%); border-top: 2px solid rgba(99, 102, 241, 0.1); padding: 20px 30px;">
                    <button type="button" class="btn" data-bs-dismiss="modal" style="background: #f1f5f9; color: #475569; border: 2px solid #e2e8f0; border-radius: 10px; padding: 10px 24px; font-weight: 700; font-size: 0.9rem; font-family: 'Space Grotesk', sans-serif;">
                        Cancel
                    </button>
                    <form action="{{ route('admin.buses.destroy', $bus) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; border: none; border-radius: 10px; padding: 10px 24px; font-weight: 700; font-size: 0.9rem; font-family: 'Space Grotesk', sans-serif; box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);">
                            <i class="fas fa-trash"></i>
                            Delete Bus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endsection