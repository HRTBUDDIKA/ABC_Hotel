@extends('receptionist.layouts.app')

@section('title', 'Update')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Manage Bookings</h1>

        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Bookings Table -->
        <table class="table-auto w-full border-collapse border border-gray-200">
            <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 px-4 py-2">#</th>
                <th class="border border-gray-300 px-4 py-2">User id</th>
                <th class="border border-gray-300 px-4 py-2">Room id</th>
                <th class="border border-gray-300 px-4 py-2">Meal plan id</th>
                <th class="border border-gray-300 px-4 py-2">Check-In</th>
                <th class="border border-gray-300 px-4 py-2">Check-Out</th>
                <th class="border border-gray-300 px-4 py-2">Status</th>
                <th class="border border-gray-300 px-4 py-2">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($bookings as $booking)
                <tr>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $loop->iteration }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $booking->user_id }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $booking->room->id }} </td>
                    <td class="border border-gray-300 px-4 py-2">{{ $booking->mealPlan->id }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $booking->check_in }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $booking->check_out }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <!-- Status Update Form -->
                        <form method="POST" action="{{ route('receptionist.bookings.updateStatus', $booking->id) }}">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="border rounded p-2">
                                <option value="confirmed" {{ $booking->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="cancelled" {{ $booking->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                <option value="completed" {{ $booking->status === 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                                Update
                            </button>
                        </form>
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        <a href="{{ route('receptionist.bookings.edit', $booking->id) }}" class="text-blue-500 underline">
                            Edit
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="border border-gray-300 px-4 py-2 text-center">No bookings found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $bookings->links() }} <!-- Assumes you’re using Laravel's pagination -->
        </div>
    </div>
@endsection

