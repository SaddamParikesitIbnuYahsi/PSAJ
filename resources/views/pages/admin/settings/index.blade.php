@extends('layouts.dashboard')

@section('title', 'Konfigurasi Biro')

@section('content')
<div class="mb-10">
    <nav class="flex mb-4 text-[10px] font-black uppercase tracking-[0.2em]">
        <ol class="inline-flex items-center space-x-2 text-slate-400">
            <li><a href="{{ route('admin.dashboard') }}" class="hover:text-emerald-600 transition">Dashboard</a></li>
            <i class="fas fa-chevron-right text-[8px]"></i>
            <li class="text-emerald-600 font-black">Pengaturan</li>
        </ol>
    </nav>

    <div class="relative p-8 overflow-hidden bg-gradient-to-r from-emerald-800 via-emerald-700 to-teal-700 rounded-[2.5rem] shadow-xl text-white">
        <div class="relative z-10 flex items-center">
            <div class="flex items-center justify-center w-16 h-16 mr-6 bg-white/20 rounded-2xl backdrop-blur-md border border-white/30 shadow-inner">
                <i class="text-3xl fas fa-kaaba"></i>
            </div>
            <div>
                <h1 class="text-3xl font-black tracking-tight uppercase">Identitas Biro Umroh</h1>
                <p class="text-emerald-50 text-sm font-medium opacity-90 italic">Kelola logo dan nama aplikasi sistem Anda</p>
            </div>
        </div>
        <div class="absolute -top-10 -right-10 w-40 h-40 bg-white opacity-5 rounded-full border-[20px] border-white"></div>
    </div>
</div>

@if(session('success'))
    <div class="mb-8 p-5 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 rounded-r-2xl font-bold flex items-center shadow-sm">
        <i class="fas fa-check-circle mr-3"></i> {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
    <!-- ACTION MENGARAH KE admin.settings SESUAI WEB ANDA -->
    <form method="POST" action="{{ route('admin.settings') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="p-10 space-y-10">
            <!-- Form Input -->
            <div class="grid grid-cols-1 gap-8">
                <div class="space-y-2">
                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Nama Biro Perjalanan</label>
                    <input type="text" name="app_name" value="{{ config('app.name') }}" required
                           class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-emerald-500 font-black text-slate-800 shadow-inner">
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Slogan Layanan</label>
                    <textarea name="app_description" rows="3" required
                        class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-emerald-500 font-medium text-slate-600 shadow-inner">{{ config('app.appDescription') }}</textarea>
                </div>
            </div>

            <!-- Logo Upload -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 pt-10 border-t border-slate-50">
                <div class="flex items-center p-8 bg-slate-50 rounded-[2rem] border border-slate-100">
                    <div class="relative group mr-8">
                        {{-- Tampilkan logo dari storage --}}
                        <img src="{{ config('app.logo') ? asset('storage/' . config('app.logo')) : 'https://via.placeholder.com/150x150.png?text=Biro+Umroh' }}"
                             alt="Logo" id="logo-preview"
                             class="w-28 h-28 object-contain bg-white p-4 border-4 border-white rounded-[2rem] shadow-lg">
                    </div>
                    <div>
                        <h4 class="text-sm font-black text-slate-800 uppercase leading-none mb-1">Status Logo</h4>
                        <p class="text-xs font-bold text-emerald-600">Terpasang di Sistem</p>
                    </div>
                </div>

                <div class="relative">
                    <label for="logo_input" class="flex flex-col items-center justify-center w-full h-44 border-4 border-dashed border-slate-200 rounded-[2rem] bg-white hover:bg-emerald-50 hover:border-emerald-300 cursor-pointer transition-all group">
                        <i class="text-4xl text-slate-300 group-hover:text-emerald-500 fas fa-cloud-upload-alt mb-3"></i>
                        <p class="text-xs font-black text-slate-500 group-hover:text-emerald-700 uppercase tracking-widest">Klik Untuk Upload Logo</p>
                        <input id="logo_input" name="app_logo" type="file" class="hidden" accept="image/*">
                    </label>
                </div>
            </div>
        </div>

        <div class="px-10 py-8 bg-slate-50 flex items-center justify-end gap-3">
            <a href="{{ route('admin.dashboard') }}" class="font-bold text-slate-400 hover:text-slate-600 transition px-6">Batal</a>
            <button type="submit" class="px-10 py-4 bg-emerald-600 text-white font-black rounded-2xl hover:bg-emerald-700 shadow-xl shadow-emerald-100 transition transform hover:-translate-y-1">
                Simpan Konfigurasi
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    // Live Preview
    document.getElementById('logo_input').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('logo-preview').src = event.target.result;
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush