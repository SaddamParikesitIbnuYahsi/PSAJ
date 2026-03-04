@extends('layouts.dashboard')

@section('title', 'Ringkasan Sistem Umroh')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-black text-slate-800 flex items-center gap-3">
        <span class="p-2 bg-emerald-600 text-white rounded-xl shadow-lg shadow-emerald-100"><i class="fas fa-database"></i></span>
        Dashboard Statistik Sistem
    </h1>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
    @foreach($systemData as $label => $value)
    <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 transition hover:-translate-y-2 hover:shadow-xl group">
        <div class="flex items-center justify-between mb-6">
            <div class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em]">{{ ucwords(str_replace('_', ' ', $label)) }}</div>
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 group-hover:bg-emerald-600 flex items-center justify-center text-emerald-600 group-hover:text-white transition-colors text-xl font-black">
                {{ substr($label, 0, 1) }}
            </div>
        </div>
        <div class="text-4xl font-black text-slate-800 group-hover:text-emerald-600 transition-colors">{{ $value }}</div>
        <div class="mt-4 pt-4 border-t border-slate-50 flex items-center justify-between">
            <span class="text-[10px] font-bold text-slate-400 uppercase italic">Data Terverifikasi</span>
            <i class="fas fa-check-circle text-emerald-500"></i>
        </div>
    </div>
    @endforeach
</div>
@endsection