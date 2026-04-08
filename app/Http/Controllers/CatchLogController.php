<?php

namespace App\Http\Controllers;

use App\Models\CatchLog;
use App\Models\FisherProfile;
use Illuminate\Http\Request;

class CatchLogController extends Controller
{
    public function index()
    {
        $logs = CatchLog::with('fisherProfile.user')->latest()->get();
        $fishermen = FisherProfile::with('user')->get(); // For the dropdown in the form
        return view('catch-log.index', compact('logs', 'fishermen'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fisher_profile_id' => 'required|exists:fisher_profiles,id',
            'species' => 'required|string',
            'weight_kg' => 'required|numeric',
            'quality_grade' => 'required',
            'date_caught' => 'required|date',
        ]);

        CatchLog::create($request->all() + ['status' => 'pending']);

        return redirect()->route('catch-log.index')->with('success', 'Catch logged successfully!');
    }
}