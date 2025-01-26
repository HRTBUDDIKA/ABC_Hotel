<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function create()
    {
        return view('feedback.create');
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
