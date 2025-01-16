<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::with('category')->get();
        return view('receptionist.rooms.index', compact('rooms'));
    }

    public function updateStatus(Request $request, Room $room)
    {
        $validated = $request->validate([
            'status' => 'required|in:available,occupied,maintenance',
        ]);

        $room->update($validated);

        return redirect()->route('receptionist.rooms.index')
            ->with('success', 'Room status updated successfully');
    }
}
