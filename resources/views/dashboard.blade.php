@extends('layouts.app')

@section('content')
<div class="p-8 space-y-10">

    <!-- STATS CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-xl shadow-sm border flex justify-between items-center">
            <div>
                <p class="text-gray-500 font-bold">Today's Total Catch <span class="text-xs font-normal">(kg)</span></p>
                <h3 class="text-4xl font-black text-slate-800">{{ number_format($totalCatchToday) }}kg</h3>
            </div>
            <i class="fa-solid fa-fish text-4xl text-blue-300"></i>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border flex justify-between items-center">
            <div>
                <p class="text-gray-500 font-bold">Active Fishers Today</p>
                <h3 class="text-4xl font-black text-slate-800">{{ $activeFishers }} <span class="text-xl text-gray-300">/ {{ $totalFishers }}</span></h3>
            </div>
            <i class="fa-solid fa-user-tie text-4xl text-blue-300"></i>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border flex justify-between items-center">
            <div>
                <p class="text-gray-500 font-bold">Total Payouts Disbursed <span class="text-xs font-normal">(₱)</span></p>
                <h3 class="text-4xl font-black text-slate-800">₱{{ number_format($totalPayouts) }}</h3>
            </div>
            <div class="bg-blue-100 p-3 rounded-full">
                <i class="fa-solid fa-sack-dollar text-2xl text-blue-600"></i>
            </div>
        </div>
    </div>

    <!-- INCOMING SMS LOGS -->
    <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
        <div class="p-4 border-b bg-gray-50"><h3 class="font-bold text-slate-700">Incoming SMS Logs</h3></div>
        <table class="w-full text-left">
            <thead class="text-xs text-gray-400 uppercase font-bold border-b">
                <tr>
                    <th class="px-6 py-3">Fisherman Name</th>
                    <th class="px-6 py-3">Declared Weight</th>
                    <th class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @foreach($pendingSms as $log)
                <tr>
                    <td class="px-6 py-4 font-medium">{{ $log->fisherProfile->user->name }}</td>
                    <td class="px-6 py-4">{{ $log->declared_weight }} kg</td>
                    <td class="px-6 py-4">
                        <form action="{{ route('catch-log.acknowledge', $log->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded text-sm font-bold">Acknowledge via SMS</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- DOCK WEIGH-IN & PAYOUT -->
    <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
        <div class="p-4 border-b bg-gray-50"><h3 class="font-bold text-slate-700">Dock Weigh-In & Payout</h3></div>
        <table class="w-full text-left">
            <thead class="text-xs text-gray-400 uppercase font-bold border-b">
                <tr>
                    <th class="px-6 py-3">Fisherman Name</th>
                    <th class="px-6 py-3">Expected Weight</th>
                    <th class="px-6 py-3">Actual Scale Weight</th>
                    <th class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @foreach($weighInList as $log)
                <tr>
                    <td class="px-6 py-4 font-medium">{{ $log->fisherProfile->user->name }}</td>
                    <td class="px-6 py-4 font-bold text-gray-400">{{ $log->declared_weight }} kg</td>
                    <td class="px-6 py-4">
                        <form action="{{ route('catch-log.finalize', $log->id) }}" method="POST" class="flex items-center space-x-2">
                            @csrf
                            <input type="number" name="actual_weight" class="border rounded p-2 w-32" placeholder="0.00">
                            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded text-sm font-bold">Finalize & Pay Cash</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection