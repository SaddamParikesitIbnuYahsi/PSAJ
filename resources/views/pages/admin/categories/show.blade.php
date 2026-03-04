@extends('layouts.dashboard')

@section('title', 'Detail Program Umroh')

@section('content')
    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <div class="flex items-center space-x-2 text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-emerald-600">Dashboard</a>
                <i class="fas fa-chevron-right text-[8px]"></i>
                <a href="{{ route('admin.categories.index') }}" class="hover:text-emerald-600">Program</a>
                <i class="fas fa-chevron-right text-[8px]"></i>
                <span class="text-emerald-600">Detail</span>
            </div>
            <h1 class="text-3xl font-black text-slate-800">Program: {{ $category->name }}</h1>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.categories.edit', $category->id) }}"
               class="px-6 py-2.5 bg-white border border-slate-100 text-amber-600 text-sm font-bold rounded-xl hover:bg-slate-50 transition shadow-sm">
                <i class="fas fa-edit mr-2"></i> Edit Program
            </a>
            <button onclick="confirmDelete()"
                    class="px-6 py-2.5 bg-red-50 text-red-600 text-sm font-bold rounded-xl hover:bg-red-100 transition">
                <i class="fas fa-trash-alt mr-2"></i> Hapus
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
        {{-- Informasi Utama --}}
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-6 border-b border-slate-50 bg-slate-50/50">
                    <h2 class="text-sm font-black text-slate-800 uppercase tracking-widest">Informasi Paket</h2>
                </div>
                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <div class="space-y-1">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Nama Program</p>
                            <p class="text-lg font-black text-slate-800">{{ $category->name }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Status Pendaftar</p>
                            <p class="text-lg font-black text-emerald-600">{{ $category->products_count }} Jamaah Terdaftar</p>
                        </div>
                        <div class="md:col-span-2 space-y-1">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Fasilitas & Deskripsi</p>
                            <p class="text-sm font-medium text-slate-600 leading-relaxed">{{ $category->description ?? 'Tidak ada rincian fasilitas.' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- List Jamaah --}}
            <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-6 border-b border-slate-50 flex items-center justify-between">
                    <h2 class="text-sm font-black text-slate-800 uppercase tracking-widest">List Jamaah Dalam Paket Ini</h2>
                    <a href="{{ route('admin.products.create') }}?category_id={{ $category->id }}" class="text-xs font-bold text-emerald-600 hover:underline">+ Tambah Jamaah</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50">
                                <th class="px-8 py-4">Paspor / Nama</th>
                                <th class="px-8 py-4">Kuota</th>
                                <th class="px-8 py-4">Status</th>
                                <th class="px-8 py-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 text-sm">
                            @forelse($category->products as $product)
                                <tr class="hover:bg-slate-50">
                                    <td class="px-8 py-4">
                                        <div class="font-bold text-slate-800">{{ $product->name }}</div>
                                        <div class="text-[10px] font-bold text-emerald-500 uppercase">{{ $product->sku ?? '-' }}</div>
                                    </td>
                                    <td class="px-8 py-4 font-black text-slate-600">{{ $product->current_stock }} Pax</td>
                                    <td class="px-8 py-4">
                                        <span class="px-2 py-1 bg-blue-100 text-blue-700 text-[10px] font-black rounded-full uppercase">Aktif</span>
                                    </td>
                                    <td class="px-8 py-4 text-right">
                                        <a href="{{ route('admin.products.show', $product->id) }}" class="text-slate-400 hover:text-emerald-600"><i class="fas fa-eye"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="py-10 text-center text-slate-400 italic font-bold">Belum ada jamaah terdaftar di paket ini.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Statistik Kanan --}}
        <div class="space-y-8">
            <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-6 border-b border-slate-50">
                    <h2 class="text-sm font-black text-slate-800 uppercase tracking-widest">Analisis Kuota</h2>
                </div>
                <div class="p-8 space-y-6">
                    <div>
                        <div class="flex justify-between mb-2 text-[10px] font-black uppercase tracking-widest">
                            <span class="text-slate-400">Pendaftaran Aktif</span>
                            <span class="text-emerald-600">{{ $category->products_count }} Org</span>
                        </div>
                        <div class="w-full h-2.5 bg-slate-100 rounded-full overflow-hidden">
                            <div class="h-full bg-emerald-500" style="width: 70%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Script Delete tetap sama --}}
@endsection