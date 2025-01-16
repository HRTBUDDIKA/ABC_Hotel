<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    protected $fillable = [
        'category',
        'size',
        'bed_type',
        'max_occupancy',
        'special_feature',
        'price',
        'status',
        'image'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'size' => 'integer',
        'max_occupancy' => 'integer'
    ];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function isAvailable(): bool
    {
        return $this->status === 'available';
    }
}
