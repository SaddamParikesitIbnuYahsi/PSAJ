@extends('layouts.dashboard')

@section('title', $reportTitle)

@section('content')
<!-- Header Section -->
<div class="mb-8">
    <nav class="flex mb-4" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-2 text-sm font-medium">
            <li class="inline-flex items-center">
                <a href="#" class="inline-flex items-center text-slate-500 transition-colors hover:text-emerald-600">
                    <i class="w-4 h-4 mr-2 fas fa-home"></i>
                    Portal Staff
                </a>
            </li>
            <li>
                <div class="flex items-center text-slate-400">
                    <i class="w-3 h-3 fas fa-chevron-right"></i>
                    <span class="ml-2 text-emerald-700 font-bold">Data Manifest Jamaah</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="relative p-8 overflow-hidden bg-gradient-to-r from-emerald-800 via-emerald-700 to-teal-700 rounded-3xl shadow-xl">
        <div class="relative z-10">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="flex items-center">
                    <div class="flex items-center justify-center w-16 h-16 mr-5 bg-white/20 rounded-2xl backdrop-blur-md border border-white/30 text-white shadow-inner">
                        <i class="text-3xl fas fa-user-check"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-black text-white tracking-tight">Riwayat Jamaah</h1>
                        <p class="text-emerald-50 text-sm font-medium opacity-90">Sistem monitoring pendaftaran dan ketersediaan kuota paket</p>
                    </div>
                </div>
                
                <div class="flex items-center space-x-3">
                    <button onclick="window.location.reload()" class="flex items-center px-4 py-2.5 text-white text-sm font-bold transition-all bg-white/10 rounded-xl backdrop-blur-md border border-white/20 hover:bg-white/20">
                        <i class="mr-2 fas fa-sync-alt"></i> Segarkan Data
                    </button>
                    <a href="{{ route('staff.reports.export', request()->query()) }}"
                       class="flex items-center px-5 py-2.5 text-emerald-900 text-sm font-bold bg-amber-400 rounded-xl shadow-lg hover:bg-amber-300">
                        <i class="mr-2 fas fa-file-excel"></i> Cetak Manifest
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Kartu Statistik (Sinkron dengan Data Admin) -->
<div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-4">
    <div class="p-6 bg-white border border-slate-100 rounded-3xl shadow-sm">
        <div class="flex items-center">
            <div class="flex items-center justify-center w-12 h-12 bg-emerald-50 rounded-2xl text-emerald-600">
                <i class="fas fa-user-friends"></i>
            </div>
            <div class="ml-4">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Jamaah</p>
                <p class="text-2xl font-black text-slate-800">{{ $totalPendaftar }}</p>
            </div>
        </div>
    </div>
    
    <div class="p-6 bg-white border border-slate-100 rounded-3xl shadow-sm">
        <div class="flex items-center">
            <div class="flex items-center justify-center w-12 h-12 bg-blue-50 rounded-2xl text-blue-600">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="ml-4">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Seat Tersedia</p>
                <p class="text-2xl font-black text-slate-800">{{ $sudahVerifikasi }}</p>
            </div>
        </div>
    </div>
    
    <div class="p-6 bg-white border border-slate-100 rounded-3xl shadow-sm border-b-4 border-amber-400">
        <div class="flex items-center">
            <div class="flex items-center justify-center w-12 h-12 bg-amber-50 rounded-2xl text-amber-600">
                <i class="fas fa-hourglass-half"></i>
            </div>
            <div class="ml-4">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Kuota Menipis</p>
                <p class="text-2xl font-black text-slate-800">{{ $prosesDokumen }}</p>
            </div>
        </div>
    </div>
    
    <div class="p-6 bg-white border border-slate-100 rounded-3xl shadow-sm border-b-4 border-red-400">
        <div class="flex items-center">
            <div class="flex items-center justify-center w-12 h-12 bg-red-50 rounded-2xl text-red-600">
                <i class="fas fa-ban"></i>
            </div>
            <div class="ml-4">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Daftar Hari Ini</p>
                <p class="text-2xl font-black text-slate-800">{{ $daftarHariIni }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Form Pencarian -->
<div class="p-8 mb-8 bg-white border border-slate-100 rounded-3xl shadow-sm">
    <form action="{{ route('staff.reports.incoming') }}" method="GET" class="grid grid-cols-1 gap-5 md:grid-cols-4">
        <div class="space-y-1.5">
            <label class="text-[11px] font-black text-slate-400 uppercase ml-1">Cari Jamaah</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama / SKU..." class="w-full px-4 py-2.5 bg-slate-50 border-none rounded-xl text-sm focus:ring-2 focus:ring-emerald-500">
        </div>
        <div class="space-y-1.5">
            <label class="text-[11px] font-black text-slate-400 uppercase ml-1">Status Kuota</label>
            <select name="status" class="w-full px-4 py-2.5 bg-slate-50 border-none rounded-xl text-sm focus:ring-2 focus:ring-emerald-500">
                <option value="">Semua Status</option>
                <option value="tersedia" {{ request('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                <option value="menipis" {{ request('status') == 'menipis' ? 'selected' : '' }}>Sisa Sedikit</option>
                <option value="penuh" {{ request('status') == 'penuh' ? 'selected' : '' }}>Penuh</option>
            </select>
        </div>
        <div class="space-y-1.5">
            <label class="text-[11px] font-black text-slate-400 uppercase ml-1">Dari Tanggal</label>
            <input type="date" name="start_date" value="{{ request('start_date') }}" class="w-full px-4 py-2.5 bg-slate-50 border-none rounded-xl text-sm focus:ring-2 focus:ring-emerald-500">
        </div>
        <div class="flex items-end space-x-2">
            <div class="flex-1 space-y-1.5">
                <label class="text-[11px] font-black text-slate-400 uppercase ml-1">Sampai</label>
                <input type="date" name="end_date" value="{{ request('end_date') }}" class="w-full px-4 py-2.5 bg-slate-50 border-none rounded-xl text-sm focus:ring-2 focus:ring-emerald-500">
            </div>
            <button type="submit" class="p-3 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 transition">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>
</div>

<!-- Tabel Manifest (Sinkron dengan Admin) -->
<div class="bg-white border border-slate-100 rounded-3xl shadow-sm overflow-hidden">
    <div class="px-8 py-5 border-b border-slate-50 bg-slate-50/30">
        <h3 class="text-lg font-black text-slate-800">List Manifest Jamaah Terkini</h3>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="text-[11px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50">
                    <th class="px-8 py-5">Identitas Jamaah</th>
                    <th class="px-8 py-5">Paket / Agen</th>
                    <th class="px-8 py-5 text-right">Biaya (IDR)</th>
                    <th class="px-8 py-5 text-center">Pax (Seat)</th>
                    <th class="px-8 py-5 text-center">Status</th>
                    <th class="px-8 py-5 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($transactions as $data)
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="px-8 py-5">
                            <div class="flex items-center">
                                <div class="w-10 h-10 mr-4 rounded-xl overflow-hidden border-2 border-emerald-50 shadow-sm">
                                    <img src="{{ $data->image ? asset('storage/'.$data->image) : 'https://ui-avatars.com/api/?name='.urlencode($data->name).'&background=10b981&color=fff' }}" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <div class="text-sm font-black text-slate-800">{{ $data->name }}</div>
                                    <div class="text-[10px] text-slate-400 font-mono tracking-tighter uppercase">REG: {{ $data->sku ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-5">
                            <div class="text-[10px] font-black text-emerald-600 uppercase">{{ $data->category->name ?? 'N/A' }}</div>
                            <div class="text-xs font-bold text-slate-500">{{ $data->supplier->name ?? 'Pusat' }}</div>
                        </td>
                        <td class="px-8 py-5 text-right text-sm font-black text-slate-800">
                            Rp {{ number_format($data->selling_price, 0, ',', '.') }}
                        </td>
                        <td class="px-8 py-5 text-center font-black text-slate-700 text-sm">
                            {{ number_format($data->current_stock) }} Pax
                        </td>
                        <td class="px-8 py-5 text-center">
                            @if($data->current_stock <= 0)
                                <span class="px-3 py-1 bg-red-100 text-red-700 text-[9px] font-black rounded-full uppercase">Penuh</span>
                            @elseif($data->current_stock <= $data->min_stock)
                                <span class="px-3 py-1 bg-amber-100 text-amber-700 text-[9px] font-black rounded-full uppercase">Sisa Sedikit</span>
                            @else
                                <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-[9px] font-black rounded-full uppercase">Tersedia</span>
                            @endif
                        </td>
                        <td class="px-8 py-5">
                            <div class="flex items-center justify-center gap-2">
                                <a href="#" class="p-2 text-slate-400 hover:text-emerald-600 transition" title="Lihat Detail"><i class="fas fa-eye"></i></a>
                                <a href="#" class="p-2 text-slate-400 hover:text-blue-600 transition" title="Cetak Kartu"><i class="fas fa-print"></i></a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-8 py-20 text-center text-slate-400 font-bold">
                            Belum ada jamaah yang terdaftar di sistem.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-8 py-5 bg-slate-50/50">
        {{ $transactions->appends(request()->query())->links() }}
    </div>
</div>
@endsection