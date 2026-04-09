<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FisherProfile;
use App\Models\CatchLog;
use Illuminate\Support\Facades\Log;

class SmsWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $senderNumber = $request->input('sender'); // e.g., +639667266141
        $message = $request->input('message');

        // 1. CLEAN THE NUMBER (Convert +63 to 0)
        $cleanNumber = $senderNumber;
        if (str_starts_with($senderNumber, '+63')) {
            $cleanNumber = '0' . substr($senderNumber, 3);
        }

        // 2. FIND FISHERMAN (Search for both versions)
        $profile = \App\Models\FisherProfile::with('user')
            ->where('contact_number', $cleanNumber)
            ->orWhere('contact_number', $senderNumber)
            ->first();

        if ($profile) {
            // 3. EXTRACT WEIGHT
            preg_match('/(\d+(\.\d+)?)/', $message, $matches);
            $weight = isset($matches[0]) ? (float)$matches[0] : 0;

            // 4. DUPLICATE CHECK (Check if this exact weight was logged in last 2 mins)
            $isDuplicate = CatchLog::where('fisher_profile_id', $profile->id)
                ->where('declared_weight', $weight)
                ->where('created_at', '>=', now()->subMinutes(2))
                ->exists();

            if ($isDuplicate) {
                info("Duplicate ignored from " . $profile->user->name);
                return response()->json(['status' => 'duplicate']);
            }

            // 5. SAVE CATCH
            CatchLog::create([
                'fisher_profile_id' => $profile->id,
                'species' => 'Tuna',
                'declared_weight' => $weight,
                'status' => 'pending',
                'date_caught' => now(),
            ]);

            info("SUCCESS: Logged {$weight}kg for " . $profile->user->name);
        } else {
            // If it gets here, the dashboard won't update because the number doesn't match
            info("FAILED: No fisherman found for " . $senderNumber . " or " . $cleanNumber);
        }

        return response()->json(['status' => 'success']);
    }
}