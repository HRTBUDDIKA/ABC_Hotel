<?php

namespace App\Http\Controllers\User;

use App\Models\Booking;
use App\Models\Room;
use App\Models\MealPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController
{
    public function index()
    {
        $bookings = Auth::user()->bookings()->latest()->get();
        return view('user.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $rooms = Room::all();
        $mealPlans = MealPlan::all();
        return view('user.bookings.create', compact('rooms', 'mealPlans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'meal_plan_id' => 'required|exists:meal_plans,id',
            'check_in' => 'required|date|after:today',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1',
            'special_requests' => 'nullable|string|max:500'
        ]);

        // Calculate totals
        $room = Room::findOrFail($validated['room_id']);
        $mealPlan = MealPlan::findOrFail($validated['meal_plan_id']);

        $nights = now()->parse($validated['check_out'])->diffInDays($validated['check_in']);
        $roomTotal = $room->price_per_night * $nights;
        $mealPlanTotal = $mealPlan->price_per_person * $validated['guests'] * $nights;
        $totalAmount = $roomTotal + $mealPlanTotal;

        $booking = Auth::user()->bookings()->create([
            'room_id' => $validated['room_id'],
            'meal_plan_id' => $validated['meal_plan_id'],
            'check_in' => $validated['check_in'],
            'check_out' => $validated['check_out'],
            'guests' => $validated['guests'],
            'room_total' => $roomTotal,
            'meal_plan_total' => $mealPlanTotal,
            'total_amount' => $totalAmount,
            'status' => 'pending',
            'special_requests' => $validated['special_requests'] ?? null
        ]);

        return redirect()->route('user.bookings.show', $booking)
            ->with('success', 'Booking created successfully');
    }

    public function show(Booking $booking)
    {
        $this->authorize('view', $booking);
        return view('user.bookings.show', compact('booking'));
    }

    public function update(Request $request, Booking $booking)
    {
        $this->authorize('update', $booking);

        $validated = $request->validate([
            'check_in' => 'required|date|after:today',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1',
            'special_requests' => 'nullable|string|max:500'
        ]);

        // Recalculate totals
        $nights = now()->parse($validated['check_out'])->diffInDays($validated['check_in']);
        $roomTotal = $booking->room->price_per_night * $nights;
        $mealPlanTotal = $booking->mealPlan->price_per_person * $validated['guests'] * $nights;

        $booking->update([
            'check_in' => $validated['check_in'],
            'check_out' => $validated['check_out'],
            'guests' => $validated['guests'],
            'room_total' => $roomTotal,
            'meal_plan_total' => $mealPlanTotal,
            'total_amount' => $roomTotal + $mealPlanTotal,
            'special_requests' => $validated['special_requests'] ?? null
        ]);

        return redirect()->route('user.bookings.show', $booking)
            ->with('success', 'Booking updated successfully');
    }

    public function cancel(Booking $booking)
    {
        $this->authorize('cancel', $booking);

        $booking->update(['status' => 'cancelled']);
        return redirect()->route('user.bookings.index')
            ->with('success', 'Booking cancelled successfully');
    }
}

