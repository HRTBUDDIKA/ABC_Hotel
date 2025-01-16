@extends('layouts.public')

@section('title', 'About Us')

@section('content')
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold mb-8">About ABC Hotel</h1>

        <div class="prose lg:prose-xl">
            <p class="mb-6">
                Welcome to ABC Hotel, where luxury meets comfort. Established in [year], we have been providing exceptional hospitality services to our guests from around the world.
            </p>

            <h2 class="text-2xl font-semibold mt-8 mb-4">Our Mission</h2>
            <p class="mb-6">
                To provide our guests with an unforgettable experience through exceptional service, comfortable accommodations, and attention to detail.
            </p>

            <h2 class="text-2xl font-semibold mt-8 mb-4">Our Facilities</h2>
            <ul class="list-disc pl-6 mb-6">
                <li>24/7 Room Service</li>
                <li>Swimming Pool</li>
                <li>Fitness Center</li>
                <li>Restaurant & Bar</li>
                <li>Conference Rooms</li>
                <li>Free Wi-Fi</li>
            </ul>

            <h2 class="text-2xl font-semibold mt-8 mb-4">Location</h2>
            <p class="mb-6">
                Perfectly situated in the heart of the city, ABC Hotel offers easy access to major attractions, shopping centers, and business districts.
            </p>
        </div>
    </div>
@endsection
