@extends('layouts.app')

@section('content')
<div class="p-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-8">Payout Ledger</h2>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-400 text-xs uppercase font-bold">
                <tr>
                    <th class="px-6 py-4">Fisherman</th>
                    <th class="px-6 py-4">Contact</th>
                    <th class="px-6 py-4">Total Amount</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($payouts as $payout)
                <tr>
                    <td class="px-6 py-4 font-bold text-gray-800">{{ $payout->catchLog->fisherProfile->user->name }}</td>
                    <td class="px-6 py-4 text-gray-500">{{ $payout->catchLog->fisherProfile->contact_number }}</td>
                    <td class="px-6 py-4 font-bold text-blue-700">₱{{ number_format($payout->total_amount, 2) }}</td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-xs font-bold {{ $payout->payout_status == 'paid' ? 'bg-green-100 text-green-700' : 'bg-orange-100 text-orange-700' }}">
                            {{ strtoupper($payout->payout_status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <button class="bg-[#4CAF50] text-white px-4 py-2 rounded-lg text-sm font-bold shadow-md hover:bg-green-600 transition">
                            Send SMS Notification
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection