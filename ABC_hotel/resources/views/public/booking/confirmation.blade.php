@extends('layouts.public')

@section('title', 'Booking Confirmation')

@section('content')
    <div class="flex items-center justify-center  bg-gray-100">
        <div class="bg-white rounded-lg shadow-lg p-8 text-center">
            <div class="flex justify-center mb-4">
                <!-- Green check icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5-2a9 9 0 11-6-8.48 9.003 9.003 0 0111.25 11.25A9.003 9.003 0 0112 21v0z" />
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-gray-700 mb-4">Thank You for Your Booking!</h1>
            <p class="text-gray-600 mb-4">
                We have received your booking request and will contact you shortly with the details.
            </p>
            <a href="{{ route('welcome') }}" class="bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600">
                Go to Homepage
            </a>
        </div>
    </div>
@endsection
