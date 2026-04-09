<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\FisherProfile;
use App\Models\CatchLog;

class SmsWebhookController extends Controller
{
    public function handle(Request $request)
    {
        // This logs a simple message to prove the code is running
        info("--- WEBHOOK TEST START ---");
        
        // This logs EVERYTHING Textbee sent
        info("Raw Data: " . json_encode($request->all()));

        return response()->json(['status' => 'success'], 200);
    }
}