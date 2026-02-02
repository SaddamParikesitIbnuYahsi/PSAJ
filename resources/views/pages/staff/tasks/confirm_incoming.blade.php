@extends('layouts.dashboard')

@section('title', 'Konfirmasi Pendaftaran Jamaah')

@section('content')
    <div class="mb-6">
        <h2 class="text-2xl font-black text-slate-800 flex items-center gap-3">
            <span class="p-2 bg-emerald-100 text-emerald-600 rounded-xl">
                <i class="fas fa-user-check"></i>
            </span>
            Konfirmasi Validasi Jamaah Baru
        </h2>
    </div>

    <div class="p-8 bg-white rounded-3xl shadow-sm border border-slate-100">
        <!-- Informasi Tugas -->
        <div class="mb-8 p-6 bg-slate-50 rounded-2xl border border-slate-100">
            <h4 class="mb-4 text-xs font-black uppercase tracking-widest text-emerald-700 flex items-center">
                <i class="mr-2 fas fa-info-circle"></i> Detail Pendaftaran
            </h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase">Paket Dipilih</p>
                    <p class="font-bold text-slate-800">{{ optional($task->product)->name }}</p>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase">Jumlah Peserta (Pax)</p>
                    <p class="font-bold text-slate-800">{{ $task->quantity }} Orang</p>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase">Agen / Cabang</p>
                    <p class="font-bold text-slate-800">{{ optional($task->supplier)->name ?? 'Internal' }}</p>
                </div>
            </div>
        </div>

        <!-- Formulir Konfirmasi -->
        <form action="{{ route('staff.stock.incoming.complete', $task) }}" method="POST" class="space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700">Jumlah Jamaah Terverifikasi<span class="text-red-500">*</span></label>
                    <input type="number" name="quantity_received" value="{{ old('quantity_received', $task->quantity) }}" required 
                           class="block w-full px-4 py-3 bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-emerald-500 text-sm font-bold">
                    @error('quantity_received') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700">Tanggal Validasi Data<span class="text-red-500">*</span></label>
                    <input type="date" name="received_date" value="{{ old('received_date', now()->format('Y-m-d')) }}" required 
                           class="block w-full px-4 py-3 bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-emerald-500 text-sm font-bold">
                    @error('received_date') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-bold text-slate-700">Catatan Berkas (Paspor/Vaksin/Dokumen)</label>
                <textarea name="additional_notes" class="block w-full px-4 py-3 bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-emerald-500 text-sm" rows="3" placeholder="Contoh: Berkas paspor sudah lengkap, sisa foto..."></textarea>
            </div>

            <div class="flex justify-end pt-4">
                <button type="submit" class="px-8 py-4 bg-emerald-600 text-white font-black rounded-2xl hover:bg-emerald-700 shadow-lg shadow-emerald-100 transition transform hover:-translate-y-1">
                    <i class="mr-2 fas fa-check-double"></i> Konfirmasi & Simpan Manifest
                </button>
            </div>
        </form>
    </div>
@endsection