@extends('layouts.app')

@section('title', 'Welcome to ABC Hotel')

@section('content')
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h1 class="display-4">Welcome to ABC Hotel</h1>
                    <p class="lead">Experience luxury and comfort in the heart of the city</p>
                    <a href="{{ url('/rooms') }}" class="btn btn-light btn-lg">Book Now</a>
                </div>
            </div>
        </div>
    </div>

    {{--    <!-- Featured Rooms Section -->--}}
    {{--    <div class="container mt-5">--}}
    {{--        <h2 class="text-center mb-4">Our Featured Rooms</h2>--}}
    {{--        <div class="row">--}}
    {{--            @foreach($featuredRooms as $room)--}}
    {{--                <div class="col-md-4 mb-4">--}}
    {{--                    <div class="card">--}}
    {{--                        <img src="/images/rooms/{{ strtolower(str_replace(' ', '-', $room->name)) }}.jpg"--}}
    {{--                             class="card-img-top" alt="{{ $room->name }}">--}}
    {{--                        <div class="card-body">--}}
    {{--                            <h5 class="card-title">{{ $room->name }}</h5>--}}
    {{--                            <p class="card-text">--}}
    {{--                                Size: {{ $room->size_sqf }} sq ft<br>--}}
    {{--                                Bed: {{ $room->bed_type }}<br>--}}
    {{--                                Max Guests: {{ $room->max_count }}--}}
    {{--                            </p>--}}
    {{--                            <a href="{{ url('/rooms/' . $room->id) }}" class="btn btn-custom">View Details</a>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            @endforeach--}}
    {{--        </div>--}}
    {{--    </div>--}}

    <!-- About Section -->
    <div class="container mt-5">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2>About ABC Hotel</h2>
                <p>Experience the perfect blend of comfort and luxury at ABC Hotel. Our prime location and exceptional service make us the ideal choice for both business and leisure travelers.</p>
                <ul class="list-unstyled">
                    <li>✓ 24/7 Room Service</li>
                    <li>✓ Free WiFi</li>
                    <li>✓ Spa & Fitness Center</li>
                    <li>✓ Restaurant & Bar</li>
                </ul>
                <a href="{{ url('/about') }}" class="btn btn-custom">Learn More</a>
            </div>
            <div class="col-md-6">
                <img src="/images/hotel-about.jpg" class="img-fluid rounded" alt="About ABC Hotel">
            </div>
        </div>
    </div>
@endsection
