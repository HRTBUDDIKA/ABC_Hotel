<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date', now()->subMonth());
        $endDate = $request->input('end_date', now());

        $bookings = Booking::whereBetween('created_at', [$startDate, $endDate])
            ->with(['user', 'room', 'mealPlan'])
            ->get();

        $stats = [
            'total_revenue' => $bookings->sum('total_amount'),
            'total_bookings' => $bookings->count(),
            'average_booking_value' => $bookings->avg('total_amount'),
            'cancellation_rate' => ($bookings->where('status', 'cancelled')->count() / $bookings->count()) * 100
        ];

        return view('admin.reports.index', compact('bookings', 'stats', 'startDate', 'endDate'));
    }
}
