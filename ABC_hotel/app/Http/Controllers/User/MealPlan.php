<?php

namespace App\Http\Controllers\User;

class MealPlan
{

    public function mealPlans()
    {
        $mealPlans = \App\Models\MealPlan::all();
        return view('user.meal-plans', compact('mealPlans'));
    }
}
