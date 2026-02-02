@extends('layouts.dashboard')

@section('title', 'Pengaturan Sistem Umroh')

@section('content')
<div class="mb-10">
    <!-- Breadcrumb Premium -->
    <nav class="flex mb-4 text-[10px] font-black uppercase tracking-[0.2em]" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-2">
            <li class="inline-flex items-center">
                <a href="{{ route('admin.dashboard') }}" 
                   class="inline-flex items-center text-slate-400 transition-colors hover:text-emerald-600">
                    <i class="w-3 h-3 mr-2 fas fa-home"></i>
                    Portal Admin
                </a>
            </li>
            <li>
                <div class="flex items-center text-slate-300">
                    <i class="w-3 h-3 fas fa-chevron-right"></i>
                    <span class="ml-2 text-emerald-600 font-black">Konfigurasi</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Page Header - Tema Islami Modern -->
    <div class="relative p-8 overflow-hidden bg-gradient-to-r from-emerald-800 via-emerald-700 to-teal-700 rounded-[2rem] shadow-xl shadow-emerald-100 text-white">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="relative z-10 flex items-center justify-between">
            <div class="flex items-center">
                <div class="flex items-center justify-center w-16 h-16 mr-6 bg-white/20 rounded-2xl backdrop-blur-md border border-white/30 shadow-inner">
                    <i class="text-3xl fas fa-kaaba"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-black tracking-tight">Pengaturan Identitas</h1>
                    <p class="text-emerald-50 text-sm font-medium opacity-90 italic">Kelola profil dan branding travel umroh Anda</p>
                </div>
            </div>
        </div>
        <!-- Decorative Islamic Pattern Ornament -->
        <div class="absolute -top-10 -right-10 w-40 h-40 bg-white opacity-5 rounded-full border-[20px] border-white"></div>
    </div>
</div>

<!-- Alert Messages -->
@if(session('success'))
    <div class="mb-8 p-5 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 rounded-r-2xl shadow-sm flex items-center font-bold">
        <i class="fas fa-check-circle mr-3 text-xl"></i>
        {{ session('success') }}
    </div>
@endif

