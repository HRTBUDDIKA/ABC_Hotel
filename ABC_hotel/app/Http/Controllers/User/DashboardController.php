<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Booking;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Get total number of bookings
        $totalBookings = $user->bookings()->count();

        // Get upcoming stays (check_in date is in the future)
        $upcomingStays = $user->bookings()
            ->where('check_in', '>=', Carbon::today())
            ->where('status', '!=', 'cancelled')
            ->count();

        // Calculate total amount spent on confirmed bookings
        $totalSpent = $user->bookings()
            ->where('status', 'confirmed')
            ->sum('total_amount');

        // Get recent bookings
        $recentBookings = $user->bookings()
            ->with(['room', 'mealPlan'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Get upcoming bookings
        $upcomingBookings = $user->bookings()
            ->with(['room', 'mealPlan'])
            ->where('check_in', '>=', Carbon::today())
            ->where('status', '!=', 'cancelled')
            ->orderBy('check_in', 'asc')
            ->take(3)
            ->get();

        // Calculate booking statistics
        $bookingStats = [
            'confirmed' => $user->bookings()->where('status', 'confirmed')->count(),
            'pending' => $user->bookings()->where('status', 'pending')->count(),
            'cancelled' => $user->bookings()->where('status', 'cancelled')->count(),
        ];

        // Get favorite room type (most booked)
        $favoriteRoom = $user->bookings()
            ->select('room_id')
            ->groupBy('room_id')
            ->orderByRaw('COUNT(*) DESC')
            ->first()
            ?->room;

        // Calculate month-over-month booking trends
        $monthlyBookings = $user->bookings()
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month', 'desc')
            ->take(6)
            ->get()
            ->reverse();

        return view('user.dashboard', compact(
            'totalBookings',
            'upcomingStays',
            'totalSpent',
            'recentBookings',
            'upcomingBookings',
            'bookingStats',
            'favoriteRoom',
            'monthlyBookings'
        ));
    }

    public function getBookingStats()
    {
        $user = Auth::user();

        // Get year-to-date statistics
        $startOfYear = Carbon::now()->startOfYear();
        $yearToDateStats = [
            'total_bookings' => $user->bookings()
                ->whereYear('created_at', Carbon::now()->year)
                ->count(),
            'total_spent' => $user->bookings()
                ->whereYear('created_at', Carbon::now()->year)
                ->where('status', 'confirmed')
                ->sum('total_amount'),
            'average_stay' => $user->bookings()
                ->whereYear('created_at', Carbon::now()->year)
                ->whereNotNull('check_in')
                ->whereNotNull('check_out')
                ->get()
                ->avg(function($booking) {
                    return Carbon::parse($booking->check_in)->diffInDays($booking->check_out);
                })
        ];

        return response()->json($yearToDateStats);
    }

    public function getAvailableRooms(Request $request)
    {
        $request->validate([
            'check_in' => 'required|date|after:today',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1'
        ]);

        // Query to find available rooms for the given dates
        $availableRooms = Room::whereDoesntHave('bookings', function($query) use ($request) {
            $query->where(function($q) use ($request) {
                $q->whereBetween('check_in', [$request->check_in, $request->check_out])
                    ->orWhereBetween('check_out', [$request->check_in, $request->check_out])
                    ->orWhere(function($q) use ($request) {
                        $q->where('check_in', '<=', $request->check_in)
                            ->where('check_out', '>=', $request->check_out);
                    });
            })->where('status', '!=', 'cancelled');
        })
            ->where('max_guests', '>=', $request->guests)
            ->get();

        return response()->json($availableRooms);
    }

    public function profile()
    {
        $user = Auth::user();

        // Get user's booking preferences
        $preferences = [
            'favorite_meal_plan' => $user->bookings()
                ->select('meal_plan_id')
                ->groupBy('meal_plan_id')
                ->orderByRaw('COUNT(*) DESC')
                ->first()
                ?->mealPlan,
            'average_stay_duration' => $user->bookings()
                ->whereNotNull('check_in')
                ->whereNotNull('check_out')
                ->get()
                ->avg(function($booking) {
                    return Carbon::parse($booking->check_in)->diffInDays($booking->check_out);
                }),
            'total_nights_stayed' => $user->bookings()
                ->where('status', 'confirmed')
                ->get()
                ->sum(function($booking) {
                    return Carbon::parse($booking->check_in)->diffInDays($booking->check_out);
                })
        ];

        return view('profile.edit', compact('user', 'preferences'));
    }
}
