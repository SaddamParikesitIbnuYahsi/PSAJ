@extends('layouts.dashboard')

@section('title', 'Laporan Riwayat Aktivitas')

@section('content')
<div class="mb-10">
    <!-- Breadcrumb Premium -->
    <nav class="flex mb-4 text-[10px] font-black uppercase tracking-[0.2em]">
        <ol class="inline-flex items-center space-x-2">
            <li class="inline-flex items-center text-slate-400">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-emerald-600 transition-colors flex items-center">
                    <i class="fas fa-home mr-2 text-xs"></i> Portal Admin
                </a>
            </li>
            <i class="fas fa-chevron-right text-[8px] text-slate-300"></i>
            <li class="text-emerald-600">Riwayat Aktivitas Jamaah</li>
        </ol>
    </nav>

    <!-- Header Card dengan Gradient Premium -->
    <div class="relative p-8 overflow-hidden bg-gradient-to-r from-emerald-800 via-emerald-700 to-teal-700 rounded-[2.5rem] shadow-xl text-white">
        <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex items-center">
                <div class="flex items-center justify-center w-16 h-16 mr-6 bg-white/20 rounded-2xl backdrop-blur-md border border-white/30 shadow-inner">
                    <i class="text-3xl fas fa-history"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black tracking-tight uppercase">Jurnal Aktivitas Jamaah</h1>
                    <p class="text-emerald-50 text-sm opacity-90 italic font-medium">Log riwayat pendaftaran dan keberangkatan secara real-time</p>
                </div>
            </div>
            
            <div class="flex items-center gap-3">
                <div class="px-5 py-2.5 bg-white/10 rounded-xl backdrop-blur-sm border border-white/20 text-center">
                    <p class="text-[10px] font-black uppercase opacity-70 leading-none mb-1">Total Record</p>
                    <p class="text-xl font-black">{{ $transactions->total() }}</p>
                </div>
            </div>
        </div>
        <div class="absolute -top-10 -right-10 w-40 h-40 bg-white opacity-5 rounded-full border-[20px] border-white"></div>
    </div>
</div>

<!-- Section Filter Pencarian -->
<div class="p-8 mb-8 bg-white border border-slate-100 rounded-[2.5rem] shadow-sm">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-xs font-black text-slate-800 uppercase tracking-widest flex items-center">
            <i class="mr-2 text-emerald-600 fas fa-search-plus"></i>
            Filter Riwayat Data
        </h3>
    </div>
    
    <form method="GET" action="{{ route('admin.reports.transactions') }}" class="grid grid-cols-1 gap-5 md:grid-cols-4 items-end">
        <div class="space-y-2">
            <label class="text-[10px] font-black text-slate-400 uppercase ml-1">Jenis Aktivitas</label>
            <select name="type" class="w-full px-5 py-3 bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-emerald-500 font-bold text-sm text-slate-600">
                <option value="">Semua Riwayat</option>
                <option value="Masuk" {{ request('type') == 'Masuk' ? 'selected' : '' }}>Pendaftaran Baru</option>
                <option value="Keluar" {{ request('type') == 'Keluar' ? 'selected' : '' }}>Keberangkatan</option>
            </select>
        </div>
        
        <div class="space-y-2">
            <label class="text-[10px] font-black text-slate-400 uppercase ml-1">Mulai Tanggal</label>
            <input type="date" name="from" value="{{ request('from') }}" class="w-full px-5 py-3 bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-emerald-500 font-bold text-sm">
        </div>
        
        <div class="space-y-2">
            <label class="text-[10px] font-black text-slate-400 uppercase ml-1">Sampai Tanggal</label>
            <input type="date" name="to" value="{{ request('to') }}" class="w-full px-5 py-3 bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-emerald-500 font-bold text-sm">
        </div>

        <div class="flex gap-2">
            <button type="submit" class="flex-1 bg-slate-900 text-white px-6 py-3.5 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-slate-800 transition shadow-lg">
                Filter
            </button>
            <a href="{{ route('admin.reports.transactions') }}" class="px-4 py-3.5 bg-slate-100 text-slate-400 rounded-xl hover:text-emerald-600 transition flex items-center justify-center">
                <i class="fas fa-sync-alt"></i>
            </a>
        </div>
    </form>
</div>

<!-- Card Table Utama -->
<div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden dark:bg-gray-800">
    <div class="px-8 py-5 border-b border-slate-50 bg-slate-50/30">
        <h3 class="text-sm font-black text-slate-800 dark:text-white uppercase tracking-[0.2em] flex items-center">
            <i class="fas fa-stream mr-3 text-emerald-600"></i>
            Log Aktivitas Transaksi
        </h3>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50">
                    <th class="px-8 py-5">Jamaah / Program Paket</th>
                    <th class="px-8 py-5">Jenis Aktivitas</th>
                    <th class="px-8 py-5 text-center">Jumlah Pax</th>
                    <th class="px-8 py-5">Staf Penanggung Jawab</th>
                    <th class="px-8 py-5 text-right">Tanggal & Waktu</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50 dark:divide-gray-700">
                @forelse($transactions as $trx)
                    <tr class="hover:bg-slate-50/80 transition duration-150 group">
                        <td class="px-8 py-5">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 shadow-inner">
                                    <i class="fas fa-kaaba text-[10px]"></i>
                                </div>
                                <div>
                                    <div class="text-sm font-black text-slate-800 dark:text-white">{{ $trx->product->name ?? 'Data Jamaah Dihapus' }}</div>
                                    <div class="text-[10px] font-bold text-slate-400 uppercase">{{ optional($trx->product->category)->name ?? 'Tanpa Kategori' }}</div>
                                </div>
                            </div>
                        </td>
                        
                        <td class="px-8 py-5">
                             @if($trx->type == 'Masuk')
                                <span class="inline-flex items-center px-3 py-1.5 bg-emerald-50 text-emerald-600 text-[9px] font-black rounded-lg uppercase tracking-widest border border-emerald-100">
                                    <i class="fas fa-user-plus mr-1.5"></i> Pendaftaran
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1.5 bg-amber-50 text-amber-600 text-[9px] font-black rounded-lg uppercase tracking-widest border border-amber-100">
                                    <i class="fas fa-plane-departure mr-1.5"></i> Keberangkatan
                                </span>
                            @endif
                        </td>
                        
                        <td class="px-8 py-5 text-center">
                            <span class="text-sm font-black {{ $trx->type == 'Masuk' ? 'text-emerald-600' : 'text-amber-600' }}">
                                {{ $trx->type == 'Masuk' ? '+' : '-' }}{{ number_format($trx->quantity) }} Pax
                            </span>
                        </td>
                        
                        <td class="px-8 py-5">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-slate-200 flex items-center justify-center text-[10px] font-black text-slate-500 uppercase">
                                    {{ substr($trx->user->name ?? 'S', 0, 1) }}
                                </div>
                                <span class="text-xs font-bold text-slate-600 dark:text-gray-300">{{ $trx->user->name ?? 'System' }}</span>
                            </div>
                        </td>
                        
                        <td class="px-8 py-5 text-right">
                            <div class="text-xs font-black text-slate-800 dark:text-white uppercase leading-none mb-1">
                                {{ $trx->date ? \Carbon\Carbon::parse($trx->date)->format('d M Y') : '-' }}
                            </div>
                            <div class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">
                                {{ $trx->date ? \Carbon\Carbon::parse($trx->date)->format('H:i') : '-' }} WIB
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-24 text-center">
                            <i class="fas fa-layer-group text-5xl text-slate-100 mb-4 block"></i>
                            <p class="text-sm font-black text-slate-400 uppercase tracking-widest">Belum ada aktivitas terekam.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination Section -->
    <div class="p-8 border-t border-slate-50 bg-slate-50/20">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">
                Menampilkan {{ $transactions->firstItem() ?? 0 }} - {{ $transactions->lastItem() ?? 0 }} Dari {{ $transactions->total() }} Data
            </p>
            <div class="pagination-emerald">
                {{ $transactions->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>
@endsection