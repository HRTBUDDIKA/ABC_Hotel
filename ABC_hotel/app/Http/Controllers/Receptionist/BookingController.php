<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use App\Models\MealPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['room', 'mealPlan'])
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

        $room = Room::find($request->room_id);

        // Ensure the room is still available
        if ($room->status !== 'available') {
            return redirect()->back()
                ->withErrors(['room_id' => 'The selected room is no longer available.'])
                ->withInput();
        }

        \DB::transaction(function () use ($validated, $room) {
            // Create the booking
            Booking::create($validated + ['status' => 'confirmed']);

            // Update the room status to "occupied"
            $room->update(['status' => 'occupied']);
        });

        return redirect()->route('receptionist.bookings.index')
            ->with('success', 'Booking created successfully');
    }


    public function updateStatus(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'status' => 'required|in:confirmed,cancelled,completed',
        ]);

        // Update the booking status
        $booking->update(['status' => $validated['status']]);

        // Handle room availability based on status
        if (in_array($validated['status'], ['cancelled', 'completed'])) {
            // Set the room back to available
            $booking->room()->update(['status' => 'available']);
        } elseif ($validated['status'] === 'confirmed') {
            // Set the room to occupied
            $booking->room()->update(['status' => 'occupied']);
        }

        return redirect()->route('receptionist.bookings.index')
            ->with('success', 'Booking status updated successfully.');
    }

    //Booking Detail Report
    public function generateReport(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        $query = Booking::with(['room', 'mealPlan']);

        if ($startDate && $endDate) {
            $query->whereBetween('check_in', [$startDate, $endDate]);
        }

        $bookings = $query->get();

        // Define the headers for the CSV file
        $csvHeaders = [
            'Guest Name',
            'Guest Email',
            'Room ID',
            'Room Name',
            'Meal Plan ID',
            'Meal Plan Name',
            'Check-In Date',
            'Check-Out Date',
            'Status',
        ];

        // Build the CSV content
        $csvData = $bookings->map(function ($booking) {
            return [
                $booking->guest_name,
                $booking->guest_email,
                $booking->room->id ?? 'N/A',
                $booking->room->name ?? 'N/A',
                $booking->mealPlan->id ?? 'N/A',
                $booking->mealPlan->name ?? 'N/A',
                $booking->check_in,
                $booking->check_out,
                $booking->status,
            ];
        });

        // Add headers and data to the CSV
        $csvContent = fopen('php://output', 'w');
        ob_start();
        fputcsv($csvContent, $csvHeaders);
        foreach ($csvData as $row) {
            fputcsv($csvContent, $row);
        }
        fclose($csvContent);

        $csvOutput = ob_get_clean();

        // Return the CSV as a download
        return Response::make($csvOutput, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="bookings_report.csv"',
        ]);
    }

}
