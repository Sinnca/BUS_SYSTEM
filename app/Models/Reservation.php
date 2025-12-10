<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'trip_id',
        'return_trip_id',
        'reservation_code',
        'adults',
        'children',
        'total_price',
        'status',
        'passenger_names',
        'total_passengers',
    ];

    protected $casts = [
        'adults' => 'integer',
        'children' => 'integer',
        'total_price' => 'decimal:2',
        'passenger_names' => 'array',
    ];

    // Automatically generate reservation code
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($reservation) {
            if (!$reservation->reservation_code) {
                $reservation->reservation_code = 'BUS' . strtoupper(Str::random(6));
            }
        });
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function returnTrip()
    {
        return $this->belongsTo(Trip::class, 'return_trip_id');
    }

    public function reservedSeats()
    {
        return $this->hasMany(ReservedSeat::class);
    }

    // Accessors
    public function getTotalPassengersAttribute()
    {
        return $this->adults + $this->children;
    }

    public function getFormattedTotalPriceAttribute()
    {
        return '₱' . number_format($this->total_price, 2);
    }

    public function getIsRoundTripAttribute()
    {
        return !is_null($this->return_trip_id);
    }

    public function getIsConfirmedAttribute()
    {
        return $this->status === 'confirmed';
    }

    public function getIsCancelledAttribute()
    {
        return $this->status === 'cancelled';
    }

    // Methods
    public function cancel()
    {
        $this->update(['status' => 'cancelled']);

        // Return seats to trip
        $this->trip->increment('available_seats', $this->total_passengers);

        if ($this->return_trip_id) {
            $this->returnTrip->increment('available_seats', $this->total_passengers);
        }
    }
}
