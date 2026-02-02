@extends('layouts.dashboard')

@section('title', 'Program Paket Umroh')

@section('content')
    <!-- Header Glass Effect -->
    <div class="relative mb-8 overflow-hidden rounded-3xl shadow-sm border border-slate-100">
        <div class="absolute inset-0 bg-gradient-to-r from-emerald-600/5 to-amber-500/5 backdrop-blur-md"></div>
        <div class="relative p-8 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            <div class="space-y-2">
                <nav class="flex items-center space-x-2 text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-emerald-600">Dashboard</a>
                    <i class="fas fa-chevron-right text-[8px]"></i>
                    <span class="text-emerald-600">Program Paket</span>
                </nav>
                <h1 class="text-3xl font-black text-slate-800 dark:text-white">
                    Program Paket Umroh
                </h1>
                <p class="text-sm text-slate-500 font-medium">Kelola klasifikasi layanan dan pendaftaran jamaah per paket</p>
            </div>
            <a href="{{ route('admin.categories.create') }}"
               class="inline-flex items-center px-8 py-4 bg-emerald-600 text-white font-black rounded-2xl hover:bg-emerald-700 shadow-xl shadow-emerald-100 transition transform hover:-translate-y-1">
                <i class="fas fa-plus mr-2"></i> Tambah Program
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-3">
        <div class="p-6 bg-white border border-slate-100 rounded-[2rem] shadow-sm flex items-center gap-5 group transition hover:shadow-md">
            <div class="w-14 h-14 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center text-xl transition-colors group-hover:bg-emerald-600 group-hover:text-white">
                <i class="fas fa-clipboard-list"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Program</p>
                <p class="text-2xl font-black text-slate-800">{{ $categories->total() }} Paket</p>
            </div>
        </div>

        <div class="p-6 bg-white border border-slate-100 rounded-[2rem] shadow-sm flex items-center gap-5 group transition hover:shadow-md">
            <div class="w-14 h-14 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center text-xl transition-colors group-hover:bg-amber-500 group-hover:text-white">
                <i class="fas fa-users"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Jamaah</p>
                <p class="text-2xl font-black text-slate-800">{{ $categories->sum('products_count') }} Org</p>
            </div>
        </div>

        <div class="p-6 bg-white border border-slate-100 rounded-[2rem] shadow-sm flex items-center gap-5 group transition hover:shadow-md">
            <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-xl transition-colors group-hover:bg-blue-600 group-hover:text-white">
                <i class="fas fa-chart-pie"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Rata-rata Kuota</p>
                <p class="text-2xl font-black text-slate-800">
                    {{ $categories->count() > 0 ? round($categories->sum('products_count') / $categories->count(), 1) : 0 }} /Pkt
                </p>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden dark:bg-gray-800">
        <div class="p-8 border-b border-slate-50 bg-slate-50/30 flex flex-col md:flex-row justify-between gap-4 items-center">
            <h2 class="text-sm font-black text-slate-800 uppercase tracking-[0.2em]">Daftar Program Tersedia</h2>
            
            <form method="GET" action="{{ route('admin.categories.index') }}" class="relative w-full md:w-80">
                <i class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 fas fa-search text-xs"></i>
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Cari nama program..."
                       class="w-full pl-11 pr-4 py-2.5 bg-white border-none rounded-xl focus:ring-2 focus:ring-emerald-500 text-sm font-bold shadow-inner">
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-[11px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50">
                        <th class="px-8 py-5">Nama Program</th>
                        <th class="px-8 py-5">Deskripsi</th>
                        <th class="px-8 py-5 text-center">Jamaah Terdaftar</th>
                        <th class="px-8 py-5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($categories as $category)
                        <tr class="hover:bg-slate-50 transition duration-150">
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center font-bold">
                                        {{ substr($category->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="text-sm font-black text-slate-800">{{ $category->name }}</div>
                                        <div class="text-[10px] font-bold text-slate-400 italic">ID: #{{ $category->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <div class="text-xs text-slate-500 max-w-xs truncate">
                                    {{ $category->description ?? 'Tidak ada deskripsi paket.' }}
                                </div>
                            </td>
                            <td class="px-8 py-5 text-center">
                                <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-[10px] font-black rounded-full uppercase">
                                    {{ $category->products_count }} Jamaah
                                </span>
                            </td>
                            <td class="px-8 py-5 text-right">
                                <div class="flex items-center justify-end space-x-1">
                                    <a href="{{ route('admin.categories.show', $category) }}" class="p-2 text-slate-400 hover:text-emerald-600 transition"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="p-2 text-slate-400 hover:text-blue-600 transition"><i class="fas fa-edit"></i></a>
                                    <a href="{{ route('admin.categories.delete', $category) }}" class="p-2 text-slate-400 hover:text-red-600 transition"><i class="fas fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-8 border-t border-slate-50">
            {{ $categories->links() }}
        </div>
    </div>
@endsection