<!-- Main Content Card -->
<div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden dark:bg-gray-800 dark:border-gray-700">
    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Informasi Utama Section -->
        <div class="p-10 border-b border-slate-50 dark:border-gray-700">
            <div class="flex items-start mb-10">
                <div class="flex items-center justify-center w-12 h-12 mr-5 bg-amber-50 text-amber-600 rounded-2xl">
                    <i class="text-lg fas fa-id-card"></i>
                </div>
                <div>
                    <h2 class="text-xl font-black text-slate-800 dark:text-white uppercase tracking-tight">Profil Perusahaan</h2>
                    <p class="text-slate-400 text-xs font-bold uppercase tracking-widest mt-1">Informasi Dasar Travel</p>
                </div>
            </div>

            <div class="grid gap-8">
                <div class="space-y-3">
                    <label for="app_name" class="text-sm font-black text-slate-700 dark:text-gray-300 uppercase tracking-wider ml-1">
                        Nama Perusahaan / Aplikasi
                    </label>
                    <input type="text"
                           class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-emerald-500 font-black text-slate-800 dark:bg-gray-700 dark:text-white @error('app_name') ring-2 ring-red-500 @enderror"
                           id="app_name"
                           name="app_name"
                           value="{{ old('app_name', $app_name ?? '') }}"
                           placeholder="Contoh: Amanah Umroh Travel"
                           required>
                    @error('app_name') <p class="text-red-500 text-xs font-bold mt-2 ml-1">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-3">
                    <label for="app_description" class="text-sm font-black text-slate-700 dark:text-gray-300 uppercase tracking-wider ml-1">
                        Slogan / Deskripsi Singkat
                    </label>
                    <textarea
                        class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-emerald-500 font-medium text-slate-600 dark:bg-gray-700 dark:text-white leading-relaxed @error('app_description') ring-2 ring-red-500 @enderror"
                        id="app_description"
                        name="app_description"
                        rows="3"
                        placeholder="Contoh: Perjalanan Ibadah yang Nyaman dan Sesuai Sunnah..."
                        required>{{ old('app_description', $app_description ?? '') }}</textarea>
                    @error('app_description') <p class="text-red-500 text-xs font-bold mt-2 ml-1">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <!-- Logo Section -->
        <div class="p-10 bg-slate-50/50 dark:bg-gray-800/50">
            <div class="flex items-start mb-10">
                <div class="flex items-center justify-center w-12 h-12 mr-5 bg-emerald-50 text-emerald-600 rounded-2xl">
                    <i class="text-lg fas fa-image"></i>
                </div>
                <div>
                    <h2 class="text-xl font-black text-slate-800 dark:text-white uppercase tracking-tight">Identitas Visual</h2>
                    <p class="text-slate-400 text-xs font-bold uppercase tracking-widest mt-1">Logo Resmi Instansi</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Preview Current Logo -->
                <div class="flex items-center p-8 bg-white border border-slate-100 rounded-[2rem] shadow-sm">
                    <div class="relative group mr-8">
                        <img src="{{ $app_logo ?? 'https://via.placeholder.com/150x150.png?text=No+Logo' }}"
                             alt="Logo Perusahaan"
                             id="logo-preview"
                             class="w-28 h-28 object-contain bg-slate-50 p-4 border-4 border-white rounded-[2rem] shadow-lg transition-transform group-hover:scale-105">
                    </div>
                    <div>
                        <div class="text-[10px] font-black text-emerald-600 uppercase tracking-[0.2em] mb-1">Status Visual</div>
                        <h4 class="text-lg font-black text-slate-800 dark:text-white">
                            @if(isset($app_logo) && $app_logo) Logo Aktif @else Belum Ada Logo @endif
                        </h4>
                        <p class="text-xs font-bold text-slate-400 mt-1">Format: PNG, JPG, atau SVG (Maks. 2MB)</p>
                    </div>
                </div>

                <!-- Upload Form -->
                <div class="relative group">
                    <label for="app_logo" class="flex flex-col items-center justify-center w-full h-44 border-4 border-dashed border-slate-200 rounded-[2rem] bg-white hover:bg-emerald-50 hover:border-emerald-300 cursor-pointer transition-all">
                        <div class="text-center p-6">
                            <i class="text-4xl text-slate-300 group-hover:text-emerald-500 fas fa-cloud-upload-alt mb-3"></i>
                            <p class="text-sm font-black text-slate-600 group-hover:text-emerald-700">Pilih Logo Baru</p>
                            <p class="text-[10px] font-bold text-slate-400 mt-1 uppercase tracking-tighter">Atau Seret File ke Sini</p>
                        </div>
                        <input id="app_logo" name="app_logo" type="file" class="hidden" accept="image/*">
                    </label>
                </div>
            </div>
        </div>

        <!-- Footer Actions -->
        <div class="px-10 py-8 bg-white border-t border-slate-50 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-center text-slate-400 text-[11px] font-bold uppercase tracking-wider">
                <i class="fas fa-shield-alt mr-2 text-emerald-500"></i>
                Data dienkripsi dan disimpan secara permanen
            </div>
            <div class="flex items-center gap-3 w-full md:w-auto">
                <a href="{{ route('admin.dashboard') }}"
                   class="flex-1 md:flex-none px-8 py-4 text-sm font-bold text-slate-400 hover:text-slate-600 text-center transition">
                    Batal
                </a>
                <button type="submit"
                        class="flex-1 md:flex-none px-10 py-4 bg-emerald-600 text-white text-sm font-black rounded-2xl hover:bg-emerald-700 shadow-xl shadow-emerald-100 transition transform hover:-translate-y-1 active:scale-95 flex items-center justify-center">
                    <i class="mr-2 fas fa-save"></i>
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    // Live Preview Logo
    document.getElementById('app_logo').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('logo-preview').src = event.target.result;
            }
            reader.readAsDataURL(file);
        }
    });

    // Loading State saat submit
    const form = document.querySelector('form');
    const btn = form.querySelector('button[type="submit"]');
    form.addEventListener('submit', function() {
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Memproses...';
        btn.classList.add('opacity-75');
    });
</script>
@endpush