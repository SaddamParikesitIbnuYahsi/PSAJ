@extends('layouts.dashboard')

@section('title', 'Hapus Data Mitra')

@section('content')
<div class="max-w-2xl mx-auto py-12 px-6">
    <div class="bg-white border-2 border-red-50 rounded-[2.5rem] shadow-2xl overflow-hidden">
        <div class="p-10 text-center">
            <div class="w-20 h-20 bg-red-50 text-red-500 rounded-3xl flex items-center justify-center text-3xl mx-auto mb-6">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <h2 class="text-2xl font-black text-slate-800 mb-2">Hapus Kemitraan?</h2>
            <p class="text-sm font-medium text-slate-500 leading-relaxed mb-8">
                Anda akan menghapus data mitra <span class="font-black text-slate-800">"{{ $supplier->name }}"</span>. Seluruh histori pendaftaran jamaah dari mitra ini mungkin akan terdampak.
            </p>

            <div class="p-6 bg-red-50/50 rounded-3xl border border-red-100 mb-10 text-left">
                <p class="text-[10px] font-black text-red-400 uppercase tracking-widest mb-3">Informasi Tambahan:</p>
                <ul class="space-y-2 text-xs font-bold text-red-700">
                    <li>• Histori jamaah akan kehilangan link partner (Supplier ID = NULL)</li>
                    <li>• Aksi ini permanen dan tidak dapat dipulihkan</li>
                </ul>
            </div>

            <div class="flex items-center justify-center gap-4">
                <a href="{{ route('admin.suppliers.index') }}" class="px-8 py-4 font-bold text-slate-400 hover:text-slate-600">Batal</a>
                <form action="{{ route('admin.suppliers.destroy', $supplier->id) }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="px-8 py-4 bg-red-600 text-white font-black rounded-2xl hover:bg-red-700 shadow-xl shadow-red-100 transition">
                        Konfirmasi Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection