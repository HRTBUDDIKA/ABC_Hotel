<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\MealPlan;
use App\Models\Room;
use Illuminate\Http\Request;

class BookingController extends Controller
{

    public function bookingForm(Room $room)
    {
        $mealPlans = MealPlan::all();
        return view('public.booking.form', compact('room', 'mealPlans'));
    }

    public function store(Request $request, Room $room)
    {
        $validated = $request->validate([
            'check_in' => 'required|date|after:today',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1|max:' . $room->max_occupancy,
            'meal_plan_id' => 'required|exists:meal_plans,id',
            'special_requests' => 'nullable|string',
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string'
        ]);

        // Calculate totals
        $roomTotal = $this->calculateRoomTotal($room, $validated['check_in'], $validated['check_out']);
        $mealPlanTotal = $this->calculateMealPlanTotal(
            MealPlan::find($validated['meal_plan_id']),
            $validated['guests'],
            $validated['check_in'],
            $validated['check_out']
        );

        $booking = Booking::create([
            'room_id' => $room->id,
            'meal_plan_id' => $validated['meal_plan_id'],
            'check_in' => $validated['check_in'],
            'check_out' => $validated['check_out'],
            'guests' => $validated['guests'],
            'room_total' => $roomTotal,
            'meal_plan_total' => $mealPlanTotal,
            'total_amount' => $roomTotal + $mealPlanTotal,
            'special_requests' => $validated['special_requests'],
            'status' => 'pending',
            // Guest user info
            'guest_name' => $validated['name'],
            'guest_email' => $validated['email'],
            'guest_phone' => $validated['phone']
        ]);

        return redirect()->route('booking.confirmation', $booking)
            ->with('success', 'Booking request submitted successfully!');
    }

    public function confirmation(Booking $booking)
    {
        return view('public.booking.confirmation', compact('booking'));
    }

    private function calculateRoomTotal(Room $room, $checkIn, $checkOut)
    {
        $nights = (strtotime($checkOut) - strtotime($checkIn)) / (60 * 60 * 24);
        return $room->price * $nights;
    }

    private function calculateMealPlanTotal(MealPlan $mealPlan, $guests, $checkIn, $checkOut)
    {
        $nights = (strtotime($checkOut) - strtotime($checkIn)) / (60 * 60 * 24);
        return $mealPlan->price * $guests * $nights;
    }
}
