@extends('layouts.admin')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Meal Plans</h1>
            <button type="button" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded"
                    onclick="document.getElementById('createMealPlanModal').classList.remove('hidden')">
                Create New Meal Plan
            </button>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Meal Plans Table -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Breakfast</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lunch</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dinner</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created At</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach($mealPlans as $mealPlan)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $mealPlan->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($mealPlan->breakfast)
                                <span class="text-green-600">✓</span>
                            @else
                                <span class="text-red-600">✗</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($mealPlan->lunch)
                                <span class="text-green-600">✓</span>
                            @else
                                <span class="text-red-600">✗</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($mealPlan->dinner)
                                <span class="text-green-600">✓</span>
                            @else
                                <span class="text-red-600">✗</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">${{ number_format($mealPlan->price, 2) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $mealPlan->created_at->format('Y-m-d H:i') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <button class="text-blue-600 hover:text-blue-900 mr-2">Edit</button>
                            <button class="text-red-600 hover:text-red-900">Delete</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Create Meal Plan Modal -->
        <div id="createMealPlanModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                <div class="mt-3">
                    <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Create New Meal Plan</h3>
                    <form action="{{ route('admin.meal-plans.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                                Name
                            </label>
                            <input type="text" name="name" id="name" required
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Meals Included</label>
                            <div class="space-y-2">
                                <div>
                                    <input type="checkbox" name="breakfast" id="breakfast" value="1">
                                    <label for="breakfast">Breakfast</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="lunch" id="lunch" value="1">
                                    <label for="lunch">Lunch</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="dinner" id="dinner" value="1">
                                    <label for="dinner">Dinner</label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="price">
                                Price
                            </label>
                            <input type="number" step="0.01" name="price" id="price" required
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>

                        <div class="flex justify-end space-x-3">
                            <button type="button"
                                    onclick="document.getElementById('createMealPlanModal').classList.add('hidden')"
                                    class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                                Cancel
                            </button>
                            <button type="submit"
                                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                Create
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
