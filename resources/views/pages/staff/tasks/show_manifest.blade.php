@extends('layouts.dashboard')

@section('title', 'Rincian Jamaah: ' . $product->name)

@section('content')
<div class="mb-8 flex items-center justify-between">
    <div>
        <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tighter">Rincian Manifest Jamaah</h2>
        <p class="text-sm text-slate-500 font-medium">Data lengkap pendaftaran dan status keberangkatan</p>
    </div>
    <div class="flex gap-3">
        <button onclick="window.print()" class="px-6 py-3 bg-slate-900 text-white font-bold rounded-2xl shadow-lg hover:bg-slate-800 transition flex items-center gap-2">
            <i class="fas fa-print"></i> Cetak Kartu
        </button>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2 space-y-8">
        <!-- Card Data Diri -->
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100">
            <h3 class="text-xs font-black uppercase tracking-[0.2em] text-emerald-600 mb-8 border-l-4 border-emerald-600 pl-4">Informasi Identitas</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Nama Lengkap</label>
                    <p class="text-sm font-bold text-slate-800">{{ $product->name }}</p>
                </div>
                <div>
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">No. Registrasi / SKU</label>
                    <p class="text-sm font-mono font-black text-emerald-600">{{ $product->sku }}</p>
                </div>
                <div>
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Program Paket</label>
                    <p class="text-sm font-bold text-slate-800">{{ $product->category->name ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Agen / Cabang</label>
                    <p class="text-sm font-bold text-slate-800">{{ $product->supplier->name ?? 'Kantor Pusat' }}</p>
                </div>
            </div>
        </div>

        <!-- Jurnal Riwayat -->
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
            <div class="px-8 py-5 border-b border-slate-50 bg-slate-50/30">
                <h3 class="text-sm font-black text-slate-800 uppercase tracking-widest">Log Aktivitas Jamaah</h3>
            </div>
            <div class="p-4">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-[10px] font-black text-slate-400 uppercase tracking-widest">
                            <th class="px-4 py-3">Waktu</th>
                            <th class="px-4 py-3">Aktivitas</th>
                            <th class="px-4 py-3 text-right">Petugas</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($product->stockTransactions as $log)
                            <tr>
                                <td class="px-4 py-4 text-xs font-bold text-slate-500">{{ $log->created_at->format('d/m/Y H:i') }}</td>
                                <td class="px-4 py-4 text-xs font-black uppercase text-emerald-600">{{ $log->type }}</td>
                                <td class="px-4 py-4 text-xs font-bold text-slate-500 text-right">{{ $log->user->name ?? 'System' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Kolom Kanan: Foto -->
    <div class="lg:col-span-1 space-y-8">
        <div class="bg-white p-6 rounded-[2.5rem] shadow-sm border border-slate-100 text-center">
            <div class="w-full aspect-square rounded-[2rem] overflow-hidden mb-6 border-4 border-emerald-50">
                <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://ui-avatars.com/api/?name='.urlencode($product->name).'&background=10b981&color=fff' }}" class="w-full h-full object-cover">
            </div>
            <span class="px-4 py-1.5 bg-emerald-100 text-emerald-700 text-[10px] font-black rounded-full uppercase">Status: {{ $product->current_stock > 0 ? 'Aktif' : 'Terbang' }}</span>
        </div>
    </div>
</div>
@endsection