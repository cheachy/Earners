@extends('layouts.app')

@section('content')
<div class="p-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-8">Payout Ledger</h2>

    <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-400 text-xs uppercase font-bold border-b">
                <tr>
                    <th class="px-6 py-4">Fisherman</th>
                    <th class="px-6 py-4">Verified Weight</th>
                    <th class="px-6 py-4">Total Amount</th>
                    <th class="px-6 py-4">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($payouts as $payout)
                <tr>
                    <td class="px-6 py-4 font-bold text-gray-800">{{ $payout->catchLog->fisherProfile->user->name }}</td>
                    <td class="px-6 py-4 text-gray-500">{{ $payout->catchLog->weight_kg }} kg</td>
                    <td class="px-6 py-4 font-black text-green-700 text-lg">₱{{ number_format($payout->total_amount, 2) }}</td>
                    <td class="px-6 py-4">
                        <form action="{{ route('payouts.notify', $payout->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded font-bold text-xs shadow-sm flex items-center space-x-2">
                                <i class="fa-solid fa-paper-plane"></i>
                                <span>Send Payout SMS</span>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection