<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::paginate(10);
        return view('admin.rooms.index', compact('rooms'));
    }

    public function create()
    {
        return view('admin.rooms.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string',
            'size' => 'required|numeric',
            'bed_type' => 'required|string',
            'max_occupancy' => 'required|integer',
            'special_feature' => 'required|string',
            'price' => 'required|numeric',
            'status' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('rooms', 'public');
            $validated['image'] = $imagePath;
        }

        Room::create($validated);
        return redirect()->route('admin.rooms.index')->with('success', 'Room created successfully');
    }

    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'category' => 'required|string',
            'size' => 'required|numeric',
            'bed_type' => 'required|string',
            'max_occupancy' => 'required|integer',
            'special_feature' => 'required|string',
            'price' => 'required|numeric',
            'status' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($room->image) {
                Storage::disk('public')->delete($room->image);
            }
            $imagePath = $request->file('image')->store('rooms', 'public');
            $validated['image'] = $imagePath;
        }

        $room->update($validated);
        return redirect()->route('admin.rooms.index')->with('success', 'Room updated successfully');
    }
}
