<aside class="w-64 bg-white shadow-md">
    <div class="p-4">
        <h2 class="text-xl font-bold">ABC Hotel</h2>
    </div>

    <nav class="mt-4">
        <a href="{{ route('receptionist.dashboard') }}"
           class="block px-4 py-2 text-gray-600 hover:bg-gray-100 {{ request()->routeIs('receptionist.dashboard') ? 'bg-gray-100' : '' }}">
            Dashboard
        </a>
        <a href="{{ route('receptionist.bookings.index') }}"
           class="block px-4 py-2 text-gray-600 hover:bg-gray-100 {{ request()->routeIs('receptionist.bookings.*') ? 'bg-gray-100' : '' }}">
            Bookings
        </a>
        <a href="{{ route('receptionist.rooms.index') }}"
           class="block px-4 py-2 text-gray-600 hover:bg-gray-100 {{ request()->routeIs('receptionist.rooms.*') ? 'bg-gray-100' : '' }}">
            Rooms
        </a>
        <a href="{{ route('receptionist.inquiries.index') }}"
           class="block px-4 py-2 text-gray-600 hover:bg-gray-100 {{ request()->routeIs('receptionist.inquiries.*') ? 'bg-gray-100' : '' }}">
            Inquiries
        </a>

    </nav>
</aside>
