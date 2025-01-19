<?php

namespace App\Http\Controllers;

use App\Models\NewsAlert;

class NewsAlertController extends Controller
{
    public function getActiveAlerts()
    {
        $alerts = NewsAlert::where('status', true)
            ->where('start_date', '<=', now())
            ->where(function ($query) {
                $query->whereNull('end_date')
                    ->orWhere('end_date', '>=', now());
            })
            ->orderBy('priority', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($alerts);
    }
}
