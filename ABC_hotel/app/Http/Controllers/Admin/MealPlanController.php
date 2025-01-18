<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MealPlan;
use Illuminate\Http\Request;

class MealPlanController extends Controller
{
    public function index()
    {
        $mealPlans = MealPlan::latest()->get();
        return view('admin.meal-plans.index', compact('mealPlans'));
    }

    public function create()
    {
        return view('admin.meal-plans.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'breakfast' => 'boolean',
            'lunch' => 'boolean',
            'dinner' => 'boolean',
            'price' => 'required|numeric|min:0'
        ]);

        // Handle unchecked checkboxes
        $validated['breakfast'] = $request->has('breakfast');
        $validated['lunch'] = $request->has('lunch');
        $validated['dinner'] = $request->has('dinner');

        try {
            MealPlan::create($validated);
            return redirect()->route('admin.meal-plans.index')
                ->with('success', 'Meal plan created successfully');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Error creating meal plan: ' . $e->getMessage());
        }
    }

    public function edit(MealPlan $mealPlan)
    {
        return view('admin.meal-plans.edit', compact('mealPlan'));
    }

    public function update(Request $request, MealPlan $mealPlan)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'breakfast' => 'boolean',
            'lunch' => 'boolean',
            'dinner' => 'boolean',
            'price' => 'required|numeric|min:0'
        ]);

        // Handle unchecked checkboxes
        $validated['breakfast'] = $request->has('breakfast');
        $validated['lunch'] = $request->has('lunch');
        $validated['dinner'] = $request->has('dinner');

        try {
            $mealPlan->update($validated);
            return redirect()->route('admin.meal-plans.index')
                ->with('success', 'Meal plan updated successfully');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Error updating meal plan: ' . $e->getMessage());
        }
    }

    public function destroy(MealPlan $mealPlan)
    {
        try {
            $mealPlan->delete();
            return redirect()->route('admin.meal-plans.index')
                ->with('success', 'Meal plan deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting meal plan: ' . $e->getMessage());
        }
    }
}
