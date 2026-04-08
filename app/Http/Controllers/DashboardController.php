<?php

namespace App\Http\Controllers;

use App\Models\CatchLog;
use App\Models\Sale;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Calculate stats from your database
        $totalCatch = CatchLog::sum('weight_kg');
        $marketPrice = Sale::latest()->value('price_per_kg') ?? 4.50;
        
        // Fetch Payout Ledger data
        // We join CatchLogs with Sales and Users to get the Fisherman's name
        $payouts = Sale::with(['catchLog.fisherProfile.user'])->latest()->take(10)->get();

        return view('dashboard', compact('totalCatch', 'marketPrice', 'payouts'));
    }
}