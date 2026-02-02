@extends('layouts.dashboard')

@section('title', 'Manajemen Data Mitra')

@section('content')
<div class="mb-10">
    <div class="flex items-center mb-4 space-x-2 text-[10px] font-black uppercase tracking-widest text-slate-400">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-emerald-600 transition">Dashboard</a>
        <i class="fas fa-chevron-right text-[8px]"></i>
        <a href="{{ route('admin.suppliers.index') }}" class="hover:text-emerald-600 transition">Direktori Mitra</a>
        <i class="fas fa-chevron-right text-[8px]"></i>
        <span class="text-emerald-600">Formulir Data</span>
    </div>
    <h1 class="text-3xl font-black text-slate-800">Informasi Agen / Partner</h1>
</div>

<div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
    <form action="{{ isset($supplier) ? route('admin.suppliers.update', $supplier->id) : route('admin.suppliers.store') }}" method="POST">
        @csrf
        @if(isset($supplier)) @method('PUT') @endif

        <div class="p-10 space-y-10">
            <div class="grid grid-cols-1 gap-10 md:grid-cols-2">
                <!-- Nama Agen -->
                <div class="space-y-2">
                    <label class="text-sm font-black text-slate-700 uppercase tracking-wider">Nama Agen / Perusahaan <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $supplier->name ?? '') }}"
                           class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-emerald-500 font-bold" required>
                </div>

                <!-- PIC -->
                <div class="space-y-2">
                    <label class="text-sm font-black text-slate-700 uppercase tracking-wider">Penanggung Jawab (PIC) <span class="text-red-500">*</span></label>
                    <input type="text" name="contact_person" value="{{ old('contact_person', $supplier->contact_person ?? '') }}"
                           class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-emerald-500 font-bold" required>
                </div>

                <!-- Telepon -->
                <div class="space-y-2">
                    <label class="text-sm font-black text-slate-700 uppercase tracking-wider">Nomor Telepon/WA <span class="text-red-500">*</span></label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone', $supplier->phone ?? '') }}"
                           class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-emerald-500 font-black tracking-tighter" placeholder="08xx-xxxx-xxxx" required>
                </div>

                <!-- Email -->
                <div class="space-y-2">
                    <label class="text-sm font-black text-slate-700 uppercase tracking-wider">Email Korespondensi <span class="text-red-500">*</span></label>
                    <input type="email" name="email" value="{{ old('email', $supplier->email ?? '') }}"
                           class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-emerald-500 font-bold" required>
                </div>

                <!-- Alamat -->
                <div class="md:col-span-2 space-y-2">
                    <label class="text-sm font-black text-slate-700 uppercase tracking-wider">Alamat Kantor / Domisili</label>
                    <textarea name="address" rows="3"
                              class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-emerald-500 font-medium">{{ old('address', $supplier->address ?? '') }}</textarea>
                </div>
            </div>
        </div>

        <div class="px-10 py-8 bg-slate-50 flex items-center justify-end gap-4">
            <a href="{{ route('admin.suppliers.index') }}" class="font-bold text-slate-400 hover:text-slate-600 transition">Batal</a>
            <button type="submit" class="px-8 py-4 bg-emerald-600 text-white font-black rounded-2xl hover:bg-emerald-700 shadow-xl shadow-emerald-100 transition transform hover:-translate-y-1">
                <i class="fas fa-save mr-2"></i> Simpan Data Mitra
            </button>
        </div>
    </form>
</div>
@endsection