@extends('layouts.dashboard')

@section('title', 'Laporan Riwayat Keberangkatan Jamaah')

@section('content')
<!-- Header Section -->
<div class="mb-8">
    <nav class="flex mb-4" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-2 text-sm font-medium text-[10px] uppercase tracking-widest font-black">
            <li class="inline-flex items-center">
                <a href="{{ route('staff.dashboard') }}" class="text-slate-500 hover:text-emerald-600 transition">
                    <i class="w-4 h-4 mr-2 fas fa-home"></i> PORTAL STAFF
                </a>
            </li>
            <li>
                <div class="flex items-center text-slate-400">
                    <i class="w-3 h-3 fas fa-chevron-right mx-2"></i>
                    <span class="text-emerald-700">RIWAYAT KEBERANGKATAN</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Page Header Premium -->
    <div class="relative p-10 overflow-hidden bg-gradient-to-br from-slate-900 via-emerald-900 to-emerald-800 rounded-[3rem] shadow-2xl">
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
            <div class="flex items-center">
                <div class="flex items-center justify-center w-20 h-20 mr-6 bg-white/10 rounded-[2rem] backdrop-blur-md border border-white/20 text-white shadow-inner">
                    <i class="text-4xl fas fa-plane-departure"></i>
                </div>
                <div>
                    <h1 class="text-4xl font-black text-white tracking-tighter uppercase">Jurnal Penerbangan</h1>
                    <p class="text-emerald-100 text-sm font-medium opacity-80 italic">Arsip manifes jamaah yang telah diproses keberangkatannya</p>
                </div>
            </div>
            
            <div class="flex items-center space-x-3">
                <button onclick="window.location.reload()" class="flex items-center px-6 py-3 text-white text-xs font-black uppercase tracking-widest transition-all bg-white/10 rounded-2xl backdrop-blur-md border border-white/10 hover:bg-white/20">
                    <i class="mr-2 fas fa-sync-alt"></i> Refresh
                </button>
                <a href="{{ route('staff.reports.departures.export', request()->query()) }}" class="flex items-center px-8 py-3 text-emerald-900 text-xs font-black uppercase tracking-widest bg-amber-400 rounded-2xl shadow-xl shadow-amber-900/20 hover:bg-amber-300 transition-transform hover:scale-105">
                    <i class="mr-2 fas fa-file-excel"></i> Export Excel
                </a>
            </div>
        </div>
        <i class="fas fa-kaaba absolute -right-20 -bottom-20 text-[25rem] text-white/5 rotate-12"></i>
    </div>
</div>

<!-- Statistik Kartu -->
<div class="grid grid-cols-1 gap-6 mb-10 md:grid-cols-4">
    <div class="p-8 bg-white border border-slate-100 rounded-[2.5rem] shadow-sm group hover:shadow-md transition">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white transition shadow-sm"><i class="fas fa-passport text-xl"></i></div>
            <span class="text-[10px] font-black text-slate-300 uppercase tracking-widest">Total</span>
        </div>
        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Jamaah Terbang</p>
        <p class="text-3xl font-black text-slate-800 tracking-tighter">{{ number_format($transactions->total()) }} <span class="text-sm text-slate-400 font-bold uppercase">Pax</span></p>
    </div>
</div>

<!-- Tabel Manifest Keberangkatan -->
<div class="bg-white border border-slate-100 rounded-[3rem] shadow-sm overflow-hidden">
    <div class="px-10 py-6 border-b border-slate-50 bg-slate-50/30 flex items-center justify-between">
        <h3 class="text-sm font-black text-slate-800 uppercase tracking-[0.2em]">Riwayat Log Keberangkatan</h3>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="text-[11px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50">
                    <th class="px-10 py-6">Tgl Terbang</th>
                    <th class="px-10 py-6">Identitas Jamaah</th>
                    <th class="px-10 py-6 text-center">Pax (Seat)</th>
                    <th class="px-10 py-6">Status</th>
                    <th class="px-10 py-6 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($transactions as $transaction)
                    <tr class="hover:bg-slate-50/80 transition group">
                        <td class="px-10 py-6">
                            <div class="text-sm font-black text-slate-800">{{ \Carbon\Carbon::parse($transaction->date)->format('d M Y') }}</div>
                        </td>
                        <td class="px-10 py-6">
                            <div class="flex items-center">
                                <div class="w-10 h-10 mr-4 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 font-black text-xs group-hover:bg-emerald-600 group-hover:text-white transition-all shadow-sm">
                                    {{ substr(optional($transaction->product)->name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="text-sm font-black text-slate-800">{{ optional($transaction->product)->name ?? 'N/A' }}</div>
                                    <div class="text-[10px] text-slate-400 uppercase">Reg: {{ optional($transaction->product)->sku ?? '-' }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-10 py-6 text-center font-black text-slate-700 text-sm">
                            {{ number_format($transaction->quantity) }} Org
                        </td>
                        <td class="px-10 py-6">
                            <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-[10px] font-black rounded-full uppercase">Selesai</span>
                        </td>
                        <td class="px-10 py-6 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('staff.manifest.show', $transaction->product_id) }}" class="p-2.5 text-slate-400 hover:text-emerald-600 transition hover:bg-emerald-50 rounded-xl shadow-sm" title="Lihat Profil Jamaah">
                                    <i class="fas fa-eye"></i>
                                </a>
                                {{-- BUTTON PRINTER DIUBAH DISINI --}}
                                <a href="{{ route('staff.manifest.print', $transaction->product_id) }}" target="_blank" class="p-2.5 text-slate-400 hover:text-blue-600 transition hover:bg-blue-50 rounded-xl shadow-sm" title="Cetak Manifes">
                                    <i class="fas fa-print"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-10 py-24 text-center text-slate-400 font-black uppercase opacity-20">Belum ada riwayat penerbangan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection