@extends('layouts.app')

@section('content')
<div class="p-8">
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-2xl font-bold text-gray-800">Inventory Tracking</h2>
        <button class="bg-[#0047AB] text-white px-6 py-2 rounded-lg font-bold shadow-md">+ Add Item</button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($items as $item)
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 border-t-4 border-t-[#0047AB]">
            <h3 class="text-gray-500 text-sm font-bold uppercase mb-2">{{ $item->item_name }}</h3>
            <div class="flex items-baseline space-x-2">
                <span class="text-4xl font-black text-gray-800">{{ number_format($item->quantity) }}</span>
                <span class="text-xl text-gray-400 font-bold">{{ $item->unit }}</span>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-50 flex justify-between">
                <button class="text-[#0047AB] font-bold text-xs uppercase">Restock</button>
                <button class="text-red-400 font-bold text-xs uppercase">History</button>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection