@extends('layouts.dashboard')

@section('title', 'Laporan Kuota Seat Paket')

@section('content')
<div class="overflow-hidden bg-white border border-slate-100 rounded-[2rem] shadow-sm dark:bg-gray-800 dark:border-gray-700">

    {{-- Card Header: Title & Filters --}}
    <div class="p-8 border-b border-slate-50 dark:border-gray-700 bg-slate-50/30">
        <div class="flex flex-col items-start justify-between lg:flex-row lg:items-center gap-6">
            <div>
                <h2 class="text-2xl font-black text-slate-800 dark:text-white flex items-center gap-2">
                    <i class="fas fa-chart-pie text-emerald-600"></i> Laporan Kuota Seat
                </h2>
                <p class="mt-1 text-sm text-slate-500 font-medium italic">
                    Analisis ketersediaan seat berdasarkan program paket umroh.
                </p>
            </div>

            <form method="GET" class="flex flex-wrap items-center gap-3 w-full lg:w-auto">
                <select name="category_id" class="px-4 py-2.5 text-sm font-bold text-slate-600 bg-white border-none rounded-xl shadow-inner focus:ring-2 focus:ring-emerald-500 w-full md:w-52">
                    <option value="">-- Semua Program --</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
                <select name="stock_status" class="px-4 py-2.5 text-sm font-bold text-slate-600 bg-white border-none rounded-xl shadow-inner focus:ring-2 focus:ring-emerald-500 w-full md:w-44">
                    <option value="">-- Semua Status --</option>
                    <option value="low" {{ request('stock_status') === 'low' ? 'selected' : '' }}>Kuota Menipis</option>
                    <option value="out" {{ request('stock_status') === 'out' ? 'selected' : '' }}>Kuota Penuh</option>
                    <option value="safe" {{ request('stock_status') === 'safe' ? 'selected' : '' }}>Kuota Aman</option>
                </select>

                <div class="flex items-center gap-2 w-full md:w-auto">
                    <button type="submit" class="flex-1 md:flex-none bg-emerald-600 text-white px-6 py-2.5 text-sm font-black rounded-xl hover:bg-emerald-700 shadow-lg shadow-emerald-100 transition">
                        Filter
                    </button>
                    <a href="{{ route('admin.reports.stock') }}" class="text-xs font-bold text-slate-400 hover:text-emerald-600">Reset</a>
                </div>
            </form>
        </div>
    </div>

    {{-- Summary Cards --}}
    <div class="grid grid-cols-1 gap-6 p-8 md:grid-cols-4 bg-white dark:bg-gray-800">
        <div class="p-5 rounded-3xl bg-slate-50 border border-slate-100">
            <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Paket</h3>
            <p class="mt-1 text-2xl font-black text-slate-800">{{ $products->total() }}</p>
        </div>
        <div class="p-5 rounded-3xl bg-emerald-50 border border-emerald-100">
            <h3 class="text-[10px] font-black text-emerald-700 uppercase tracking-widest">Seat Aman</h3>
            <p class="mt-1 text-2xl font-black text-emerald-600">{{ $stockSummary['safe'] }}</p>
        </div>
        <div class="p-5 rounded-3xl bg-amber-50 border border-amber-100">
            <h3 class="text-[10px] font-black text-amber-700 uppercase tracking-widest">Hampir Penuh</h3>
            <p class="mt-1 text-2xl font-black text-amber-600">{{ $stockSummary['low'] }}</p>
        </div>
        <div class="p-5 rounded-3xl bg-red-50 border border-red-100">
            <h3 class="text-[10px] font-black text-red-700 uppercase tracking-widest">Penuh/Sold Out</h3>
            <p class="mt-1 text-2xl font-black text-red-600">{{ $stockSummary['out'] }}</p>
        </div>
    </div>

    {{-- Table Section --}}
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-slate-50/50">
                <tr class="text-[11px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50">
                    <th class="px-8 py-5">Identitas Paket</th>
                    <th class="px-8 py-5">Program</th>
                    <th class="px-8 py-5 text-center">Sisa Seat</th>
                    <th class="px-8 py-5 text-center">Batas Min</th>
                    <th class="px-8 py-5 text-center">Selisih</th>
                    <th class="px-8 py-5">Status Kuota</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($products as $product)
                    @php $difference = $product->current_stock - $product->min_stock; @endphp
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="px-8 py-5">
                            <div class="flex items-center">
                                <div class="w-10 h-10 mr-4 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 font-bold uppercase">
                                    {{ substr($product->name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="text-sm font-black text-slate-800">{{ $product->name }}</div>
                                    <div class="text-[10px] font-bold text-slate-400 font-mono tracking-tighter">{{ $product->sku }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-5 text-sm font-bold text-slate-500">{{ $product->category->name ?? '-' }}</td>
                        <td class="px-8 py-5 font-black text-center text-slate-800">{{ $product->current_stock }} Pax</td>
                        <td class="px-8 py-5 text-center text-slate-400 font-bold text-xs">{{ $product->min_stock }} Pax</td>
                        <td class="px-8 py-5 text-center font-black {{ $difference < 0 ? 'text-red-500' : 'text-emerald-500' }}">
                            {{ $difference > 0 ? '+' : '' }}{{ $difference }}
                        </td>
                        <td class="px-8 py-5">
                            @if($product->current_stock <= 0)
                                <span class="px-3 py-1 bg-red-100 text-red-700 text-[10px] font-black rounded-full uppercase italic">Sold Out</span>
                            @elseif($product->current_stock <= $product->min_stock)
                                <span class="px-3 py-1 bg-amber-100 text-amber-700 text-[10px] font-black rounded-full uppercase">Menipis</span>
                            @else
                                <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-[10px] font-black rounded-full uppercase">Tersedia</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="py-20 text-center text-slate-400 font-bold">Data kuota tidak ditemukan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection