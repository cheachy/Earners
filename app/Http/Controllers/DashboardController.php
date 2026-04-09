<?php

namespace App\Http\Controllers;

use App\Models\CatchLog;
use App\Models\FisherProfile;
use App\Models\Sale;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. STATS CARDS
        
        // We sum 'declared_weight' so the card updates IMMEDIATELY when the SMS arrives
        $totalCatchToday = CatchLog::whereDate('created_at', now())->sum('declared_weight');
        
        // Number of unique fishermen who sent an SMS today
        $activeFishers = CatchLog::whereDate('created_at', now())
            ->distinct('fisher_profile_id')
            ->count();
            
        $totalFishers = FisherProfile::count();
        
        // Total money disbursed from the 'sales' table
        $totalPayouts = Sale::sum('total_amount');

        // 2. INCOMING SMS LOGS (Top Table)
        // Show only the "Pending" reports that arrived via SMS
        $pendingSms = CatchLog::where('status', 'pending')
            ->with('fisherProfile.user')
            ->latest()
            ->get();

        // 3. DOCK WEIGH-IN & PAYOUT (Bottom Table)
        // Show reports that are ready for the official scale
        $weighInList = CatchLog::where('status', 'acknowledged')
                ->with('fisherProfile.user')
                ->get();

        // 4. Send to the view
        return view('dashboard', compact(
            'totalCatchToday', 
            'activeFishers', 
            'totalFishers', 
            'totalPayouts', 
            'pendingSms', 
            'weighInList'
        ));
    }
}