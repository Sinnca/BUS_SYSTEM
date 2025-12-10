<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;

    protected $fillable = [
        'bus_number',
        'bus_type',
        'capacity',
        'status',
    ];

    protected $casts = [
        'capacity' => 'integer',
    ];

    // Relationships
    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    // Accessors
    public function getIsDeluxeAttribute()
    {
        return $this->bus_type === 'deluxe';
    }

    public function getIsRegularAttribute()
    {
        return $this->bus_type === 'regular';
    }

    public function getFormattedBusTypeAttribute()
    {
        return ucfirst($this->bus_type);
    }
}
