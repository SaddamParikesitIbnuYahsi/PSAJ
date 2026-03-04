@extends('layouts.dashboard')

@section('title', 'Perbarui Data Staf')

@section('content')
    <div class="mb-8">
        <div class="flex items-center space-x-2 text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-emerald-600">Dashboard</a>
            <i class="fas fa-chevron-right text-[8px]"></i>
            <a href="{{ route('admin.users.index') }}" class="hover:text-emerald-600">Manajemen Staf</a>
            <i class="fas fa-chevron-right text-[8px]"></i>
            <span class="text-emerald-600">Edit Profil</span>
        </div>
        <h1 class="text-3xl font-black text-slate-800 dark:text-white">Edit Staf: {{ $user->name }}</h1>
        <p class="text-slate-500 dark:text-gray-400 font-medium italic">Perbarui wewenang atau informasi akses pengguna</p>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-8">
            <form action="{{ route('admin.users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    {{-- Nama --}}
                    <div class="space-y-2">
                        <label class="text-sm font-black text-slate-700 dark:text-gray-300 uppercase tracking-wider">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                               class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-emerald-500 dark:bg-gray-700 dark:text-white font-bold">
                    </div>

                    {{-- Email --}}
                    <div class="space-y-2">
                        <label class="text-sm font-black text-slate-700 dark:text-gray-300 uppercase tracking-wider">Email Kantor</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                               class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-emerald-500 dark:bg-gray-700 dark:text-white font-bold">
                    </div>

                    {{-- Role --}}
                    <div class="space-y-2">
                        <label class="text-sm font-black text-slate-700 dark:text-gray-300 uppercase tracking-wider">Jabatan</label>
                        <select name="role" required class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-emerald-500 font-black text-slate-700">
                            @foreach($roles as $role)
                                <option value="{{ $role }}" {{ old('role', $user->role) == $role ? 'selected' : '' }}>{{ $role }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Password --}}
                    <div class="space-y-2">
                        <label class="text-sm font-black text-slate-700 dark:text-gray-300 uppercase tracking-wider">Ubah Password</label>
                        <input type="password" name="password" class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-emerald-500 font-black" placeholder="Kosongkan jika tidak diganti">
                    </div>
                </div>

                {{-- Status Card --}}
                <div class="mt-10 p-6 bg-slate-900 rounded-3xl text-white flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-emerald-500 rounded-2xl flex items-center justify-center text-xl font-black">{{ substr($user->name, 0, 1) }}</div>
                        <div>
                            <p class="text-[10px] font-black text-emerald-400 uppercase tracking-widest leading-none mb-1">Log Keanggotaan</p>
                            <p class="text-sm font-bold opacity-80">Terdaftar sejak: {{ $user->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-[10px] font-black text-emerald-400 uppercase tracking-widest leading-none mb-1">Status Sistem</p>
                        <p class="text-sm font-bold text-emerald-500 flex items-center gap-2 justify-end"><span class="w-2 h-2 bg-emerald-500 rounded-full"></span> Online / Aktif</p>
                    </div>
                </div>

                {{-- Submit Buttons --}}
                <div class="flex justify-end space-x-3 mt-10 pt-8 border-t border-slate-50">
                    <a href="{{ route('admin.users.index') }}" class="px-8 py-4 font-bold text-slate-400 hover:text-slate-600 transition">Batal</a>
                    <button type="submit" class="px-10 py-4 bg-emerald-600 text-white font-black rounded-2xl hover:bg-emerald-700 shadow-xl shadow-emerald-100 transition transform hover:-translate-y-1">
                        Perbarui Akun Staf
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection