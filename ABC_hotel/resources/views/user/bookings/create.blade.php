
@extends('layouts.user')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-bold mb-4">Create New Booking</h2>

                    <form method="POST" action="{{ route('user.bookings.store') }}" class="space-y-6">
                        @csrf

                        <!-- Room Selection -->
                        <div>
                            <label for="room_id" class="block text-sm font-medium text-gray-700">Select Room</label>
                            <select id="room_id" name="room_id" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Choose a room</option>
                                @foreach ($rooms as $room)
                                    <option value="{{ $room->id }}" {{ old('room_id') == $room->id ? 'selected' : '' }}>
                                        {{ $room->name }} - ${{ number_format($room->price_per_night, 2) }}/night
                                    </option>
                                @endforeach
                            </select>
                            @error('room_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Meal Plan Selection -->
                        <div>
                            <label for="meal_plan_id" class="block text-sm font-medium text-gray-700">Select Meal Plan</label>
                            <select id="meal_plan_id" name="meal_plan_id" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Choose a meal plan</option>
                                @foreach ($mealPlans as $mealPlan)
                                    <option value="{{ $mealPlan->id }}" {{ old('meal_plan_id') == $mealPlan->id ? 'selected' : '' }}>
                                        {{ $mealPlan->name }} - ${{ number_format($mealPlan->price_per_person, 2) }}/person/day
                                    </option>
                                @endforeach
                            </select>
                            @error('meal_plan_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Check-in Date -->
                        <div>
                            <label for="check_in" class="block text-sm font-medium text-gray-700">Check-in Date</label>
                            <input type="date" id="check_in" name="check_in" value="{{ old('check_in') }}" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('check_in')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Check-out Date -->
                        <div>
                            <label for="check_out" class="block text-sm font-medium text-gray-700">Check-out Date</label>
                            <input type="date" id="check_out" name="check_out" value="{{ old('check_out') }}" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('check_out')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Number of Guests -->
                        <div>
                            <label for="guests" class="block text-sm font-medium text-gray-700">Number of Guests</label>
                            <input type="number" id="guests" name="guests" value="{{ old('guests', 1) }}" min="1" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('guests')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Special Requests -->
                        <div>
                            <label for="special_requests" class="block text-sm font-medium text-gray-700">Special Requests</label>
                            <textarea id="special_requests" name="special_requests" rows="4"
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('special_requests') }}</textarea>
                            @error('special_requests')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end">
                            <a href="{{ route('user.bookings.index') }}"
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                                Cancel
                            </a>
                            <button type="submit"
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                                Create Booking
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

