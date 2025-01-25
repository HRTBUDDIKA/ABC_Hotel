<?php

namespace App\Http\Controllers\User;

use App\Models\Room;

class RoomController
{
    public function rooms()
    {
        $rooms = Room::where('status', 'available')
            ->orderBy('category')
            ->get();

        return view('user.room', compact('rooms'));
    }

    public function roomCategory($category)
    {
        $rooms = Room::where('category', $category)
            ->where('status', 'available')
            ->get();

        return view('public.rooms.category', compact('rooms', 'category'));
    }

    public function bookingDetails(Room $room)
    {
        return view('user.bookings.details', compact('room'));
    }


}
