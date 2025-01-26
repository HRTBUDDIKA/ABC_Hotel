<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'room_id',
        'meal_plan_id',
        'check_in',
        'check_out',
        'guests',
        'room_total',
        'meal_plan_total',
        'total_amount',
        'status',
        'special_requests',
        'guest_name',
        'guest_email',
        'guest_phone',
        'payment_status',
        'transaction_id',
        'discount',
        'promo_code',
        'booking_reference',
        'cancelled_at'
    ];

    protected $casts = [
        'check_in' => 'date',
        'check_out' => 'date',
        'room_total' => 'decimal:2',
        'meal_plan_total' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'guests' => 'integer'
    ];

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function mealPlan(): BelongsTo
    {
        return $this->belongsTo(MealPlan::class);
    }

    // Calculate totals
    public function calculateTotal(): void
    {
        $nights = $this->check_in->diffInDays($this->check_out);
        $this->room_total = $this->room->price * $nights;
        $this->meal_plan_total = $this->mealPlan ? $this->mealPlan->price * $this->guests * $nights : 0;
        $this->total_amount = $this->room_total + $this->meal_plan_total;
    }

    // Status checks
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isConfirmed(): bool
    {
        return $this->status === 'confirmed';
    }

    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    // Automatically generate booking reference if not set
    public static function boot()
    {
        parent::boot();

        static::creating(function ($booking) {
            if (empty($booking->booking_reference)) {
                $booking->booking_reference = 'BOOK-' . strtoupper(str_random(8));
            }
        });
    }
}
