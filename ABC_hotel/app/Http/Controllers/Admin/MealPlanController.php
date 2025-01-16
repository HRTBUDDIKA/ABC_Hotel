<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MealPlan;
use Illuminate\Http\Request;

class MealPlanController extends Controller
{
    public function index()
    {
        $mealPlans = MealPlan::all();
        return view('admin.meal-plans.index', compact('mealPlans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'breakfast' => 'required|boolean',
            'lunch' => 'required|boolean',
            'dinner' => 'required|boolean',
            'price' => 'required|numeric'
        ]);

        MealPlan::create($validated);
        return redirect()->route('admin.meal-plans.index')->with('success', 'Meal plan created successfully');
    }
}

