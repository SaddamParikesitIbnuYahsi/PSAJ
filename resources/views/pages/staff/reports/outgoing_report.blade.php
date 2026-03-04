@extends('layouts.dashboard')

@section('title', 'Laporan Riwayat Keberangkatan Jamaah')

@section('content')
<!-- Header Section - Tema Emerald Keberangkatan -->
<div class="mb-8">
    <!-- Breadcrumb -->
    <nav class="flex mb-4" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-2 text-sm font-medium">
            <li class="inline-flex items-center">
                <a href="{{ route('admin.dashboard') }}" 
                   class="inline-flex items-center text-slate-500 transition-colors hover:text-emerald-600">
                    <i class="w-4 h-4 mr-2 fas fa-home"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <div class="flex items-center text-slate-400">
                    <i class="w-3 h-3 fas fa-chevron-right"></i>
                    <span class="ml-2 text-emerald-700 font-bold">Riwayat Keberangkatan</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Page Header dengan Gradient Hijau-Teal -->
    <div class="relative p-8 overflow-hidden bg-gradient-to-r from-emerald-600 via-teal-600 to-cyan-600 rounded-3xl shadow-xl shadow-emerald-100">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="relative z-10">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="flex items-center">
                    <div class="flex items-center justify-center w-16 h-16 mr-5 bg-white/20 rounded-2xl backdrop-blur-md border border-white/30 text-white shadow-lg">
                        <i class="text-3xl fas fa-plane-departure"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-black text-white tracking-tight">Laporan Keberangkatan</h1>
                        <p class="text-emerald-50 text-sm font-medium opacity-90">Arsip data jamaah yang telah diproses keberangkatannya</p>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex items-center space-x-3">
                    <button onclick="refreshData()" 
                            class="flex items-center px-4 py-2.5 text-white text-sm font-bold transition-all bg-white/10 rounded-xl backdrop-blur-md border border-white/20 hover:bg-white/20">
                        <i class="mr-2 fas fa-sync-alt" id="refresh-icon"></i>
                        Refresh
                    </button>
                    <div class="relative">
                        <button onclick="toggleExportMenu()" 
                                class="flex items-center px-5 py-2.5 text-emerald-900 text-sm font-bold transition-all bg-amber-400 rounded-xl shadow-lg hover:bg-amber-300">
                            <i class="mr-2 fas fa-print"></i>
                            Export Data
                            <i class="ml-2 text-[10px] fas fa-chevron-down"></i>
                        </button>
                        <!-- Export Dropdown -->
                        <div id="export-menu" class="absolute right-0 z-50 hidden w-48 mt-3 bg-white border border-slate-100 rounded-2xl shadow-xl p-2">
                            <a href="#" onclick="exportToPDF()" class="flex items-center px-4 py-3 text-sm font-semibold text-slate-700 rounded-xl hover:bg-emerald-50 transition">
                                <i class="mr-3 text-red-500 fas fa-file-pdf"></i> PDF
                            </a>
                            <a href="#" onclick="exportToExcel()" class="flex items-center px-4 py-3 text-sm font-semibold text-slate-700 rounded-xl hover:bg-emerald-50 transition">
                                <i class="mr-3 text-green-600 fas fa-file-excel"></i> Excel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Decorations -->
        <div class="absolute -top-10 -right-10 w-40 h-40 bg-white opacity-5 rounded-full border-[20px] border-white"></div>
    </div>
</div>

<!-- Statistik Kartu -->
<div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-4">
    <div class="p-6 bg-white border border-slate-100 rounded-3xl shadow-sm hover:shadow-md transition">
        <div class="flex items-center">
            <div class="flex items-center justify-center w-12 h-12 bg-emerald-50 rounded-2xl text-emerald-600">
                <i class="fas fa-passport"></i>
            </div>
            <div class="ml-4">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Berangkat</p>
                <p class="text-2xl font-black text-slate-800">{{ $transactions->total() }}</p>
            </div>
        </div>
    </div>
    
    <div class="p-6 bg-white border border-slate-100 rounded-3xl shadow-sm hover:shadow-md transition">
        <div class="flex items-center">
            <div class="flex items-center justify-center w-12 h-12 bg-teal-50 rounded-2xl text-teal-600">
                <i class="fas fa-check-double"></i>
            </div>
            <div class="ml-4">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Siap Berangkat</p>
                <p class="text-2xl font-black text-slate-800">
                    {{ $transactions->whereIn('status', ['completed', 'dikeluarkan'])->count() }}
                </p>
            </div>
        </div>
    </div>
    
    <div class="p-6 bg-white border border-slate-100 rounded-3xl shadow-sm hover:shadow-md transition">
        <div class="flex items-center">
            <div class="flex items-center justify-center w-12 h-12 bg-amber-50 rounded-2xl text-amber-600">
                <i class="fas fa-clock"></i>
            </div>
            <div class="ml-4">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Antrean Visa</p>
                <p class="text-2xl font-black text-slate-800">
                    {{ $transactions->where('status', 'pending')->count() }}
                </p>
            </div>
        </div>
    </div>
    
    <div class="p-6 bg-white border border-slate-100 rounded-3xl shadow-sm hover:shadow-md transition">
        <div class="flex items-center">
            <div class="flex items-center justify-center w-12 h-12 bg-blue-50 rounded-2xl text-blue-600">
                <i class="fas fa-plane-arrival"></i>
            </div>
            <div class="ml-4">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Terbang Hari Ini</p>
                <p class="text-2xl font-black text-slate-800">
                    {{ $transactions->where('date', today()->format('Y-m-d'))->count() }}
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Filter Section -->
<div class="p-8 mb-8 bg-white border border-slate-100 rounded-3xl shadow-sm">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-base font-bold text-slate-800 flex items-center">
            <i class="mr-2 text-emerald-600 fas fa-search"></i>
            Filter Keberangkatan
        </h3>
        <button onclick="resetFilters()" class="text-xs font-bold text-emerald-600">Reset Filter</button>
    </div>
    
    <div class="grid grid-cols-1 gap-5 md:grid-cols-4 text-sm">
        <div>
            <label class="text-[11px] font-black text-slate-400 uppercase mb-2 block">Cari Jamaah / Grup</label>
            <input type="text" id="search-input" placeholder="Nama jamaah..." 
                   class="w-full px-4 py-2.5 bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-emerald-500">
        </div>
        
        <div>
            <label class="text-[11px] font-black text-slate-400 uppercase mb-2 block">Status Dokumen</label>
            <select id="status-filter" class="w-full px-4 py-2.5 bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-emerald-500">
                <option value="">Semua Status</option>
                <option value="completed">Completed</option>
                <option value="dikeluarkan">Siap Berangkat</option>
                <option value="pending">Proses Pending</option>
                <option value="rejected">Batal/Ditolak</option>
            </select>
        </div>
        
        <div>
            <label class="text-[11px] font-black text-slate-400 uppercase mb-2 block">Tanggal Awal</label>
            <input type="date" id="date-start" class="w-full px-4 py-2.5 bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-emerald-500">
        </div>
        
        <div>
            <label class="text-[11px] font-black text-slate-400 uppercase mb-2 block">Tanggal Akhir</label>
            <input type="date" id="date-end" class="w-full px-4 py-2.5 bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-emerald-500">
        </div>
    </div>
</div>

<!-- Tabel Data -->
<div class="bg-white border border-slate-100 rounded-3xl shadow-sm overflow-hidden">
    <div class="px-8 py-5 border-b border-slate-50 flex items-center justify-between bg-slate-50/30">
        <div class="flex items-center space-x-3">
            <div class="bg-emerald-600 w-2 h-6 rounded-full"></div>
            <h3 class="text-lg font-black text-slate-800">Data Manifest Keberangkatan</h3>
        </div>
        <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-[10px] font-black rounded-full uppercase">
            {{ $transactions->total() }} Jamaah Terdata
        </span>
    </div>

    <div class="overflow-x-auto" id="table-container">
        <table class="w-full text-left" id="data-table">
            <thead>
                <tr class="text-[11px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50">
                    <th class="px-8 py-5">Tgl Berangkat</th>
                    <th class="px-8 py-5">Identitas Jamaah</th>
                    <th class="px-8 py-5 text-center">Pax</th>
                    <th class="px-8 py-5">Grup / Hotel</th>
                    <th class="px-8 py-5">Status</th>
                    <th class="px-8 py-5">Verifikator</th>
                    <th class="px-8 py-5 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($transactions as $transaction)
                    <tr class="hover:bg-slate-50 transition duration-150">
                        <td class="px-8 py-5">
                            <div class="text-sm font-bold text-slate-800">{{ \Carbon\Carbon::parse($transaction->date)->format('d M Y') }}</div>
                            <div class="text-[10px] font-bold text-emerald-600 uppercase">{{ \Carbon\Carbon::parse($transaction->date)->format('H:i') }} WIB</div>
                        </td>
                        
                        <td class="px-8 py-5 text-sm">
                            <div class="flex items-center">
                                <div class="w-9 h-9 mr-3 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 font-bold text-xs uppercase">
                                    {{ substr(optional($transaction->product)->name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="font-black text-slate-800">{{ optional($transaction->product)->name ?? 'N/A' }}</div>
                                    <div class="text-[10px] text-slate-400">Paspor: {{ optional($transaction->product)->sku ?? '-' }}</div>
                                </div>
                            </div>
                        </td>
                        
                        <td class="px-8 py-5 text-center">
                            <span class="px-3 py-1 bg-slate-100 rounded-lg font-black text-slate-800 text-sm">
                                {{ number_format($transaction->quantity) }} Org
                            </span>
                        </td>
                        
                        <td class="px-8 py-5">
                            <div class="text-sm font-bold text-slate-700 leading-tight">{{ $transaction->notes ?? 'Grup Reguler' }}</div>
                            <div class="text-[10px] text-slate-400 uppercase tracking-tighter italic">Keterangan Tambahan</div>
                        </td>
                        
                        <td class="px-8 py-5 text-sm font-bold">
                            @php
                                $statusStyle = in_array($transaction->status, ['completed', 'dikeluarkan']) 
                                    ? 'bg-emerald-100 text-emerald-700' 
                                    : ($transaction->status == 'pending' ? 'bg-amber-100 text-amber-700' : 'bg-red-100 text-red-700');
                            @endphp
                            <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest {{ $statusStyle }}">
                                {{ $transaction->status }}
                            </span>
                        </td>
                        
                        <td class="px-8 py-5 text-sm font-bold text-slate-500">
                            {{ optional($transaction->user)->name ?? 'Sistem' }}
                        </td>
                        
                        <td class="px-8 py-5 text-center">
                            <div class="flex justify-center space-x-1">
                                <button onclick="viewDetails({{ $transaction->id }})" class="p-2 text-slate-400 hover:text-emerald-600 transition"><i class="fas fa-eye"></i></button>
                                <button onclick="editTransaction({{ $transaction->id }})" class="p-2 text-slate-400 hover:text-blue-600 transition"><i class="fas fa-edit"></i></button>
                                <button onclick="deleteTransaction({{ $transaction->id }})" class="p-2 text-slate-400 hover:text-red-600 transition"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-8 py-20 text-center text-slate-400">
                            <i class="fas fa-plane-slash text-5xl mb-4 opacity-20 block"></i>
                            <p class="font-bold">Belum ada riwayat keberangkatan yang tercatat.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection