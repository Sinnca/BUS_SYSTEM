<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservedSeat extends Model
{
    use HasFactory;

    protected $fillable = [
        'trip_id',
        'seat_number',
        'reservation_id',
    ];

    protected $casts = [
        'seat_number' => 'integer',
    ];

    // Relationships
    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
