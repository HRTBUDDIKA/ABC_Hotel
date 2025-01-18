@extends('layouts.public')

@section('title', 'Book a Room')

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('content')
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold mb-8">Book {{ $room->category }}</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <!-- Room Details Card -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4">Room Details</h2>
                @if($room->image)
                    <img src="{{ asset('storage/' . $room->image) }}" alt="{{ $room->category }}" class="w-full h-48 object-cover rounded-lg mb-4">
                @endif
                <div class="space-y-2">
                    <p><strong>Size:</strong> {{ $room->size }} sqft</p>
                    <p><strong>Bed Type:</strong> {{ $room->bed_type }}</p>
                    <p><strong>Max Occupancy:</strong> {{ $room->max_occupancy }} persons</p>
                    <p><strong>Special Feature:</strong> {{ $room->special_feature }}</p>
                    <p class="text-xl font-bold mt-4">${{ $room->price }}/night</p>
                </div>
            </div>

            <!-- Booking Form -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4">Booking Details</h2>
                <form action="{{ route('booking.store', $room) }}" method="POST" id="bookingForm" class="space-y-4">
                    @csrf

                    <!-- Guest Information -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                        <input type="text" name="name" id="name" required
                               value="{{ old('name') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" required
                               value="{{ old('email') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                        <input type="tel" name="phone" id="phone" required
                               value="{{ old('phone') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <!-- Booking Dates -->
                    <div>
                        <label for="check_in" class="block text-sm font-medium text-gray-700">Check-in Date</label>
                        <input type="date" name="check_in" id="check_in" required
                               value="{{ old('check_in') }}"
                               min="{{ date('Y-m-d') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 datepicker">
                    </div>

                    <div>
                        <label for="check_out" class="block text-sm font-medium text-gray-700">Check-out Date</label>
                        <input type="date" name="check_out" id="check_out" required
                               value="{{ old('check_out') }}"
                               min="{{ date('Y-m-d') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 datepicker">
                    </div>

                    <div>
                        <label for="guests" class="block text-sm font-medium text-gray-700">Number of Guests</label>
                        <input type="number" name="guests" id="guests" required
                               min="1" max="{{ $room->max_occupancy }}"
                               value="{{ old('guests', 1) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <p class="text-sm text-gray-500 mt-1">Maximum: {{ $room->max_occupancy }} guests</p>
                    </div>

                    <!-- Meal Plan Selection -->
                    <div>
                        <label for="meal_plan_id" class="block text-sm font-medium text-gray-700">Meal Plan</label>
                        <select name="meal_plan_id" id="meal_plan_id" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Select a meal plan</option>
                            @foreach($mealPlans as $plan)
                                <option value="{{ $plan->id }}" {{ old('meal_plan_id') == $plan->id ? 'selected' : '' }}>
                                    {{ $plan->name }} - ${{ $plan->price }}/person/day
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Special Requests -->
                    <div>
                        <label for="special_requests" class="block text-sm font-medium text-gray-700">Special Requests</label>
                        <textarea name="special_requests" id="special_requests" rows="3"
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('special_requests') }}</textarea>
                    </div>

                    <!-- Price Calculation -->
                    <div class="border-t pt-4 mt-6">
                        <h3 class="text-lg font-semibold mb-2">Estimated Total</h3>
                        <div id="priceCalculation" class="text-gray-600">
                            <p>Room Cost: <span id="roomCost">$0</span></p>
                            <p>Meal Plan Cost: <span id="mealPlanCost">$0</span></p>
                            <p class="text-xl font-bold mt-2">Total: <span id="totalCost">$0</span></p>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
                        Confirm Booking
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize date pickers
            const checkInPicker = flatpickr("#check_in", {
                minDate: "today",
                onChange: function(selectedDates) {
                    checkOutPicker.set('minDate', selectedDates[0]);
                    calculateTotal();
                }
            });

            const checkOutPicker = flatpickr("#check_out", {
                minDate: "today",
                onChange: function() {
                    calculateTotal();
                }
            });

            // Form elements
            const guestsInput = document.getElementById('guests');
            const mealPlanSelect = document.getElementById('meal_plan_id');

            // Add event listeners for price calculation
            guestsInput.addEventListener('change', calculateTotal);
            mealPlanSelect.addEventListener('change', calculateTotal);

            function calculateTotal() {
                const checkIn = document.getElementById('check_in').value;
                const checkOut = document.getElementById('check_out').value;
                const guests = parseInt(guestsInput.value);
                const mealPlanSelect = document.getElementById('meal_plan_id');
                const selectedPlan = mealPlanSelect.options[mealPlanSelect.selectedIndex];

                if (checkIn && checkOut) {
                    // Calculate number of nights
                    const start = new Date(checkIn);
                    const end = new Date(checkOut);
                    const nights = Math.ceil((end - start) / (1000 * 60 * 60 * 24));

                    if (nights > 0) {
                        // Calculate room cost
                        const roomCost = {{ $room->price }} * nights;
                        document.getElementById('roomCost').textContent = `$${roomCost}`;

                        // Calculate meal plan cost
                        let mealPlanCost = 0;
                        if (selectedPlan && selectedPlan.value) {
                            const mealPlanPrice = parseFloat(selectedPlan.textContent.match(/\$(\d+(\.\d+)?)/)[1]);
                            mealPlanCost = mealPlanPrice * guests * nights;
                        }
                        document.getElementById('mealPlanCost').textContent = `$${mealPlanCost}`;

                        // Update total
                        const total = roomCost + mealPlanCost;
                        document.getElementById('totalCost').textContent = `$${total}`;
                    }
                }
            }

            // Form validation
            document.getElementById('bookingForm').addEventListener('submit', function(e) {
                const checkIn = new Date(document.getElementById('check_in').value);
                const checkOut = new Date(document.getElementById('check_out').value);

                if (checkOut <= checkIn) {
                    e.preventDefault();
                    alert('Check-out date must be after check-in date');
                    return false;
                }

                const guests = parseInt(document.getElementById('guests').value);
                if (guests < 1 || guests > {{ $room->max_occupancy }}) {
                    e.preventDefault();
                    alert('Invalid number of guests');
                    return false;
                }
            });
        });
    </script>
@endsection
