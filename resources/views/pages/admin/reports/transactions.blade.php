@extends('layouts.dashboard')

@section('title', 'Laporan Aktivitas Jamaah')

@section('content')
<div class="bg-white rounded-[2rem] shadow-sm overflow-hidden border border-slate-100">

    <div class="p-8 border-b border-slate-50 bg-slate-50/30">
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
            <div>
                <h2 class="text-2xl font-black text-slate-800">Riwayat Aktivitas Jamaah</h2>
                <p class="mt-1 text-sm text-slate-500 font-medium italic">Detail data pendaftaran dan keberangkatan jamaah.</p>
            </div>

            <form method="GET" class="flex flex-wrap items-center gap-3">
                <select name="type" class="px-4 py-2.5 text-sm font-bold bg-white border-none rounded-xl shadow-inner focus:ring-2 focus:ring-emerald-500">
                    <option value="">-- Semua Aktivitas --</option>
                    <option value="Masuk" {{ request('type') == 'Masuk' ? 'selected' : '' }}>Pendaftaran</option>
                    <option value="Keluar" {{ request('type') == 'Keluar' ? 'selected' : '' }}>Keberangkatan</option>
                </select>
                <input type="date" name="from" value="{{ request('from') }}" class="px-4 py-2.5 text-sm bg-white border-none rounded-xl shadow-inner focus:ring-2 focus:ring-emerald-500">
                <input type="date" name="to" value="{{ request('to') }}" class="px-4 py-2.5 text-sm bg-white border-none rounded-xl shadow-inner focus:ring-2 focus:ring-emerald-500">

                <button type="submit" class="bg-slate-900 text-white px-6 py-2.5 text-sm font-bold rounded-xl hover:bg-slate-800 transition shadow-lg">
                    <i class="fas fa-filter mr-1"></i> Filter
                </button>
            </form>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-slate-50/50">
                <tr class="text-[11px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50">
                    <th class="px-8 py-5">Jamaah / Paket</th>
                    <th class="px-8 py-5">Jenis Aktivitas</th>
                    <th class="px-8 py-5 text-center">Jumlah Pax</th>
                    <th class="px-8 py-5">Staf Penanggung Jawab</th>
                    <th class="px-8 py-5">Tanggal & Waktu</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($transactions as $trx)
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="px-8 py-5 font-bold text-slate-800 text-sm">{{ $trx->product->name ?? '-' }}</td>
                        <td class="px-8 py-5">
                             @if($trx->type == 'Masuk')
                                <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-[10px] font-black rounded-full uppercase tracking-tighter">
                                    <i class="fas fa-user-plus mr-1"></i> Pendaftaran
                                </span>
                            @else
                                <span class="px-3 py-1 bg-amber-100 text-amber-700 text-[10px] font-black rounded-full uppercase tracking-tighter">
                                    <i class="fas fa-plane-departure mr-1"></i> Keberangkatan
                                </span>
                            @endif
                        </td>
                        <td class="px-8 py-5 text-center font-black {{ $trx->type == 'Masuk' ? 'text-emerald-600' : 'text-amber-600' }}">
                            {{ $trx->type == 'Masuk' ? '+' : '-' }}{{ $trx->quantity }} Pax
                        </td>
                        <td class="px-8 py-5 text-sm font-bold text-slate-500">{{ $trx->user->name ?? '-' }}</td>
                        <td class="px-8 py-5 text-[11px] font-bold text-slate-400 uppercase">
                            {{ $trx->date ? \Carbon\Carbon::parse($trx->date)->format('d M Y, H:i') : '-' }} WIB
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="py-20 text-center text-slate-400 font-bold italic text-sm">Tidak ada riwayat aktivitas ditemukan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-8 border-t border-slate-50">{{ $transactions->withQueryString()->links() }}</div>
</div>
@endsection