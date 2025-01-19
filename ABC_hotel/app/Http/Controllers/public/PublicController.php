<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Inquiry;
use App\Models\MealPlan;
use App\Models\Room;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function home()
    {
        $featuredRooms = Room::where('status', 'available')
            ->take(4)
            ->get();

        return view('public.home', compact('featuredRooms'));
    }

    public function about()
    {
        return view('public.about');
    }

    public function contact()
    {
        return view('public.contact');
    }

    public function submitInquiry(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        Inquiry::create($validated);

        return redirect()->route('contact')
            ->with('success', 'Your inquiry has been submitted successfully. We will contact you soon.');
    }

        public function rooms()
    {
        $rooms = Room::where('status', 'available')
            ->orderBy('category')
            ->get();

        return view('public.rooms.index', compact('rooms'));
    }

    public function roomCategory($category)
    {
        $rooms = Room::where('category', $category)
            ->where('status', 'available')
            ->get();

        return view('public.rooms.category', compact('rooms', 'category'));
    }

    public function mealPlans()
    {
        $mealPlans = MealPlan::all();
        return view('public.meal-plans', compact('mealPlans'));
    }
}
