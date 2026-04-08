<?php

namespace App\Http\Controllers;
use App\Models\Sale;

class PayoutController extends Controller {
    public function index() {
        // Fetch all sales with fisherman info
        $payouts = Sale::with('catchLog.fisherProfile.user')->latest()->get();
        return view('payouts.index', compact('payouts'));
    }
}
