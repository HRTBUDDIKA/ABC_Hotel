@extends('layouts.public')

@section('title', 'Contact Us')

@section('content')
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold mb-8">Contact Us</h1>

        <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" required
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" required
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            <div>
                <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                <textarea name="message" id="message" rows="6" required
                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
                Send Message
            </button>
        </form>

        <div class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <h2 class="text-xl font-semibold mb-4">Contact Information</h2>
                <p class="text-gray-600">
                    123 Hotel Street<br>
                    City, Country<br>
                    Phone: +1 234 567 890<br>
                    Email: info@abchotel.com
                </p>
            </div>
            <div>
                <h2 class="text-xl font-semibold mb-4">Opening Hours</h2>
                <p class="text-gray-600">
                    Reception: 24/7<br>
                    Restaurant: 6:30 AM - 10:30 PM<br>
                    Room Service: 24/7<br>
                    Fitness Center: 6:00 AM - 10:00 PM
                </p>
            </div>
        </div>
    </div>
@endsection
