<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo1.png') }}">
    <title>@yield('title') - ABC Hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<nav class="bg-white shadow-lg">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="flex-shrink-0 flex items-center">
                    <span class="text-xl font-bold">ABC Hotel</span>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:space-x-8 items-center">

                    <a href="{{ route('user.dashboard') }}" class="@if(request()->routeIs('user.dashboard')) text-blue-500 @endif">
                        Dashboard
                    </a>
                    <a href="{{ route('user.bookings.index') }}" class="@if(request()->routeIs('user.bookings.*')) text-blue-500 @endif">
                        My Bookings
                    </a>
                    <a href="{{ route('user.rooms') }}" class="@if(request()->routeIs('user.rooms')) text-blue-500 @endif">
                        Rooms
                    </a>
                    <a href="{{ route('user.meal-plans') }}" class="@if(request()->routeIs('user.meal-plans')) text-blue-500 @endif">
                        Meal-Plan
                    </a>
                </div>
            </div>
            <div class="flex items-center">
                <div class="ml-3 relative">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-600 hover:text-gray-900">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>



<main class="py-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if (session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </div>
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
</body>
</html>
