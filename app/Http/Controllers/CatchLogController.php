<?php

namespace App\Http\Controllers;

use App\Models\CatchLog; // This is the correct way to link the model
use Illuminate\Http\Request;

class CatchLogController extends Controller
{
    public function index()
    {
        $logs = CatchLog::with('fisherProfile.user')->latest()->get();
        return view('catch-log.index', compact('logs'));
    }

    // Finalize the weight at the dock
    public function finalize(Request $request, $id) {
        $log = CatchLog::findOrFail($id);
        
        $log->update([
            'weight_kg' => $request->actual_weight,
            'status' => 'finalized'
        ]);

        // This creates the payout record
        \App\Models\Sale::create([
            'catch_log_id' => $log->id,
            'buyer_name' => 'Market',
            'price_per_kg' => 150, 
            'total_amount' => $request->actual_weight * 150,
            'sale_date' => now(),
            'payout_status' => 'paid'
        ]);
    }
    public function acknowledgeSms($id) {
        $log = CatchLog::findOrFail($id);
        
        // This moves it from the Top Table to the Bottom Table
        $log->update(['status' => 'acknowledged']);

        // (Optional) Send the SMS back to the fisherman here...
        
        return back()->with('success', 'Fisherman acknowledged!');
    }
}