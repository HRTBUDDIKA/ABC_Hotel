@extends('receptionist.layouts.app')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-700">Total Bookings</h3>
            <p class="text-3xl font-bold mt-2">{{ $totalBookings }}</p>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-700">Pending Bookings</h3>
            <p class="text-3xl font-bold mt-2">{{ $pendingBookings }}</p>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-700">Available Rooms</h3>
            <p class="text-3xl font-bold mt-2">{{ $availableRooms }}</p>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-700">Today's Check-ins</h3>
            <p class="text-3xl font-bold mt-2">{{ $todayCheckIns }}</p>
        </div>
    </div>

    <div class="mt-8">
        <h2 class="text-2xl font-bold mb-4">Recent Bookings</h2>
        <div class="bg-white rounded-lg shadow overflow-hidden">
            @include('receptionist.bookings._table')
        </div>
    </div>
@endsection
