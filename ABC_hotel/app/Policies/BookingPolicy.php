<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Booking;

class BookingPolicy
{
    public function view(User $user, Booking $booking)
    {
        return $user->id === $booking->user_id;
    }

    public function update(User $user, Booking $booking)
    {
        return $user->id === $booking->user_id &&
            $booking->status === 'pending';
    }

    public function cancel(User $user, Booking $booking)
    {
        return $user->id === $booking->user_id &&
            in_array($booking->status, ['pending', 'confirmed']);
    }
}
