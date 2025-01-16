@extends('layouts.public')

@section('title', 'Meal Plans')

@section('content')
    <div class="space-y-8">
        <h1 class="text-3xl font-bold">Our Meal Plans</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($mealPlans as $plan)
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-2xl font-semibold mb-4">{{ $plan->name }}</h2>
                    <div class="space-y-2 mb-6">
                        <p>
                            <span class="font-medium">Breakfast:</span>
                            {{ $plan->breakfast ? 'Included' : 'Not included' }}
                        </p>
                        <p>
                            <span class="font-medium">Lunch:</span>
                            {{ $plan->lunch ? 'Included' : 'Not included' }}
                        </p>
                        <p>
                            <span class="font-medium">Dinner:</span>
                            {{ $plan->dinner ? 'Included' : 'Not included' }}
                        </p>
                    </div>
                    <div class="text-center">
                        <span class="text-2xl font-bold">${{ $plan->price }}/person/day</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
