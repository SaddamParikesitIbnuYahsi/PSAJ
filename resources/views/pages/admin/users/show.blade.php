@extends('layouts.dashboard')

@section('title', 'Detail Pengguna - ' . $user->name)

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header & Breadcrumb -->
    <div class="mb-10">
        <nav class="flex mb-4" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-2 text-[10px] font-black uppercase tracking-widest font-sans">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="text-slate-400 hover:text-emerald-600 transition">Dashboard</a>
                </li>
                <li class="flex items-center gap-2">
                    <i class="fas fa-chevron-right text-[8px] text-slate-300"></i>
                    <a href="{{ route('admin.users.index') }}" class="text-slate-400 hover:text-emerald-600 transition">Manajemen Pengguna</a>
                </li>
                <li class="flex items-center gap-2">
                    <i class="fas fa-chevron-right text-[8px] text-slate-300"></i>
                    <span class="text-emerald-600 font-black">Detail Profil</span>
                </li>
            </ol>
        </nav>
        <h1 class="text-3xl font-black text-slate-800 tracking-tighter uppercase">Informasi Akun</h1>
    </div>

    <div class="space-y-8">
        <!-- Card Profil Utama -->
        <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 overflow-hidden p-10 md:p-14">
            <div class="flex flex-col md:flex-row items-center gap-10">
                <!-- Avatar Dinamis -->
                <div class="relative">
                    <div class="w-32 h-32 rounded-[2.5rem] bg-emerald-50 border-4 border-white shadow-xl flex items-center justify-center text-4xl font-black text-emerald-600 overflow-hidden">
                        @if($user->profile_photo_path)
                            <img src="{{ asset('storage/' . $user->profile_photo_path) }}" class="w-full h-full object-cover">
                        @else
                            {{ substr($user->name, 0, 1) }}
                        @endif
                    </div>
                    <div class="absolute -bottom-2 -right-2 w-10 h-10 bg-white rounded-2xl shadow-lg flex items-center justify-center text-emerald-500 border border-slate-50">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>

                <!-- Info Teks -->
                <div class="flex-1 text-center md:text-left">
                    <div class="flex flex-wrap justify-center md:justify-start items-center gap-3 mb-2">
                        <h2 class="text-2xl font-black text-slate-900 tracking-tight">{{ $user->name }}</h2>
                        <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-[10px] font-black rounded-full uppercase">{{ $user->role }}</span>
                    </div>
                    <p class="text-slate-400 font-bold italic mb-6">{{ $user->email }}</p>
                    
                    <div class="grid grid-cols-2 gap-4 text-left max-w-sm mx-auto md:mx-0">
                        <div>
                            <p class="text-[9px] font-black text-slate-300 uppercase tracking-widest mb-1">Terdaftar Sejak</p>
                            <p class="text-xs font-bold text-slate-700">{{ $user->created_at->format('d F Y') }}</p>
                        </div>
                        <div>
                            <p class="text-[9px] font-black text-slate-300 uppercase tracking-widest mb-1">Status Akun</p>
                            <p class="text-xs font-bold text-emerald-500">Aktif & Terverifikasi</p>
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex flex-col gap-2">
                    <a href="{{ route('admin.users.edit', $user) }}" class="px-6 py-3 bg-slate-900 text-white font-black rounded-2xl text-[10px] uppercase tracking-widest hover:bg-emerald-600 transition shadow-lg shadow-slate-200">
                        Edit Akun
                    </a>
                </div>
            </div>

            <hr class="my-12 border-slate-50">

            <!-- Hak Akses Role -->
            <div class="bg-slate-900 p-10 rounded-[2.5rem] text-white shadow-2xl relative overflow-hidden">
                <div class="relative z-10">
                    <h2 class="text-[10px] font-black text-emerald-400 uppercase tracking-[0.3em] mb-8 flex items-center gap-2">
                        <i class="fas fa-shield-alt"></i> Otoritas Akses Sistem
                    </h2>

                    @if($user->role === 'Admin')
                        <div class="space-y-4">
                            <h3 class="text-lg font-black italic">Administrator Utama</h3>
                            <ul class="space-y-3 text-sm font-bold text-slate-400">
                                <li class="flex items-center gap-3"><i class="fas fa-check-circle text-emerald-500"></i> Kontrol penuh manajemen staf biro perjalanan.</li>
                                <li class="flex items-center gap-3"><i class="fas fa-check-circle text-emerald-500"></i> Audit pendaftaran jamaah dan laporan manifest.</li>
                                <li class="flex items-center gap-3"><i class="fas fa-check-circle text-emerald-500"></i> Konfigurasi identitas travel dan sistem.</li>
                            </ul>
                        </div>
                    @elseif($user->role === 'User')
                        <div class="space-y-4">
                            <h3 class="text-lg font-black italic">Akun User / Jamaah</h3>
                            <ul class="space-y-3 text-sm font-bold text-slate-400">
                                <li class="flex items-center gap-3"><i class="fas fa-check-circle text-blue-500"></i> Akses dashboard pemesanan paket umroh.</li>
                                <li class="flex items-center gap-3"><i class="fas fa-check-circle text-blue-500"></i> Monitoring status pembayaran dan dokumen.</li>
                                <li class="flex items-center gap-3"><i class="fas fa-check-circle text-blue-500"></i> Melihat riwayat transaksi pribadi.</li>
                            </ul>
                        </div>
                    @else
                        <div class="space-y-4">
                            <h3 class="text-lg font-black italic">Staf Registrasi & Manifest</h3>
                            <ul class="space-y-3 text-sm font-bold text-slate-400">
                                <li class="flex items-center gap-3"><i class="fas fa-check-circle text-emerald-500"></i> Mengelola pendaftaran jamaah baru masuk.</li>
                                <li class="flex items-center gap-3"><i class="fas fa-check-circle text-emerald-500"></i> Melakukan validasi bukti pembayaran transfer.</li>
                                <li class="flex items-center gap-3"><i class="fas fa-check-circle text-emerald-500"></i> Mengatur antrean manifest keberangkatan.</li>
                            </ul>
                        </div>
                    @endif
                </div>
                <!-- Background Decoration -->
                <i class="fas fa-kaaba absolute -right-10 -bottom-10 text-9xl opacity-5"></i>
            </div>

            <!-- Tombol Kembali -->
            <div class="mt-10 flex justify-center">
                <a href="{{ route('admin.users.index') }}" class="px-8 py-3 bg-white text-slate-800 font-black rounded-2xl shadow-sm border border-slate-100 hover:bg-slate-50 transition uppercase text-[10px] tracking-widest">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>
</div>
@endsection