@extends('layouts.admin')

@section('title', 'Reservations')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap');

        .reservations-container {
            font-family: 'Inter', sans-serif;
            animation: fadeIn 0.6s ease-out;
        }

        /* Page Header */
        .reservations-header {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.05) 0%, rgba(139, 92, 246, 0.05) 100%);
            border-radius: 24px;
            padding: 35px 40px;
            margin-bottom: 30px;
            border: 2px solid rgba(99, 102, 241, 0.1);
            position: relative;
            overflow: hidden;
            animation: fadeInDown 0.6s ease-out;
        }

        .reservations-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(139, 92, 246, 0.15) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }

        .header-content-reservations {
            position: relative;
            z-index: 1;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-left-reservations {
            flex: 1;
        }

        .reservations-badge {
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

        .reservations-title {
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

        .reservations-subtitle {
            color: #64748b;
            font-size: 1rem;
            font-weight: 500;
        }

        /* Filter Card */
        .filter-card-reservations {
            background: white;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(99, 102, 241, 0.1);
            border: 2px solid rgba(99, 102, 241, 0.1);
            padding: 25px 30px;
            margin-bottom: 30px;
            animation: fadeInUp 0.6s ease-out 0.1s both;
            position: relative;
        }

        .filter-card-reservations::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
            border-radius: 20px 20px 0 0;
        }

        .filter-select {
            border: 2px solid rgba(99, 102, 241, 0.2);
            border-radius: 12px;
            padding: 10px 16px;
            font-size: 0.95rem;
            font-weight: 600;
            font-family: 'Space Grotesk', sans-serif;
            transition: all 0.3s ease;
            background: white;
        }

        .filter-select:focus {
            border-color: #8b5cf6;
            box-shadow: 0 0 0 4px rgba(139, 92, 246, 0.1);
            outline: none;
        }

        .filter-input {
            border: 2px solid rgba(99, 102, 241, 0.2);
            border-radius: 12px;
            padding: 10px 16px;
            font-size: 0.95rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .filter-input:focus {
            border-color: #8b5cf6;
            box-shadow: 0 0 0 4px rgba(139, 92, 246, 0.1);
            outline: none;
        }

        .btn-search {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 10px 24px;
            font-weight: 700;
            font-size: 0.95rem;
            font-family: 'Space Grotesk', sans-serif;
            letter-spacing: 0.3px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
        }

        .btn-search:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.5);
        }

        /* Table Card */
        .table-card-reservations {
            background: white;
            border-radius: 24px;
            box-shadow: 0 10px 40px rgba(99, 102, 241, 0.08);
            border: 2px solid rgba(99, 102, 241, 0.1);
            overflow: visible;
            animation: fadeInUp 0.6s ease-out 0.2s both;
            position: relative;
            z-index: 1;
        }

        .table-card-reservations::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #6366f1 0%, #8b5cf6 50%, #a855f7 100%);
        }

        .table-responsive {
            overflow-x: auto;
            overflow-y: visible;
            position: relative;
            z-index: 1;
        }

        .reservations-table {
            width: 100%;
            margin: 0;
        }

        .reservations-table thead {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.05) 0%, rgba(139, 92, 246, 0.05) 100%);
        }

        .reservations-table thead th {
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

        .reservations-table tbody tr {
            border-bottom: 1px solid #f1f5f9;
            transition: all 0.3s ease;
        }

        .reservations-table tbody tr:hover {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.02) 0%, rgba(139, 92, 246, 0.02) 100%);
            transform: scale(1.005);
        }

        .reservations-table tbody td {
            padding: 20px 25px;
            vertical-align: middle;
            font-size: 0.95rem;
            color: #334155;
            font-weight: 500;
        }

        .reservation-code {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 800;
            font-size: 1rem;
            color: #6366f1;
        }

        .user-name {
            font-weight: 600;
            color: #1e293b;
        }

        .trip-route {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 0.95rem;
            color: #1e293b;
        }

        .trip-details {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .round-trip-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 10px;
            border-radius: 50px;
            font-size: 0.7rem;
            font-weight: 700;
            background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
            color: white;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            box-shadow: 0 2px 6px rgba(6, 182, 212, 0.3);
        }

        .passengers-info {
            font-weight: 600;
            color: #475569;
        }

        .amount-display {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 800;
            font-size: 1.1rem;
            color: #1e293b;
        }

        .status-badge {
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 0.3px;
            text-transform: uppercase;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-family: 'Space Grotesk', sans-serif;
        }

        .status-confirmed {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
        }

        .status-pending {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            box-shadow: 0 2px 8px rgba(245, 158, 11, 0.3);
        }

        .status-cancelled {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
        }

        .btn-view {
            background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 8px 16px;
            font-weight: 700;
            font-size: 0.85rem;
            font-family: 'Space Grotesk', sans-serif;
            box-shadow: 0 2px 8px rgba(6, 182, 212, 0.3);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s ease;
        }

        .btn-view:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(6, 182, 212, 0.4);
            color: white;
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
        }

        .pagination-wrapper {
            padding: 25px 30px;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.02) 0%, rgba(139, 92, 246, 0.02) 100%);
            border-top: 2px solid rgba(99, 102, 241, 0.1);
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
            .header-content-reservations {
                flex-direction: column;
                gap: 20px;
                align-items: flex-start;
            }

            .reservations-title {
                font-size: 2rem;
            }

            .filter-card-reservations .row {
                gap: 12px;
            }

            .reservations-table {
                font-size: 0.85rem;
            }
        }
    </style>

    <div class="reservations-container">
        <!-- Page Header -->
        <div class="reservations-header">
            <div class="header-content-reservations">
                <div class="header-left-reservations">
                    <span class="reservations-badge">
                        <i class="fas fa-ticket-alt"></i> Booking Management
                    </span>
                    <h1 class="reservations-title">Reservations</h1>
                    <p class="reservations-subtitle">View and manage all customer reservations</p>
                </div>
            </div>
        </div>

        <!-- Filter Card -->
        <div class="filter-card-reservations">
            <form method="GET" class="row g-3 align-items-center">
                <div class="col-auto">
                    <select name="status" class="form-select filter-select" onchange="this.form.submit()">
                        <option value="all">All Status</option>
                        <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                <div class="col">
                    <input type="text" name="search" class="form-control filter-input"
                           placeholder="🔍 Search by code, user, or route..." value="{{ request('search') }}">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn-search">
                        <i class="fas fa-search"></i> Search
                    </button>
                </div>
            </form>
        </div>

        <!-- Table Card -->
        <div class="table-card-reservations">
            <div class="table-responsive">
                <table class="reservations-table">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>User</th>
                            <th>Trip</th>
                            <th>Date</th>
                            <th>Passengers</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($reservations as $reservation)
                        <tr>
                            <td>
                                <span class="reservation-code">{{ $reservation->reservation_code }}</span>
                            </td>
                            <td>
                                <span class="user-name">{{ $reservation->user->name }}</span>
                            </td>
                            <td>
                                <div class="trip-details">
                                    <span class="trip-route">
                                        {{ $reservation->trip->origin }} → {{ $reservation->trip->destination }}
                                    </span>
                                    @if($reservation->is_round_trip)
                                        <span class="round-trip-badge">
                                            <i class="fas fa-sync-alt"></i>
                                            Round Trip
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td>{{ $reservation->trip->formatted_date }}</td>
                            <td>
                                <span class="passengers-info">
                                    <i class="fas fa-users" style="color: #8b5cf6; margin-right: 4px;"></i>
                                    {{ $reservation->adults }} adults
                                    @if($reservation->children > 0)
                                        <br>
                                        <i class="fas fa-child" style="color: #8b5cf6; margin-right: 4px;"></i>
                                        {{ $reservation->children }} children
                                    @endif
                                </span>
                            </td>
                            <td>
                                <span class="amount-display">{{ $reservation->formatted_total_price }}</span>
                            </td>
                            <td>
                                <span class="status-badge 
                                    @if($reservation->status === 'confirmed') status-confirmed
                                    @elseif($reservation->status === 'pending') status-pending
                                    @elseif($reservation->status === 'cancelled') status-cancelled
                                    @endif
                                ">
                                    @if($reservation->status === 'confirmed')
                                        <i class="fas fa-check-circle"></i>
                                    @elseif($reservation->status === 'pending')
                                        <i class="fas fa-clock"></i>
                                    @elseif($reservation->status === 'cancelled')
                                        <i class="fas fa-times-circle"></i>
                                    @endif
                                    {{ ucfirst($reservation->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.reservations.show', $reservation) }}" class="btn-view">
                                    <i class="fas fa-eye"></i>
                                    View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">
                                <div class="empty-state">
                                    <div class="empty-icon">
                                        <i class="fas fa-ticket-alt"></i>
                                    </div>
                                    <h3 class="empty-title">No Reservations Found</h3>
                                    <p class="empty-text">No reservations match your current filters</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            @if($reservations->hasPages())
            <div class="pagination-wrapper">
                {{ $reservations->links() }}
            </div>
            @endif
        </div>
    </div>
@endsection