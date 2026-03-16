@extends('layouts.dashboard')

@section('title', 'Dashboard Manajemen Umroh')

@section('content')
    <div class="flex flex-wrap items-center justify-between mb-8 gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-800 dark:text-white flex items-center gap-2">
                <span class="p-2 bg-emerald-100 text-emerald-600 rounded-lg">
                    <i class="fas fa-mosque"></i>
                </span>
                Ahlan wa Sahlan, {{ Auth::user()->name }}!
            </h1>
            <p class="mt-1 text-slate-500 dark:text-slate-400">Kelola manifest jamaah dan ketersediaan kuota hari ini.</p>
        </div>
        <div class="text-right hidden sm:block">
            <p class="text-sm font-bold text-slate-400 uppercase tracking-widest">{{ now()->format('d F Y') }}</p>
            <p class="text-xs text-emerald-600 font-medium">Status Sistem: Aktif</p>
        </div>
    </div>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 rounded-r-lg shadow-sm flex items-center">
            <i class="fas fa-check-circle mr-3"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- Baris Pertama: Kartu Statistik --}}
    <div class="grid grid-cols-1 gap-6 mb-8 sm:grid-cols-2 lg:grid-cols-3">
        <div class="relative overflow-hidden p-6 bg-emerald-600 rounded-2xl shadow-lg shadow-emerald-200 text-white group transition-all hover:scale-[1.02]">
            <div class="relative z-10 flex justify-between items-start">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider opacity-80">Total Jamaah Terdaftar</p>
                    <p class="text-4xl font-black mt-1">{{ number_format($totalPendingTasks) }}</p>
                </div>
                <div class="p-3 bg-white/20 rounded-xl"><i class="fas fa-tasks text-2xl"></i></div>
            </div>
        </div>

        <div class="relative overflow-hidden p-6 bg-teal-500 rounded-2xl shadow-lg shadow-teal-200 text-white group transition-all hover:scale-[1.02]">
            <div class="relative z-10 flex justify-between items-start">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider opacity-80">Pendaftar Hari Ini</p>
                    <p class="text-4xl font-black mt-1">{{ number_format($incomingTodayCount) }}</p>
                </div>
                <div class="p-3 bg-white/20 rounded-xl"><i class="fas fa-user-plus text-2xl"></i></div>
            </div>
        </div>

        <div class="relative overflow-hidden p-6 bg-amber-500 rounded-2xl shadow-lg shadow-amber-200 text-white group transition-all hover:scale-[1.02]">
            <div class="relative z-10 flex justify-between items-start">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider opacity-80">Kuota Penuh Hari Ini</p>
                    <p class="text-4xl font-black mt-1">{{ number_format($outgoingTodayCount) }}</p>
                </div>
                <div class="p-3 bg-white/20 rounded-xl"><i class="fas fa-plane-departure text-2xl"></i></div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-8">
            {{-- Tugas Masuk --}}
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden dark:bg-slate-800 dark:border-slate-700">
                <div class="px-6 py-4 border-b border-slate-50 bg-slate-50/50">
                    <h5 class="text-sm font-black uppercase text-emerald-700 flex items-center gap-2">
                        <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                        Pendaftaran Jamaah Terbaru
                    </h5>
                </div>
                <div class="divide-y divide-slate-50">
                    @forelse ($incomingTasks as $task)
                        <div class="flex items-center justify-between p-6 hover:bg-slate-50 transition dark:hover:bg-slate-700">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-slate-100 rounded-xl flex items-center justify-center text-slate-400">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div>
                                    {{-- FIXED: Langsung $task->name karena ini model Product --}}
                                    <p class="font-bold text-slate-800 dark:text-white">{{ $task->name }} <span class="text-emerald-600 ml-1">x{{ $task->current_stock }}</span></p>
                                    <p class="text-xs text-slate-400 mt-0.5">Paket: {{ $task->category->name ?? 'N/A' }} • <span class="italic">{{ $task->created_at->diffForHumans() }}</span></p>
                                </div>
                            </div>
                            <a href="{{ route('staff.stock.incoming.list') }}" class="px-5 py-2 text-xs font-bold bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 transition">Detail</a>
                        </div>
                    @empty
                        <div class="py-12 text-center text-slate-400 italic text-sm">Belum ada jamaah yang didaftarkan.</div>
                    @endforelse
                </div>
            </div>

            {{-- Tugas Keluar --}}
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden dark:bg-slate-800 dark:border-slate-700">
                <div class="px-6 py-4 border-b border-slate-50 bg-slate-50/50">
                    <h5 class="text-sm font-black uppercase text-amber-700 flex items-center gap-2">
                        <span class="w-2 h-2 bg-amber-500 rounded-full animate-pulse"></span>
                        Persiapan Keberangkatan (Kuota Penuh)
                    </h5>
                </div>
                <div class="divide-y divide-slate-50">
                    @forelse ($outgoingTasks as $task)
                        <div class="flex items-center justify-between p-6 hover:bg-slate-50 transition dark:hover:bg-slate-700">
                             <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-slate-100 rounded-xl flex items-center justify-center text-slate-400">
                                    <i class="fas fa-plane-departure"></i>
                                </div>
                                <div>
                                    {{-- FIXED: Langsung $task->name --}}
                                    <p class="font-bold text-slate-800 dark:text-white">{{ $task->name }}</p>
                                    <p class="text-xs text-slate-400 mt-0.5">Status: Kuota Terpenuhi • <span class="italic text-amber-500">{{ $task->updated_at->diffForHumans() }}</span></p>
                                </div>
                            </div>
                            <a href="{{ route('staff.stock.outgoing.list') }}" class="px-5 py-2 text-xs font-bold bg-amber-500 text-white rounded-xl hover:bg-amber-600 transition">Detail</a>
                        </div>
                    @empty
                        <div class="py-12 text-center text-slate-400 italic text-sm">Tidak ada antrean keberangkatan.</div>
                    @endforelse
                </div>
            </div>
        </div>
        
        <div class="space-y-8">
            {{-- Kuota Menipis --}}
            <div class="p-6 bg-white rounded-3xl shadow-sm border border-slate-100 dark:bg-slate-800">
                <h5 class="text-sm font-black uppercase text-red-600 mb-4 flex items-center gap-2">
                    <i class="fas fa-exclamation-triangle"></i> Sisa Seat Menipis
                </h5>
                <div class="space-y-4">
                    @forelse ($lowStockProducts as $product)
                        <div class="flex justify-between items-center p-3 rounded-2xl bg-red-50 border border-red-100">
                            <div>
                                <p class="text-sm font-bold text-slate-800">{{ $product->name }}</p>
                                <p class="text-[10px] font-bold text-red-500 uppercase">Sisa: {{ $product->current_stock }} Pax</p>
                            </div>
                            <i class="fas fa-arrow-down text-red-400"></i>
                        </div>
                    @empty
                        <p class="text-xs text-center text-slate-400 py-4">Kuota Aman</p>
                    @endforelse
                </div>
            </div>

            {{-- Aktivitas Terbaru --}}
            <div class="p-6 bg-white rounded-3xl shadow-sm border border-slate-100 dark:bg-slate-800">
                <h5 class="text-sm font-black uppercase text-slate-800 dark:text-white mb-4 flex items-center gap-2">
                    <i class="fas fa-history"></i> Log Selesai
                </h5>
                <div class="space-y-5">
                    @forelse ($recentTransactions as $transaction)
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-lg {{ $transaction->type == 'Masuk' ? 'bg-emerald-100 text-emerald-600' : 'bg-red-100 text-red-600' }}">
                                <i class="fas {{ $transaction->type == 'Masuk' ? 'fa-arrow-down' : 'fa-arrow-up' }} text-[10px]"></i>
                            </div>
                            <div class="flex-1 min-w-0 border-b border-slate-50 pb-2">
                                <p class="text-xs font-bold text-slate-800 truncate dark:text-white">{{ $transaction->product->name ?? 'N/A' }}</p>
                                <p class="text-[10px] text-slate-400 font-medium">{{ $transaction->updated_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-[10px] text-center text-slate-400 py-4 font-bold uppercase">Belum ada riwayat</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection