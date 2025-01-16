@extends('receptionist.layouts.app')

@section('content')
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-2xl font-bold">Bookings</h2>
        </div>

        <div class="p-6">
            @include('receptionist.bookings._table')
        </div>
    </div>
@endsection
