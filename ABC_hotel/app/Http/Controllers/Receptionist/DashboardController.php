<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBookings = Booking::count();
        $pendingBookings = Booking::where('status', 'pending')->count();
        $availableRooms = Room::where('status', 'available')->count();
        $todayCheckIns = Booking::whereDate('check_in', today())->count();

        return view('receptionist.dashboard', compact(
            'totalBookings',
            'pendingBookings',
            'availableRooms',
            'todayCheckIns'
        ));
    }
}

