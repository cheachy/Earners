@extends('layouts.app')

@section('content')
<div class="p-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-8">Catch History</h2>

    <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-400 text-xs uppercase font-bold border-b">
                <tr>
                    <th class="px-6 py-4">Date</th>
                    <th class="px-6 py-4">Fisherman</th>
                    <th class="px-6 py-4">SMS Declared</th>
                    <th class="px-6 py-4">Actual Weight</th>
                    <th class="px-6 py-4">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($logs as $log)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 text-sm">{{ $log->created_at->format('M d, Y') }}</td>
                    <td class="px-6 py-4 font-bold text-gray-800">{{ $log->fisherProfile->user->name }}</td>
                    <td class="px-6 py-4 text-blue-600 font-medium">{{ $log->declared_weight ?? 0 }} kg</td>
                    <td class="px-6 py-4 font-bold text-slate-700">
                        {{ $log->weight_kg ? $log->weight_kg . ' kg' : '---' }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-xs font-bold 
                            {{ $log->status == 'finalized' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700' }}">
                            {{ strtoupper($log->status) }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection