@extends('layouts.dashboard')

@section('title', $reportTitle)

@section('content')
<!-- Header Section - Manajemen Data Jamaah -->
<div class="mb-8">
    <!-- Breadcrumb -->
    <nav class="flex mb-4" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-2 text-sm font-medium">
            <li class="inline-flex items-center">
                <a href="{{ route('admin.dashboard') }}" 
                   class="inline-flex items-center text-slate-500 transition-colors hover:text-emerald-600">
                    <i class="w-4 h-4 mr-2 fas fa-home"></i>
                    Portal Admin
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

    <!-- Page Header dengan Tema Islami Modern -->
    <div class="relative p-8 overflow-hidden bg-gradient-to-r from-emerald-800 via-emerald-700 to-teal-700 rounded-3xl shadow-xl shadow-emerald-100">
        <div class="absolute inset-0 bg-black opacity-5"></div>
        <div class="relative z-10">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="flex items-center">
                    <div class="flex items-center justify-center w-16 h-16 mr-5 bg-white/20 rounded-2xl backdrop-blur-md border border-white/30 text-white shadow-inner">
                        <i class="text-3xl fas fa-users-cog"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-black text-white tracking-tight">Riwayat Jamaah</h1>
                        <p class="text-emerald-50 text-sm font-medium opacity-90">Sistem monitoring pendaftaran dan keberangkatan jamaah</p>
                    </div>
                </div>
                
                <!-- Tombol Aksi -->
                <div class="flex items-center space-x-3">
                    <button onclick="refreshData()" 
                            class="flex items-center px-4 py-2.5 text-white text-sm font-bold transition-all bg-white/10 rounded-xl backdrop-blur-md border border-white/20 hover:bg-white/20">
                        <i class="mr-2 fas fa-sync-alt" id="refresh-icon"></i>
                        Segarkan Data
                    </button>
                    <div class="relative">
                        <button onclick="toggleExportMenu()" 
                                class="flex items-center px-5 py-2.5 text-emerald-900 text-sm font-bold transition-all bg-amber-400 rounded-xl shadow-lg shadow-amber-900/20 hover:bg-amber-300">
                            <i class="mr-2 fas fa-file-export"></i>
                            Cetak Manifest
                            <i class="ml-2 text-[10px] fas fa-chevron-down"></i>
                        </button>
                        <!-- Export Menu -->
                        <div id="export-menu" class="absolute right-0 z-50 hidden w-52 mt-3 bg-white border border-slate-100 rounded-2xl shadow-xl p-2">
                            <a href="#" onclick="exportToPDF()" class="flex items-center px-4 py-3 text-sm font-semibold text-slate-700 rounded-xl hover:bg-emerald-50 hover:text-emerald-700 transition">
                                <i class="mr-3 text-red-500 fas fa-file-pdf"></i>
                                Manifest (PDF)
                            </a>
                            <a href="#" onclick="exportToExcel()" class="flex items-center px-4 py-3 text-sm font-semibold text-slate-700 rounded-xl hover:bg-emerald-50 hover:text-emerald-700 transition">
                                <i class="mr-3 text-green-600 fas fa-file-excel"></i>
                                Data Excel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Dekorasi Ornament -->
        <div class="absolute -top-10 -right-10 w-40 h-40 bg-white opacity-5 rounded-full border-[20px] border-white"></div>
    </div>
</div>

<!-- Kartu Statistik - Fokus pada Jamaah -->
<div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-4">
    <div class="p-6 bg-white border border-slate-100 rounded-3xl shadow-sm hover:shadow-md transition">
        <div class="flex items-center">
            <div class="flex items-center justify-center w-12 h-12 bg-emerald-50 rounded-2xl text-emerald-600">
                <i class="fas fa-user-friends"></i>
            </div>
            <div class="ml-4">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Pendaftar</p>
                <p class="text-2xl font-black text-slate-800">{{ $transactions->total() }}</p>
            </div>
        </div>
    </div>
    
    <div class="p-6 bg-white border border-slate-100 rounded-3xl shadow-sm hover:shadow-md transition">
        <div class="flex items-center">
            <div class="flex items-center justify-center w-12 h-12 bg-blue-50 rounded-2xl text-blue-600">
                <i class="fas fa-user-check"></i>
            </div>
            <div class="ml-4">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Sudah Verifikasi</p>
                <p class="text-2xl font-black text-slate-800">
                    {{ $transactions->where('status', 'completed')->count() + $transactions->where('status', 'diterima')->count() }}
                </p>
            </div>
        </div>
    </div>
    
    <div class="p-6 bg-white border border-slate-100 rounded-3xl shadow-sm hover:shadow-md transition">
        <div class="flex items-center">
            <div class="flex items-center justify-center w-12 h-12 bg-amber-50 rounded-2xl text-amber-600">
                <i class="fas fa-file-invoice-dollar"></i>
            </div>
            <div class="ml-4">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Proses Dokumen</p>
                <p class="text-2xl font-black text-slate-800">
                    {{ $transactions->where('status', '!=', 'completed')->where('status', '!=', 'diterima')->count() }}
                </p>
            </div>
        </div>
    </div>
    
    <div class="p-6 bg-white border border-slate-100 rounded-3xl shadow-sm hover:shadow-md transition">
        <div class="flex items-center">
            <div class="flex items-center justify-center w-12 h-12 bg-emerald-900 text-white rounded-2xl">
                <i class="fas fa-user-plus"></i>
            </div>
            <div class="ml-4">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Daftar Hari Ini</p>
                <p class="text-2xl font-black text-slate-800">
                    {{ $transactions->where('date', today()->format('Y-m-d'))->count() }}
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Section Pencarian -->
<div class="p-8 mb-8 bg-white border border-slate-100 rounded-3xl shadow-sm">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-base font-bold text-slate-800 flex items-center">
            <i class="mr-2 text-emerald-600 fas fa-search-plus"></i>
            Cari Data Jamaah
        </h3>
        <button onclick="resetFilters()" class="text-xs font-bold text-emerald-600 hover:text-emerald-700">
            Bersihkan Filter
        </button>
    </div>
    
    <div class="grid grid-cols-1 gap-5 md:grid-cols-4">
        <div class="space-y-1.5">
            <label class="text-[11px] font-black text-slate-400 uppercase ml-1">Nama Jamaah / No. Telp</label>
            <input type="text" id="search-input" placeholder="Ketik nama atau kontak..." 
                   class="w-full px-4 py-2.5 bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-emerald-500 text-sm">
        </div>
        
        <div class="space-y-1.5">
            <label class="text-[11px] font-black text-slate-400 uppercase ml-1">Status Pendaftaran</label>
            <select id="status-filter" class="w-full px-4 py-2.5 bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-emerald-500 text-sm">
                <option value="">Semua Status</option>
                <option value="completed">Terverifikasi (Lunas)</option>
                <option value="pending">Proses Berkas</option>
            </select>
        </div>
        
        <div class="space-y-1.5">
            <label class="text-[11px] font-black text-slate-400 uppercase ml-1">Dari Tanggal Daftar</label>
            <input type="date" id="date-start" class="w-full px-4 py-2.5 bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-emerald-500 text-sm">
        </div>
        
        <div class="space-y-1.5">
            <label class="text-[11px] font-black text-slate-400 uppercase ml-1">Sampai Tanggal</label>
            <input type="date" id="date-end" class="w-full px-4 py-2.5 bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-emerald-500 text-sm">
        </div>
    </div>
</div>

<!-- Tabel Manifest Jamaah -->
<div class="bg-white border border-slate-100 rounded-3xl shadow-sm overflow-hidden">
    <div class="px-8 py-5 border-b border-slate-50 bg-slate-50/30 flex items-center justify-between">
        <div class="flex items-center space-x-3">
            <div class="bg-emerald-600 w-2 h-6 rounded-full"></div>
            <h3 class="text-lg font-black text-slate-800">List Manifest Jamaah</h3>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left" id="data-table">
            <thead>
                <tr class="text-[11px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50">
                    <th class="px-8 py-5">Tgl Daftar</th>
                    <th class="px-8 py-5">Jamaah / Paket</th>
                    <th class="px-8 py-5 text-center">Pax (Seat)</th>
                    <th class="px-8 py-5">Agen / Cabang</th>
                    <th class="px-8 py-5">Status</th>
                    <th class="px-8 py-5">Petugas Input</th>
                    <th class="px-8 py-5 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($transactions as $transaction)
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="px-8 py-5">
                            <div class="text-sm font-bold text-slate-800">{{ \Carbon\Carbon::parse($transaction->date)->format('d M Y') }}</div>
                            <div class="text-[10px] font-bold text-emerald-600 uppercase">{{ \Carbon\Carbon::parse($transaction->date)->format('H:i') }} WIB</div>
                        </td>
                        
                        <td class="px-8 py-5">
                            <div class="flex items-center">
                                <div class="w-9 h-9 mr-3 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600">
                                    <i class="fas fa-user text-xs"></i>
                                </div>
                                <div>
                                    <div class="text-sm font-black text-slate-800">{{ optional($transaction->product)->name ?? 'Jamaah Umum' }}</div>
                                    <div class="text-[10px] font-bold text-emerald-500 uppercase tracking-tighter">Paket: {{ optional($transaction->product)->sku ?? 'Gold' }}</div>
                                </div>
                            </div>
                        </td>
                        
                        <td class="px-8 py-5 text-center font-black text-slate-800">
                            {{ number_format($transaction->quantity) }} Org
                        </td>
                        
                        <td class="px-8 py-5 text-sm font-bold text-slate-600">
                            {{ optional($transaction->supplier)->name ?? 'Kantor Pusat' }}
                        </td>
                        
                        <td class="px-8 py-5">
                            @php
                                $statusClass = $transaction->status == 'completed' || $transaction->status == 'diterima' 
                                    ? 'bg-emerald-100 text-emerald-700' 
                                    : ($transaction->status == 'pending' ? 'bg-amber-100 text-amber-700' : 'bg-slate-100 text-slate-600');
                            @endphp
                            <span class="inline-flex items-center px-3 py-1 text-[10px] font-black uppercase tracking-widest rounded-full {{ $statusClass }}">
                                {{ $transaction->status == 'completed' ? 'Terverifikasi' : $transaction->status }}
                            </span>
                        </td>
                        
                        <td class="px-8 py-5 text-sm font-bold text-slate-600">
                            {{ optional($transaction->user)->name ?? 'Admin' }}
                        </td>
                        
                        <td class="px-8 py-5 text-center">
                            <div class="flex items-center justify-center space-x-1">
                                <button onclick="viewDetails({{ $transaction->id }})" class="p-2 text-slate-400 hover:text-emerald-600 transition"><i class="fas fa-eye"></i></button>
                                <button onclick="editTransaction({{ $transaction->id }})" class="p-2 text-slate-400 hover:text-blue-600 transition"><i class="fas fa-edit"></i></button>
                                <button onclick="deleteTransaction({{ $transaction->id }})" class="p-2 text-slate-400 hover:text-red-600 transition"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-8 py-20 text-center">
                            <p class="text-sm font-bold text-slate-400">Belum ada jamaah yang terdaftar.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection