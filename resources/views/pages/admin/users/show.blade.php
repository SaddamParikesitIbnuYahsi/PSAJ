@extends('layouts.dashboard')

@section('title', 'Detail Profil Staf')

@section('content')
    <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div class="flex items-center gap-6">
            <div class="w-24 h-24 rounded-[2rem] bg-emerald-600 text-white flex items-center justify-center text-4xl font-black shadow-xl shadow-emerald-200 border-4 border-white">
                {{ substr($user->name, 0, 1) }}
            </div>
            <div>
                <nav class="flex text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">
                    <a href="{{ route('admin.users.index') }}" class="hover:text-emerald-600">List Staf</a>
                    <i class="fas fa-chevron-right mx-2 text-[8px]"></i> Detail Akun
                </nav>
                <h1 class="text-3xl font-black text-slate-800">{{ $user->name }}</h1>
                <p class="text-emerald-600 font-bold text-sm uppercase tracking-[0.2em]">{{ $user->role }}</p>
            </div>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.users.edit', $user) }}" class="px-8 py-3 bg-white border border-slate-100 text-slate-800 text-sm font-black rounded-2xl hover:bg-slate-50 transition shadow-sm">
                <i class="fas fa-edit mr-2"></i> Edit Data
            </a>
            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Hapus user ini?')">
                @csrf @method('DELETE')
                <button type="submit" class="px-8 py-3 bg-red-50 text-red-600 text-sm font-black rounded-2xl hover:bg-red-100 transition">
                    <i class="fas fa-trash-alt mr-2"></i> Hapus Staf
                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-8">
            <!-- Card Utama -->
            <div class="bg-white p-10 rounded-[2.5rem] shadow-sm border border-slate-100 dark:bg-gray-800">
                <h2 class="text-sm font-black text-slate-800 uppercase tracking-widest mb-8 flex items-center gap-2">
                    <i class="fas fa-id-card text-emerald-600"></i> Informasi Personal
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                    <div class="space-y-1">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Nama Lengkap</p>
                        <p class="text-lg font-black text-slate-800 dark:text-white">{{ $user->name }}</p>
                    </div>

                    <div class="space-y-1">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Alamat Email</p>
                        <p class="text-lg font-black text-slate-800 dark:text-white underline decoration-emerald-200 underline-offset-4">{{ $user->email }}</p>
                    </div>

                    <div class="space-y-1">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Wewenang / Role</p>
                        <span class="inline-block px-4 py-1.5 bg-emerald-100 text-emerald-700 text-xs font-black rounded-lg uppercase">
                            {{ $user->role }}
                        </span>
                    </div>

                    <div class="space-y-1">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Kode Pegawai</p>
                        <p class="text-lg font-black text-slate-800 dark:text-white font-mono">#ID-{{ $user->id }}</p>
                    </div>
                </div>
            </div>

            <!-- Hak Akses Role -->
            <div class="bg-slate-900 p-10 rounded-[2.5rem] text-white shadow-2xl relative overflow-hidden">
                <div class="relative z-10">
                    <h2 class="text-[10px] font-black text-emerald-400 uppercase tracking-[0.3em] mb-8 flex items-center gap-2">
                        <i class="fas fa-shield-alt"></i> Otoritas Akses Sistem
                    </h2>

                    @if($user->role === 'Admin')
                        <div class="space-y-4">
                            <h3 class="text-lg font-black">Administrator Utama</h3>
                            <ul class="space-y-3 text-sm font-bold text-slate-400">
                                <li class="flex items-center gap-3"><i class="fas fa-check-circle text-emerald-500"></i> Kontrol penuh manajemen staf biro perjalanan.</li>
                                <li class="flex items-center gap-3"><i class="fas fa-check-circle text-emerald-500"></i> Audit pendaftaran jamaah dan laporan manifest.</li>
                                <li class="flex items-center gap-3"><i class="fas fa-check-circle text-emerald-500"></i> Konfigurasi identitas travel dan sistem.</li>
                            </ul>
                        </div>
                    @elseif($user->role === 'Manajer Operasional')
                        <div class="space-y-4">
                            <h3 class="text-lg font-black">Manajer Operasional Umroh</h3>
                            <ul class="space-y-3 text-sm font-bold text-slate-400">
                                <li class="flex items-center gap-3"><i class="fas fa-check-circle text-blue-500"></i> Monitoring kuota paket, seat pesawat & hotel.</li>
                                <li class="flex items-center gap-3"><i class="fas fa-check-circle text-blue-500"></i> Verifikasi manifest keberangkatan grup.</li>
                                <li class="flex items-center gap-3"><i class="fas fa-check-circle text-blue-500"></i> Manajemen mitra agen pendaftaran.</li>
                            </ul>
                        </div>
                    @else
                        <div class="space-y-4">
                            <h3 class="text-lg font-black">Staf Registrasi & Manifest</h3>
                            <ul class="space-y-3 text-sm font-b