@extends('layouts.public')

@section('title', 'Our Rooms')

@section('content')
    <div class="space-y-8">
        <h1 class="text-3xl font-bold">Our Rooms</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($rooms as $room)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    @if($room->image)
                        <img src="{{ asset('storage/' . $room->image) }}" alt="{{ $room->category }}" class="w-full h-64 object-cover">
                    @endif
                    <div class="p-6">
                        <h2 class="text-2xl font-semibold mb-2">{{ $room->category }}</h2>
                        <div class="text-gray-600 space-y-2 mb-4">
                            <p><strong>Size:</strong> {{ $room->size }} sqft</p>
                            <p><strong>Bed Type:</strong> {{ $room->bed_type }}</p>
                            <p><strong>Max Occupancy:</strong> {{ $room->max_occupancy }} persons</p>
                            <p><strong>Special Feature:</strong> {{ $room->special_feature }}</p>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold">${{ $room->price }}/night</span>
                            <a href="{{ route('booking.details', $room) }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                Show me
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
