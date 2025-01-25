<?php

namespace App\Http\Controllers\public;

use App\Models\Room;

class RoomController
{
    public function bookingDetails(Room $room)
    {
        return view('public.booking.details', compact('room'));
    }

}
