@extends('receptionist.layouts.app')

@section('title', 'Contact Us')

@section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Inquiry Details -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium">{{ $inquiry->subject }}</h3>
                        <p class="text-sm text-gray-600">From: {{ $inquiry->name }} ({{ $inquiry->email }})</p>
                        <p class="text-sm text-gray-600">Submitted: {{ $inquiry->created_at->format('Y-m-d H:i') }}</p>
                    </div>

                    <div class="mb-6">
                        <h4 class="font-medium mb-2">Message:</h4>
                        <p class="text-gray-700">{{ $inquiry->message }}</p>
                    </div>

                    <!-- Response Form -->
                    <form action="{{ route('receptionist.inquiries.respond', $inquiry) }}" method="POST" class="mt-6">
                        @csrf

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="pending" {{ $inquiry->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="in_progress" {{ $inquiry->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="resolved" {{ $inquiry->status === 'resolved' ? 'selected' : '' }}>Resolved</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Response</label>
                            <textarea name="response" rows="4"
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('response', $inquiry->response) }}</textarea>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Send Response
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
