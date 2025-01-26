<?php

namespace App\Http\Controllers;
use App\Models\Feedback;
use App\Models\Room;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function feedBack()
    {
        $featuredRooms = Room::where('is_featured', true)->get(); // Assuming Room model exists
        $feedbacks = Feedback::latest()->take(5)->get(); // Fetch the latest 5 feedbacks
        return view('welcome', compact('featuredRooms', 'feedbacks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:500',
            'rating' => 'nullable|integer|min:1|max:5'
        ]);

        auth()->user()->feedbacks()->create($validated);

        return redirect()->back()->with('success', __('Feedback submitted successfully'));
    }
}
