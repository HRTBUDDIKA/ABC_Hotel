<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function index()
    {
        $inquiries = Inquiry::latest()->paginate(10);
        return view('receptionist.inquiries.index', compact('inquiries'));
    }

    public function show(Inquiry $inquiry)
    {
        return view('receptionist.inquiries.show', compact('inquiry'));
    }

    public function respond(Request $request, Inquiry $inquiry)
    {
        $validated = $request->validate([
            'response' => 'required|string',
            'status' => 'required|in:pending,in_progress,resolved'
        ]);

        $inquiry->update([
            'response' => $validated['response'],
            'status' => $validated['status'],
            'responded_by' => auth()->id(),
            'responded_at' => now()
        ]);

        return redirect()->route('receptionist.inquiries.show', $inquiry)
            ->with('success', 'Response sent successfully.');
    }
}
