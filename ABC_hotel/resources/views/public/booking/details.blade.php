@extends('layouts.public')

@section('title', 'Book a Room')

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-8 text-center">Book {{ $room->category }}</h1>

        <div class=" gap-8 items-start">
            <!-- Room Image and Description -->
            <div class="h-auto self-start">
                @if($room->image)
                    <img src="{{ asset('storage/' . $room->image) }}" alt="{{ $room->category }}"
                         class=" object-cover mb-4 rounded-lg border border-gray-200"

                @endif

                <p class="text-gray-600 text-lg ">
                    Welcome to our luxurious {{ strtolower($room->category) }}!
                    This room offers a perfect blend of comfort and elegance,
                    ideal for both business and leisure travelers.
                    Whether you're unwinding after a long day or preparing for an adventure,
                    our amenities ensure a delightful stay. The {{ $room->special_feature }}
                    adds a unique touch, making your experience truly memorable.
                    Welcome to our luxurious {{ strtolower($room->category) }}!
                    This room offers a perfect blend of comfort and elegance,
                    ideal for both business and leisure travelers.
                    Whether you're unwinding after a long day or preparing for an adventure,
                    our amenities ensure a delightful stay. The {{ $room->special_feature }}
                    adds a unique touch, making your experience truly memorable.
                    Welcome to our luxurious {{ strtolower($room->category) }}!
                    This room offers a perfect blend of comfort and elegance,
                    ideal for both business and leisure travelers.
                    Whether you're unwinding after a long day or preparing for an adventure,
                    our amenities ensure a delightful stay. The {{ $room->special_feature }}
                    adds a unique touch, making your experience truly memorable.
                </p>
            </div>

            <!-- Room Details Card -->
            <div class="bg-white rounded-lg shadow-md p-6 h-auto self-start my-10">
                <h2 class="text-xl font-semibold mb-6">Room Details</h2>
                <div class="space-y-2">
                    <p><strong>Size:</strong> {{ $room->size }} sqft</p>
                    <p><strong>Bed Type:</strong> {{ $room->bed_type }}</p>
                    <p><strong>Max Occupancy:</strong> {{ $room->max_occupancy }} persons</p>
                    <p><strong>Special Feature:</strong> {{ $room->special_feature }}</p>
                    <span class="text-lg font-bold block mt-4">${{ $room->price }}/night</span>
                </div>
                <div class="mt-8">
                    <a href="{{ route('booking.form', $room) }}"
                       class="bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700">
                        Book Now
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
