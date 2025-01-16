@extends('layouts.admin')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-bold mb-4">Dashboard</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div class="bg-blue-100 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold">Total Bookings</h3>
                            <p class="text-3xl">{{ $stats['total_bookings'] }}</p>
                        </div>

                        <div class="bg-yellow-100 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold">Pending Bookings</h3>
                            <p class="text-3xl">{{ $stats['pending_bookings'] }}</p>
                        </div>

                        <div class="bg-green-100 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold">Total Rooms</h3>
                            <p class="text-3xl">{{ $stats['total_rooms'] }}</p>
                        </div>

                        <div class="bg-purple-100 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold">Total Users</h3>
                            <p class="text-3xl">{{ $stats['total_users'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
