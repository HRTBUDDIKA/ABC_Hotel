<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @yield('styles')
</head>
<body class="bg-gray-100">
<nav class="bg-white shadow-lg">
    <div class="container mx-auto px-6 py-4">
        <div class="flex justify-between items-center">
            <div class="text-xl font-semibold">
                <a href="{{ route('welcome') }}">ABC Hotel</a>
            </div>
            <div class="space-x-6">
                <a href="{{ route('welcome') }}" class="hover:text-blue-600">Home</a>
                <a href="{{ route('rooms') }}" class="hover:text-blue-600">Rooms</a>
                <a href="{{ route('meal-plans') }}" class="hover:text-blue-600">Meal Plans</a>
                <a href="{{ route('about') }}" class="hover:text-blue-600">About</a>
                <a href="{{ route('contact') }}" class="hover:text-blue-600">Contact</a>
                <a href="{{ route('login') }}" class="hover:text-blue-600">Login</a>
                <a href="{{ route('register') }}" class="hover:text-blue-600">Register</a>
            </div>
        </div>
    </div>
</nav>

<main class="container mx-auto px-6 py-8">
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</main>

<footer class="bg-gray-800 text-white mt-12">
    <div class="container mx-auto px-6 py-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-lg font-semibold mb-4">Contact Us</h3>
                <p>123 Hotel Street</p>
                <p>City, Country</p>
                <p>Phone: +1 234 567 890</p>
                <p>Email: info@abchotel.com</p>
            </div>
            <div>
                <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('rooms') }}">Rooms</a></li>
                    <li><a href="{{ route('meal-plans') }}">Meal Plans</a></li>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold mb-4">Follow Us</h3>
                <div class="flex space-x-4">
                    <a href="#" class="hover:text-blue-400">Facebook</a>
                    <a href="#" class="hover:text-blue-400">Twitter</a>
                    <a href="#" class="hover:text-blue-400">Instagram</a>
                </div>
            </div>
        </div>
        <div class="mt-8 text-center">
            <p>&copy; {{ date('Y') }} ABC Hotel. All rights reserved.</p>
        </div>
    </div>
</footer>

@yield('scripts')
</body>
</html>
