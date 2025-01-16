<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MealPlan extends Model
{
    protected $fillable = [
        'name',
        'breakfast',
        'lunch',
        'dinner',
        'price'
    ];

    protected $casts = [
        'breakfast' => 'boolean',
        'lunch' => 'boolean',
        'dinner' => 'boolean',
        'price' => 'decimal:2'
    ];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}

