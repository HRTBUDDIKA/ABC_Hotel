<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use App\Models\MealPlan;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['room', 'guest', 'mealPlan'])
            ->latest()
            ->paginate(10);

        return view('receptionist.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $rooms = Room::where('status', 'available')->get();
        $mealPlans = MealPlan::all();
        return view('receptionist.bookings.create', compact('rooms', 'mealPlans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'guest_name' => 'required|string',
            'guest_email' => 'required|email',
            'guest_phone' => 'required|string',
            'room_id' => 'required|exists:rooms,id',
            'meal_plan_id' => 'required|exists:meal_plans,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'adults' => 'required|integer|min:1',
            'children' => 'required|integer|min:0',
        ]);

        $booking = Booking::create($validated + ['status' => 'confirmed']);

        Room::find($request->room_id)->update(['status' => 'occupied']);

        return redirect()->route('receptionist.bookings.index')
            ->with('success', 'Booking created successfully');
    }

    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'status' => 'required|in:confirmed,cancelled,completed',
            'notes' => 'nullable|string',
        ]);

        $booking->update($validated);

        if ($request->status === 'cancelled' || $request->status === 'completed') {
            Room::find($booking->room_id)->update(['status' => 'available']);
        }

        return redirect()->route('receptionist.bookings.index')
            ->with('success', 'Booking updated successfully');
    }
}
