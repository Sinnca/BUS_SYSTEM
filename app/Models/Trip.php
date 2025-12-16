<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'bus_id',
        'origin',
        'destination',
        'departure_date',
        'departure_time',
        'available_seats',
        'price',
    ];

    protected $casts = [
        'departure_date' => 'date',
        'departure_time' => 'datetime',
        'available_seats' => 'integer',
        'price' => 'decimal:2',
    ];

    // Relationships
    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function reservedSeats()
    {
        return $this->hasMany(ReservedSeat::class);
    }

    public function returnTripReservations()
    {
        return $this->hasMany(Reservation::class, 'return_trip_id');
    }

    // Scopes
    public function scopeAvailable($query)
    {
        return $query->where('available_seats', '>', 0)
            ->where('departure_date', '>=', now()->format('Y-m-d'));
    }

    public function scopeSearchRoute($query, $origin, $destination)
    {
//        return $query->where('origin', $origin)
//            ->where('destination', $destination);
        return $query
            ->where('status', 'active') // if you have status
            ->whereRaw(
                "STR_TO_DATE(CONCAT(departure_date, ' ', departure_time), '%Y-%m-%d %H:%i:%s') > ?",
                [now()]
            );
    }

    public function scopeOnDate($query, $date)
    {
        return $query->where('departure_date', $date);
    }

    // Accessors
    public function getFormattedDateAttribute()
    {
        return Carbon::parse($this->departure_date)->format('F j, Y');
    }

    public function getFormattedTimeAttribute()
    {
        return Carbon::parse($this->departure_time)->format('g:i A');
    }

    public function getFormattedPriceAttribute()
    {
        return '₱' . number_format($this->price, 2);
    }

    public function getIsSoldOutAttribute()
    {
        return $this->available_seats <= 0;
    }

    public function getOccupancyRateAttribute()
    {
        if (!$this->bus) return 0;
        $occupied = $this->bus->capacity - $this->available_seats;
        return round(($occupied / $this->bus->capacity) * 100, 2);
    }
    public function scopeUpcoming($query)
    {
        return $query->whereRaw(
            "STR_TO_DATE(CONCAT(departure_date, ' ', departure_time), '%Y-%m-%d %H:%i:%s') > ?",
            [now()]
        );
    }
}
