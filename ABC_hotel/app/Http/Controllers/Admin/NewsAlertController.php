<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsAlert;
use Illuminate\Http\Request;

class NewsAlertController extends Controller
{
    public function index()
    {
        $alerts = NewsAlert::with('user')->latest()->paginate(10);
        return view('admin.news-alerts.index', compact('alerts'));
    }

    public function create()
    {
        return view('admin.news-alerts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'priority' => 'required|in:low,medium,high',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
        ]);

        $validated['created_by'] = auth()->id();
        $validated['status'] = true;

        NewsAlert::create($validated);

        return redirect()->route('admin.news-alerts.index')
            ->with('success', 'News alert created successfully.');
    }

    public function edit(NewsAlert $newsAlert)
    {
        return view('admin.news-alerts.edit', compact('newsAlert'));
    }

    public function update(Request $request, NewsAlert $newsAlert)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'priority' => 'required|in:low,medium,high',
            'status' => 'boolean',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
        ]);

        $newsAlert->update($validated);

        return redirect()->route('admin.news-alerts.index')
            ->with('success', 'News alert updated successfully.');
    }

    public function destroy(NewsAlert $newsAlert)
    {
        $newsAlert->delete();
        return redirect()->route('admin.news-alerts.index')
            ->with('success', 'News alert deleted successfully.');
    }
}
