@extends('receptionist.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Booking</div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('receptionist.bookings.store') }}" method="POST">
                            @csrf

                            <!-- Guest Name -->
                            <div class="mb-3">
                                <label for="guest_name" class="form-label">Guest Name</label>
                                <input type="text" name="guest_name" id="guest_name" class="form-control" value="{{ old('guest_name') }}" required>
                            </div>

                            <!-- Guest Email -->
                            <div class="mb-3">
                                <label for="guest_email" class="form-label">Guest Email</label>
                                <input type="email" name="guest_email" id="guest_email" class="form-control" value="{{ old('guest_email') }}" required>
                            </div>

                            <!-- Guest Phone -->
                            <div class="mb-3">
                                <label for="guest_phone" class="form-label">Guest Phone</label>
                                <input type="text" name="guest_phone" id="guest_phone" class="form-control" value="{{ old('guest_phone') }}" required>
                            </div>

                            <!-- Room Selection -->
                            <div class="mb-3">
                                <label for="room_id" class="form-label">Select Room</label>
                                <select name="room_id" id="room_id" class="form-select" required>
                                    <option value="" disabled selected>Select an available room</option>
                                    @foreach ($rooms as $room)
                                        <option value="{{ $room->id }}" {{ old('room_id') == $room->id ? 'selected' : '' }}>
                                            Room {{ $room->number }} - {{ $room->type }} ({{ $room->price }} per night)
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Meal Plan Selection -->
                            <div class="mb-3">
                                <label for="meal_plan_id" class="form-label">Select Meal Plan</label>
                                <select name="meal_plan_id" id="meal_plan_id" class="form-select" required>
                                    <option value="" disabled selected>Select a meal plan</option>
                                    @foreach ($mealPlans as $mealPlan)
                                        <option value="{{ $mealPlan->id }}" {{ old('meal_plan_id') == $mealPlan->id ? 'selected' : '' }}>
                                            {{ $mealPlan->name }} - {{ $mealPlan->price }} per day
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Check-in Date -->
                            <div class="mb-3">
                                <label for="check_in" class="form-label">Check-in Date</label>
                                <input type="date" name="check_in" id="check_in" class="form-control" value="{{ old('check_in') }}" required>
                            </div>

                            <!-- Check-out Date -->
                            <div class="mb-3">
                                <label for="check_out" class="form-label">Check-out Date</label>
                                <input type="date" name="check_out" id="check_out" class="form-control" value="{{ old('check_out') }}" required>
                            </div>

                            <!-- Adults -->
                            <div class="mb-3">
                                <label for="adults" class="form-label">Adults</label>
                                <input type="number" name="adults" id="adults" class="form-control" value="{{ old('adults', 1) }}" min="1" required>
                            </div>

                            <!-- Children -->
                            <div class="mb-3">
                                <label for="children" class="form-label">Children</label>
                                <input type="number" name="children" id="children" class="form-control" value="{{ old('children', 0) }}" min="0" required>
                            </div>

                            <!-- Submit Button -->
                            <div class="mb-3 text-center">
                                <button type="submit" class="btn btn-primary">Create Booking</button>
                                <a href="{{ route('receptionist.bookings.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
