@extends('layouts.user')

@section('title', 'Dashboard')

@section('content')
    <div class="space-y-6">
        <!-- Welcome Section -->
        <div class="bg-white shadow-sm rounded-lg p-6">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-semibold text-gray-900">Welcome back, {{ Auth::user()->name }}</h1>
                <a href="{{ route('user.bookings.create') }}"
                   class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                    New Booking
                </a>
            </div>
        </div>

        <!-- Stats Overview -->
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
            <!-- Total Bookings -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Bookings</dt>
                                <dd class="text-lg font-semibold text-gray-900">{{ $totalBookings }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Upcoming Stays -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Upcoming Stays</dt>
                                <dd class="text-lg font-semibold text-gray-900">{{ $upcomingStays }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Spent -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-purple-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Spent</dt>
                                <dd class="text-lg font-semibold text-gray-900">${{ number_format($totalSpent, 2) }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Upcoming Bookings and Recent Activity -->
        <div class="grid grid-cols-1 gap-5 lg:grid-cols-2">
            <!-- Upcoming Bookings -->
            <div class="bg-white shadow-sm rounded-lg">
                <div class="p-6">
                    <h2 class="text-lg font-medium text-gray-900">Upcoming Bookings</h2>
                    <div class="mt-4 space-y-4">
                        @forelse($upcomingBookings as $booking)
                            <div class="border-l-4 border-blue-400 bg-blue-50 p-4">
                                <div class="flex justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">
                                            {{ $booking->room->name }}
                                        </p>
                                        <p class="text-sm text-gray-600">
                                            {{ $booking->check_in->format('M d, Y') }} - {{ $booking->check_out->format('M d, Y') }}
                                        </p>
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $booking->guests }} guests
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <a href="{{ route('user.bookings.show', $booking) }}" class="text-sm text-blue-600 hover:text-blue-800">
                                        View Details →
                                    </a>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 text-sm">No upcoming bookings</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white shadow-sm rounded-lg">
                <div class="p-6">
                    <h2 class="text-lg font-medium text-gray-900">Recent Activity</h2>
                    <div class="mt-4 space-y-4">
                        @forelse($recentBookings as $booking)
                            <div class="border-l-4 border-gray-200 p-4">
                                <div class="flex justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">
                                            Booked {{ $booking->room->name }}
                                        </p>
                                        <p class="text-sm text-gray-600">
                                            {{ $booking->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                    <div>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($booking->status === 'confirmed') bg-green-100 text-green-800
                                        @elseif($booking->status === 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($booking->status === 'cancelled') bg-red-100 text-red-800
                                        @endif">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 text-sm">No recent activity</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Booking Statistics -->
        <div class="bg-white shadow-sm rounded-lg">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">Booking Statistics</h2>
                <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-3">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm font-medium text-gray-500">Confirmed Bookings</p>
                        <p class="mt-2 text-3xl font-semibold text-gray-900">{{ $bookingStats['confirmed'] }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm font-medium text-gray-500">Pending Bookings</p>
                        <p class="mt-2 text-3xl font-semibold text-gray-900">{{ $bookingStats['pending'] }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm font-medium text-gray-500">Cancelled Bookings</p>
                        <p class="mt-2 text-3xl font-semibold text-gray-900">{{ $bookingStats['cancelled'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Favorite Room & Monthly Trends -->
        <div class="grid grid-cols-1 gap-5 lg:grid-cols-2">
            <!-- Favorite Room -->
            @if($favoriteRoom)
                <div class="bg-white shadow-sm rounded-lg">
                    <div class="p-6">
                        <h2 class="text-lg font-medium text-gray-900">Your Favorite Room</h2>
                        <div class="mt-4">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p class="text-lg font-medium text-gray-900">{{ $favoriteRoom->name }}</p>
                                <p class="mt-1 text-sm text-gray-500">Most frequently booked room type</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Monthly Booking Trends -->
            <div class="bg-white shadow-sm rounded-lg">
                <div class="p-6">
                    <h2 class="text-lg font-medium text-gray-900">Monthly Booking Trends</h2>
                    <div class="mt-4">
                        <div class="space-y-2">
                            @foreach($monthlyBookings as $booking)
                                <div class="flex items-center">
                                    <span class="text-sm text-gray-500 w-20">{{ Carbon\Carbon::parse($booking->month)->format('M Y') }}</span>
                                    <div class="flex-1 ml-4">
                                        <div class="h-4 bg-blue-100 rounded-full">
                                            <div class="h-4 bg-blue-500 rounded-full" style="width: {{ ($booking->count / $monthlyBookings->max('count')) * 100 }}%"></div>
                                        </div>
                                    </div>
                                    <span class="ml-4 text-sm text-gray-600">{{ $booking->count }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
