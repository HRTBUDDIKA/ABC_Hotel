@extends('layouts.public')

@section('title', 'Welcome')

@section('content')
    <div class="space-y-12">
        <div class="relative h-96">
            <div class="absolute inset-0 bg-black opacity-50"></div>
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="text-center text-white">
                    <h1 class="text-4xl font-bold mb-4">Welcome to ABC Hotel</h1>
                    <p class="text-xl mb-8">Experience luxury and comfort</p>
                    <a href="{{ route('rooms') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
                        Book Now
                    </a>
                </div>
            </div>
        </div>

        <!-- News Alerts with proper spacing -->
        <div class="mx-auto px-4 sm:px-6 lg:px-8 border-gray-900">
            @include('components.news-alerts')
        </div>

        <section class="py-12">
            <h2 class="text-3xl font-semibold text-center mb-8">Featured Rooms</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($featuredRooms as $room)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        @if($room->image)
                            <img src="{{ asset('storage/' . $room->image) }}" alt="{{ $room->category }}" class="w-full h-48 object-cover">
                        @endif
                        <div class="p-4">
                            <h3 class="text-xl font-semibold mb-2">{{ $room->category }}</h3>
                            <p class="text-gray-600 mb-4">{{ $room->special_feature }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-bold">${{ $room->price }}/night</span>
                                <a href="{{ route('booking.form', $room) }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                    Book Now
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection
