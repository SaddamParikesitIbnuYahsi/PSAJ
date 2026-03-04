@extends('layouts.dashboard')

@section('title', 'Finalisasi Keberangkatan Jamaah')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h2 class="text-2xl font-black text-slate-800 flex items-center gap-3">
            <span class="p-2 bg-amber-100 text-amber-600 rounded-xl shadow-sm">
                <i class="fas fa-plane-departure"></i>
            </span>
            Finalisasi Manifest Keberangkatan
        </h2>
    </div>

    <div class="p-8 bg-white rounded-[2rem] shadow-sm border border-slate-100 dark:bg-gray-800 dark:border-gray-700">

        {{-- Notifikasi Peringatan --}}
        @if (session('warning'))
            <div class="flex items-center p-4 mb-6 text-amber-800 border-l-4 border-amber-500 bg-amber-50 rounded-r-xl dark:bg-gray-700 dark:text-amber-400" role="alert">
                <i class="fas fa-exclamation-triangle mr-3"></i>
                <p class="text-sm font-bold">{{ session('warning') }}</p>
            </div>
        @endif
        
        @if (session('error'))
            <div class="flex items-center p-4 mb-6 text-red-800 border-l-4 border-red-500 bg-red-50 rounded-r-xl dark:bg-gray-700 dark:text-red-400" role="alert">
                <i class="fas fa-times-circle mr-3"></i>
                <p class="text-sm font-bold">{{ session('error') }}</p>
            </div>
        @endif

        <!-- Informasi Tugas Keberangkatan -->
        <div class="mb-10 overflow-hidden bg-slate-50 rounded-3xl border border-slate-100 dark:bg-gray-700/50 dark:border-gray-600">
            <div class="px-6 py-4 bg-slate-100/50 border-b border-slate-100 dark:bg-gray-700">
                <h4 class="text-xs font-black uppercase tracking-[0.2em] text-slate-400">Detail Manifest Jamaah</h4>
            </div>
            <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-8 text-sm">
                <div class="space-y-1">
                    <p class="text-[10px] font-black text-emerald-600 uppercase tracking-widest">Paket / Grup Umroh</p>
                    <p class="text-xl font-black text-slate-800 dark:text-white leading-tight">
                        {{ optional($task->product)->name }}
                    </p>
                    <p class="text-xs font-bold text-slate-400 italic">
                        Kapasitas Seat Terdaftar: <span class="text-slate-700 dark:text-slate-200">{{ optional($task->product)->stock ?? 0 }} Org</span>
                    </p>
                </div>
                <div class="space-y-1">
                    <p class="text-[10px] font-black text-amber-600 uppercase tracking-widest">Jumlah Rencana Berangkat</p>
                    <p class="text-3xl font-black text-slate-800 dark:text-white">{{ $task->quantity }} <span class="text-sm font-bold text-slate-400">Pax</span></p>
                </div>
                <div class="col-span-1 md:col-span-2 p-4 bg-white rounded-2xl border border-slate-100 dark:bg-gray-800 dark:border-gray-600">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Catatan Keberangkatan / Tujuan</p>
                    <p class="font-bold text-slate-700 dark:text-gray-300">{{ $task->notes ?? '-' }}</p>
                </div>
            </div>
        </div>

        <!-- Formulir Konfirmasi Keberangkatan -->
        <form action="{{ route('staff.stock.outgoing.dispatch', $task) }}" method="POST" class="space-y-8">
            @csrf

            <div class="max-w-md">
                <label class="block">
                    <span class="text-sm font-black text-slate-700 dark:text-gray-300 uppercase tracking-wider">
                        Jumlah Jamaah Siap Terbang (Actual)<span class="text-red-500 ml-1">*</span>
                    </span>
                    <div class="relative mt-3">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                            <i class="fas fa-user-check text-emerald-500"></i>
                        </div>
                        <input
                            type="number"
                            name="quantity_dispatched"
                            class="block w-full pl-12 pr-4 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-emerald-500 text-lg font-black text-slate-800 dark:bg-gray-700 dark:text-white transition-all shadow-inner"
                            placeholder="Masukkan jumlah jamaah tetap"
                            value="{{ old('quantity_dispatched', min($task->quantity, optional($task->product)->stock ?? 0)) }}"
                            required
                            max="{{ optional($task->product)->stock ?? 0 }}"
                        />
                    </div>
                    @error('quantity_dispatched')
                        <span class="mt-2 text-xs font-bold text-red-500 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                        </span>
                    @enderror
                    <p class="mt-3 text-[11px] text-slate-400 font-bold italic">
                        *Pastikan jumlah jamaah sesuai dengan manifes fisik dan paspor yang tersedia.
                    </p>
                </label>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex items-center justify-end gap-4 pt-6 border-t border-slate-50 dark:border-gray-700">
                <a href="{{ url()->previous(route('staff.dashboard')) }}"
                   class="px-6 py-3 text-sm font-bold text-slate-400 hover:text-slate-600 transition duration-150 rounded-xl">
                    Batal
                </a>
                <button
                    type="submit"
                    class="px-8 py-4 text-sm font-black text-white bg-emerald-600 rounded-2xl hover:bg-emerald-700 shadow-xl shadow-emerald-100 transition transform hover:-translate-y-1 active:scale-95 focus:outline-none flex items-center">
                    <i class="fas fa-check-double mr-2"></i> Konfirmasi Keberangkatan
                </button>
            </div>
        </form>
    </div>
@endsection