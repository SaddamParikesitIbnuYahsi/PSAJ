@extends('layouts.dashboard')

@section('title', 'Daftar Manifest Keberangkatan')

@section('content')
    {{-- Header --}}
    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-black text-slate-800 flex items-center gap-3">
                <span class="p-2 bg-amber-100 text-amber-600 rounded-xl">
                    <i class="fas fa-plane-departure"></i>
                </span>
                Manifest Keberangkatan Jamaah
            </h2>
            <p class="text-sm text-slate-500 font-medium italic mt-1">Daftar jamaah yang dijadwalkan untuk berangkat</p>
        </div>
        <nav class="flex px-4 py-2 bg-white rounded-xl shadow-sm border border-slate-50 text-xs font-bold uppercase tracking-widest text-slate-400">
            <a href="{{ route('staff.dashboard') }}" class="hover:text-emerald-600">Portal</a>
            <i class="fas fa-chevron-right mx-3 text-[10px]"></i>
            <span class="text-amber-600">List Keberangkatan</span>
        </nav>
    </div>

    @if (session('success'))
        <div class="p-4 mb-6 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 rounded-r-xl shadow-sm font-bold flex items-center">
            <i class="fas fa-check-circle mr-3"></i> {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-8">
            {{-- Form Pencarian dan Filter --}}
            <form action="{{ route('staff.stock.outgoing.list') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                <div class="md:col-span-2 relative">
                    <i class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 fas fa-search text-sm"></i>
                    <input type="text" name="search" id="search"
                           class="w-full pl-11 pr-4 py-3 bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-amber-500 text-sm"
                           placeholder="Cari nama jamaah atau grup..."
                           value="{{ $search ?? '' }}">
                </div>

                <div>
                    <select name="status" id="status"
                            class="w-full px-4 py-3 bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-amber-500 text-sm font-bold text-slate-600">
                        <option value="semua" {{ ($selectedStatus ?? 'semua') == 'semua' ? 'selected' : '' }}>Semua Status</option>
                        <option value="pending" {{ ($selectedStatus ?? '') == 'pending' ? 'selected' : '' }}>Tertunda (Pending)</option>
                        <option value="completed" {{ ($selectedStatus ?? '') == 'completed' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>

                <button type="submit" class="w-full px-5 py-3 text-sm font-bold text-white bg-slate-900 hover:bg-slate-800 rounded-xl transition shadow-lg">
                    <i class="fas fa-filter mr-2"></i> Filter Data
                </button>
            </form>

            {{-- Tabel Data --}}
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-[11px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50">
                            <th class="px-4 py-4">Nama Jamaah / Paket</th>
                            <th class="px-4 py-4 text-center">Pax (Seat)</th>
                            <th class="px-4 py-4">Tujuan / Catatan</th>
                            <th class="px-4 py-4">Status</th>
                            <th class="px-4 py-4">Tgl Keberangkatan</th>
                            <th class="px-4 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($transactions as $transaction)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-4 py-4">
                                    <div class="text-sm font-bold text-slate-800">{{ optional($transaction->product)->name ?? 'N/A' }}</div>
                                    <div class="text-[10px] text-amber-600 font-bold uppercase">ID: {{ optional($transaction->product)->sku ?? '-' }}</div>
                                </td>
                                <td class="px-4 py-4 text-center">
                                    <span class="px-3 py-1 bg-slate-100 rounded-lg text-sm font-black text-slate-700">
                                        {{ $transaction->quantity }} Org
                                    </span>
                                </td>
                                <td class="px-4 py-4 text-sm text-slate-500 italic">
                                    {{ Str::limit($transaction->notes, 30) ?? 'Grup Reguler' }}
                                </td>
                                <td class="px-4 py-4">
                                    @php
                                        $statusColor = $transaction->status == 'completed' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700';
                                    @endphp
                                    <span class="px-3 py-1 text-[10px] font-black uppercase tracking-widest rounded-full {{ $statusColor }}">
                                        {{ $transaction->status }}
                                    </span>
                                </td>
                                <td class="px-4 py-4 text-xs font-bold text-slate-400">
                                    {{ \Carbon\Carbon::parse($transaction->date)->format('d M Y') }}
                                </td>
                                <td class="px-4 py-4 text-right">
                                    @if($transaction->status == 'pending')
                                        <a href="{{ route('staff.stock.outgoing.prepare', $transaction) }}" 
                                           class="px-5 py-2 text-[10px] font-black uppercase bg-amber-500 text-white rounded-lg hover:bg-amber-600 transition shadow-md shadow-amber-100">
                                            Proses
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-16 text-center">
                                    <i class="fas fa-inbox text-4xl text-slate-100 mb-4 block"></i>
                                    <p class="text-sm font-bold text-slate-400">Data keberangkatan tidak ditemukan.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-8">
                {{ $transactions->links() }}
            </div>
        </div>
    </div>
@endsection