@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-8">
    <h2 class="text-2xl font-bold text-gray-800">Catch Log</h2>
    <button class="bg-[#0047AB] text-white px-6 py-2 rounded-lg font-bold shadow-md">+ Log New Catch</button>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-gray-50 text-gray-500 text-sm uppercase">
            <tr>
                <th class="px-6 py-4">Date</th>
                <th class="px-6 py-4">Fisherman</th>
                <th class="px-6 py-4">Species</th>
                <th class="px-6 py-4">Weight (kg)</th>
                <th class="px-6 py-4">Grade</th>
                <th class="px-6 py-4">Status</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @foreach($logs as $log)
            <tr>
                <td class="px-6 py-4 text-gray-500">{{ $log->date_caught->format('M d, Y') }}</td>
                <td class="px-6 py-4 font-medium">{{ $log->fisherProfile->user->name }}</td>
                <td class="px-6 py-4">{{ $log->species }}</td>
                <td class="px-6 py-4 font-bold">{{ $log->weight_kg }} kg</td>
                <td class="px-6 py-4"><span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold">{{ $log->quality_grade }}</span></td>
                <td class="px-6 py-4">
                    <span class="text-xs font-bold uppercase {{ $log->status == 'sold' ? 'text-green-500' : 'text-orange-500' }}">
                        {{ $log->status }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection