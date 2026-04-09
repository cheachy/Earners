<?php

namespace App\Http\Controllers;
use App\Models\Sale;

class PayoutController extends Controller {
    public function index()
    {
        // Fetch all sales (payouts) with fisherman info
        $payouts = Sale::with('catchLog.fisherProfile.user')->latest()->get();
        return view('payouts.index', compact('payouts'));
    }

    // Function to notify the fisherman via SMS using Textbee
    public function notify($id)
    {
        $sale = Sale::with('catchLog.fisherProfile.user')->findOrFail($id);
        $profile = $sale->catchLog->fisherProfile;

        $message = "Earners: Hi {$profile->user->name}, your payout of ₱" . number_format($sale->total_amount, 2) . " has been disbursed. Keep fishing safely!";

        $url = "https://api.textbee.dev/api/v1/gateway/devices/" . env('TEXTBEE_DEVICE_ID') . "/send-sms";

        $response = \Illuminate\Support\Facades\Http::withHeaders([
            'x-api-key' => env('TEXTBEE_API_KEY'),
        ])->post($url, [
            'receiver' => $profile->contact_number,
            'message'  => $message,
        ]);

        return back()->with('success', 'SMS Notification sent to ' . $profile->user->name);
    }
}
