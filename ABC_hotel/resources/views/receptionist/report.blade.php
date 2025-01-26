@extends('receptionist.layouts.app')

@section('content')
<div class="mb-4">
    <form method="GET" action="{{ route('receptionist.bookings.report') }}">
        <label for="start_date" class="mr-2">Start Date:</label>
        <input type="date" name="start_date" id="start_date" class="border rounded p-2">

        <label for="end_date" class="ml-4 mr-2">End Date:</label>
        <input type="date" name="end_date" id="end_date" class="border rounded p-2">

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded ml-4">
            Generate Report
        </button>
    </form>
</div>
@endsection
