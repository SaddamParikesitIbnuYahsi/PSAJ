@extends('layouts.dashboard')

@section('title', 'Tambah Staf Biro')

@section('content')
    <div class="mb-8">
        <div class="flex items-center space-x-2 text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-emerald-600 transition">Dashboard</a>
            <i class="fas fa-chevron-right text-[8px]"></i>
            <a href="{{ route('admin.users.index') }}" class="hover:text-emerald-600 transition">Manajemen Staf</a>
            <i class="fas fa-chevron-right text-[8px]"></i>
            <span class="text-emerald-600">Tambah Akun</span>
        </div>
        <h1 class="text-3xl font-black text-slate-800 dark:text-white">Registrasi Staf Baru</h1>
        <p class="text-slate-500 dark:text-gray-400">Buat akun akses untuk tim operasional biro umroh</p>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-8">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    {{-- Nama --}}
                    <div class="space-y-2">
                        <label for="name" class="text-sm font-black text-slate-700 dark:text-gray-300 uppercase tracking-wider">
                            Nama Lengkap Staf <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required
                               class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-emerald-500 dark:bg-gray-700 dark:text-white font-bold @error('name') ring-2 ring-red-500 @enderror">
                        @error('name') <p class="text-red-500 text-[10px] font-bold mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Email --}}
                    <div class="space-y-2">
                        <label for="email" class="text-sm font-black text-slate-700 dark:text-gray-300 uppercase tracking-wider">
                            Email Kantor <span class="text-red-500">*</span>
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                               class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-emerald-500 dark:bg-gray-700 dark:text-white font-bold @error('email') ring-2 ring-red-500 @enderror">
                        @error('email') <p class="text-red-500 text-[10px] font-bold mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Role --}}
                    <div class="space-y-2">
                        <label for="role" class="text-sm font-black text-slate-700 dark:text-gray-300 uppercase tracking-wider">
                            Jabatan / Hak Akses <span class="text-red-500">*</span>
                        </label>
                        <select id="role" name="role" required
                                class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-emerald-500 dark:bg-gray-700 dark:text-white font-black text-slate-700">
                            <option value="">Pilih Jabatan...</option>
                            @foreach($roles as $role)
                                <option value="{{ $role }}" {{ old('role') == $role ? 'selected' : '' }}>
                                    {{ $role }}
                                </option>
                            @endforeach
                        </select>
                        @error('role') <p class="text-red-500 text-[10px] font-bold mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Password --}}
                    <div class="space-y-2">
                        <label for="password" class="text-sm font-black text-slate-700 dark:text-gray-300 uppercase tracking-wider">
                            Password Akses <span class="text-red-500">*</span>
                        </label>
                        <input type="password" id="password" name="password" required
                               class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-emerald-500 dark:bg-gray-700 font-black">
                        @error('password') <p class="text-red-500 text-[10px] font-bold mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div class="space-y-2">
                        <label for="password_confirmation" class="text-sm font-black text-slate-700 dark:text-gray-300 uppercase tracking-wider">
                            Konfirmasi Password <span class="text-red-500">*</span>
                        </label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                               class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-emerald-500 dark:bg-gray-700 font-black">
                    </div>

                    {{-- Role Description (REBRANDED) --}}
                    <div class="col-span-1 md:col-span-2 mt-4">
                        <div class="p-8 bg-emerald-50 dark:bg-slate-800 rounded-3xl border border-emerald-100 dark:border-slate-700">
                            <h3 class="flex items-center text-sm font-black text-emerald-800 dark:text-white mb-6 uppercase tracking-widest">
                                <i class="fas fa-shield-alt mr-3"></i>
                                <span>Panduan Otoritas Role</span>
                            </h3>
                            <div class="grid md:grid-cols-3 gap-6">
                                <div class="bg-white p-4 rounded-2xl shadow-sm border border-emerald-50">
                                    <p class="text-xs font-black text-red-600 mb-1">ADMIN</p>
                                    <p class="text-[11px] text-slate-500 font-bold leading-relaxed">Kontrol penuh sistem, laporan keuangan, dan manajemen staf biro.</p>
                                </div>
                                <div class="bg-white p-4 rounded-2xl shadow-sm border border-emerald-50">
                                    <p class="text-xs font-black text-blue-600 mb-1">MANAJER OPERASIONAL</p>
                                    <p class="text-[11px] text-slate-500 font-bold leading-relaxed">Mengelola kuota paket umroh, manifest keberangkatan, dan laporan operasional.</p>
                                </div>
                                <div class="bg-white p-4 rounded-2xl shadow-sm border border-emerald-50">
                                    <p class="text-xs font-black text-emerald-700 mb-1">STAF REGISTRASI</p>
                                    <p class="text-[11px] text-slate-500 font-bold leading-relaxed">Melayani pendaftaran jamaah, input berkas paspor, dan penyerahan koper.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Submit Buttons --}}
                <div class="flex justify-end space-x-3 mt-10 pt-8 border-t border-slate-50 dark:border-gray-700">
                    <a href="{{ route('admin.users.index') }}" class="px-8 py-4 font-bold text-slate-400 hover:text-slate-600 transition">Batal</a>
                    <button type="submit" class="px-10 py-4 bg-emerald-600 text-white font-black rounded-2xl hover:bg-emerald-700 shadow-xl shadow-emerald-100 transition transform hover:-translate-y-1">
                        <i class="fas fa-save mr-2"></i> Simpan Akun Staf
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection