@extends('layouts.dashboard')

@section('title', 'Tambah Program Paket')

@section('content')
    <div class="mb-8">
        <div class="flex items-center space-x-2 text-xs font-black uppercase tracking-widest text-slate-400 mb-3">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-emerald-600 transition">Dashboard</a>
            <i class="fas fa-chevron-right text-[8px]"></i>
            <a href="{{ route('admin.categories.index') }}" class="hover:text-emerald-600 transition">Program Paket</a>
            <i class="fas fa-chevron-right text-[8px]"></i>
            <span class="text-emerald-600">Tambah Baru</span>
        </div>
        <h1 class="text-3xl font-black text-slate-800 dark:text-white">Tambah Program Paket</h1>
        <p class="text-slate-500 dark:text-gray-400">Buat klasifikasi paket umroh baru untuk mengorganisir pendaftaran jamaah</p>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-8">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 gap-8">
                    {{-- Nama Kategori --}}
                    <div class="space-y-2">
                        <label for="name" class="text-sm font-black text-slate-700 dark:text-gray-300 uppercase tracking-wider">
                            Nama Program / Paket <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required
                               placeholder="Contoh: Umroh Syawal Premium"
                               class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-emerald-500 dark:bg-gray-700 dark:text-white font-bold @error('name') ring-2 ring-red-500 @enderror">
                        @error('name')
                            <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div class="space-y-2">
                        <label for="description" class="text-sm font-black text-slate-700 dark:text-gray-300 uppercase tracking-wider">
                            Deskripsi Layanan
                        </label>
                        <textarea id="description" name="description" rows="4"
                                  placeholder="Jelaskan detail fasilitas paket ini..."
                                  class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-emerald-500 dark:bg-gray-700 dark:text-white font-medium @error('description') ring-2 ring-red-500 @enderror">{{ old('description') }}</textarea>
                    </div>
                </div>

                {{-- Preview Section --}}
                <div class="mt-8 p-6 bg-emerald-50 dark:bg-gray-700 rounded-3xl border border-emerald-100 dark:border-gray-600">
                    <h3 class="text-[10px] font-black text-emerald-700 dark:text-emerald-400 uppercase tracking-[0.2em] mb-4">
                        <i class="fas fa-eye mr-2"></i>Tampilan Card Program:
                    </h3>
                    <div class="flex items-center p-4 bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-emerald-50">
                        <div class="flex-shrink-0 w-12 h-12 bg-emerald-600 rounded-xl flex items-center justify-center shadow-lg shadow-emerald-100">
                            <i class="fas fa-kaaba text-white"></i>
                        </div>
                        <div class="ml-4 flex-1">
                            <div class="text-sm font-black text-slate-800 dark:text-white" id="preview-name">
                                [Nama Program Paket]
                            </div>
                            <div class="text-[10px] font-bold text-slate-400 uppercase" id="preview-description">
                                [Deskripsi akan muncul di sini]
                            </div>
                        </div>
                        <div class="ml-auto">
                            <span class="px-3 py-1 bg-amber-100 text-amber-700 text-[10px] font-black rounded-full uppercase">
                                0 Jamaah
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Submit Buttons --}}
                <div class="flex justify-end space-x-3 mt-10 pt-8 border-t border-slate-50 dark:border-gray-700">
                    <a href="{{ route('admin.categories.index') }}" class="px-6 py-3 font-bold text-slate-400 hover:text-slate-600 transition">
                        Batal
                    </a>
                    <button type="submit" class="px-8 py-3 bg-emerald-600 text-white font-black rounded-xl hover:bg-emerald-700 shadow-xl shadow-emerald-100 transition transform hover:-translate-y-1">
                        <i class="fas fa-save mr-2"></i>Simpan Program
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection