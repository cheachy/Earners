@extends('layouts.app')

@section('content')
    <!-- TOP STATS -->
    <div class="grid grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 text-center">
            <h3 class="text-gray-500 font-semibold mb-2">Total Catch</h3>
            <p class="text-4xl font-bold text-slate-800">{{ number_format($totalCatch) }} <span class="text-2xl">kg</span></p>
        </div>
        <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 text-center">
            <h3 class="text-gray-500 font-semibold mb-2">Available Ice</h3>
            <p class="text-4xl font-bold text-slate-800">3,200 <span class="text-2xl">kg</span></p>
        </div>
        <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 text-center">
            <h3 class="text-gray-500 font-semibold mb-2">Market Price</h3>
            <p class="text-4xl font-bold text-slate-800">$ {{ number_format($marketPrice, 2) }} <span class="text-2xl">/ kg</span></p>
        </div>
    </div>

    <!-- PROGRESS BAR -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 mb-8">
        <h3 class="font-bold text-gray-700 mb-4">Consolidation Logistics Target</h3>
        <div class="w-full bg-gray-200 rounded-full h-8 relative overflow-hidden">
            <div class="bg-orange-500 h-full flex items-center justify-center text-white font-bold text-sm" style="width: 84%">
                84%
            </div>
        </div>
        <p class="text-center mt-2 text-gray-500 text-sm font-medium">21,000 kg / 25,000 kg</p>
    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-50">
            <h3 class="font-bold text-gray-700">Payout Ledger</h3>
        </div>
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-500 text-sm uppercase">
                <tr>
                    <th class="px-6 py-4">Fisherman</th>
                    <th class="px-6 py-4">Catch (kg)</th>
                    <th class="px-6 py-4">Rate $/kg</th>
                    <th class="px-6 py-4">Total Payout</th>
                    <th class="px-6 py-4">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($payouts as $payout)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-medium">{{ $payout->catchLog->fisherProfile->user->name }}</td>
                    <td class="px-6 py-4">{{ $payout->catchLog->weight_kg }}</td>
                    <td class="px-6 py-4">${{ number_format($payout->price_per_kg, 2) }}</td>
                    <td class="px-6 py-4 font-bold">${{ number_format($payout->total_amount, 2) }}</td>
                    <td class="px-6 py-4">
                        <button class="bg-[#4CAF50] text-white px-6 py-2 rounded-lg font-bold shadow-md hover:bg-green-600 transition">
                            Send SMS
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection