<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;
use Carbon\Carbon;

class CancelExpiredReservations extends Command
{
    protected $signature = 'reservations:cancel-expired';
    protected $description = 'Cancel pending reservations older than 15 minutes';

    public function handle()
    {
        $expiredReservations = Reservation::where('status', 'pending')
            ->where('created_at', '<', Carbon::now()->subMinutes(15))
            ->get();

        foreach ($expiredReservations as $reservation) {
            $totalSeats = $reservation->adults + $reservation->children;
            $reservation->trip->increment('available_seats', $totalSeats);

            if ($reservation->return_trip_id) {
                $reservation->returnTrip->increment('available_seats', $totalSeats);
            }

            $reservation->reservedSeats()->delete();
            $reservation->status = 'cancelled';
            $reservation->save();
        }

        $this->info($expiredReservations->count() . ' expired reservations cancelled.');
    }
}
