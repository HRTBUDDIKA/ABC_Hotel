<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - Receptionist</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo1.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="bg-gray-100">
<div class="min-h-screen flex">
    <!-- Sidebar -->
    @include('receptionist.layouts.sidebar')

    <!-- Main Content -->
    <div class="flex-1">
        <!-- Top Navigation -->
        @include('receptionist.layouts.navigation')

        <!-- Page Content -->
        <main class="p-6">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
