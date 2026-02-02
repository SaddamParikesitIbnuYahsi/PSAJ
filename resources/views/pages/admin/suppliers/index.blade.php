@extends('layouts.dashboard')

@section('title', 'Manajemen Mitra & Agen')

@section('content')
    <!-- Header Section - Premium Emerald -->
    <div class="relative mb-10 overflow-hidden rounded-[2.5rem] shadow-sm border border-slate-100">
        <div class="absolute inset-0 bg-gradient-to-r from-emerald-600/10 to-amber-500/5 backdrop-blur-md"></div>
        <div class="relative p-8 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            <div class="space-y-2">
                <nav class="flex items-center space-x-2 text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-emerald-600">Dashboard</a>
                    <i class="fas fa-chevron-right text-[8px]"></i>
                    <span class="text-emerald-600">Mitra Kerja</span>
                </nav>
                <h1 class="text-3xl font-black text-slate-800 dark:text-white">
                    Daftar Mitra & Agen Cabang
                </h1>
                <p class="text-sm text-slate-500 font-medium italic">Kelola jaringan agen pendaftaran dan partner logistik Umroh</p>
            </div>
            <a href="{{ route('admin.suppliers.create') }}"
               class="inline-flex items-center px-8 py-4 bg-emerald-600 text-white font-black rounded-2xl hover:bg-emerald-700 shadow-xl shadow-emerald-100 transition transform hover:-translate-y-1">
                <i class="fas fa-handshake mr-2"></i> Tambah Mitra Baru
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 gap-6 mb-10 md:grid-cols-3">
        <div class="p-6 bg-white border border-slate-100 rounded-[2rem] shadow-sm flex items-center gap-5 transition hover:shadow-md">
            <div class="w-14 h-14 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center text-xl font-black italic">
                M
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Mitra/Agen</p>
                <p class="text-2xl font-black text-slate-800">{{ $suppliers->total() }} Perusahaan</p>
            </div>
        </div>

        <div class="p-6 bg-white border border-slate-100 rounded-[2rem] shadow-sm flex items-center gap-5 transition hover:shadow-md">
            <div class="w-14 h-14 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center text-xl">
                <i class="fas fa-user-friends"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Kontribusi Jamaah</p>
                <p class="text-2xl font-black text-slate-800">{{ $totalProductsFromSuppliers ?? 0 }} Jamaah</p>
            </div>
        </div>

        <div class="p-6 bg-white border border-slate-100 rounded-[2rem] shadow-sm flex items-center gap-5 transition hover:shadow-md">
            <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-xl">
                <i class="fas fa-chart-line"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Efektivitas Mitra</p>
                <p class="text-2xl font-black text-slate-800">
                    {{ $suppliers->count() > 0 ? round($totalProductsFromSuppliers / $suppliers->count(), 1) : 0 }} <span class="text-sm">Jamaah/Agen</span>
                </p>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-8 border-b border-slate-50 bg-slate-50/30 flex flex-col md:flex-row justify-between gap-4 items-center">
            <h2 class="text-sm font-black text-slate-800 uppercase tracking-[0.2em]">Direktori Partner & Cabang</h2>
            
            <form method="GET" action="{{ route('admin.suppliers.index') }}" class="relative w-full md:w-80">
                <i class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 fas fa-search text-xs"></i>
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Cari nama agen/mitra..."
                       class="w-full pl-11 pr-4 py-2.5 bg-white border-none rounded-xl focus:ring-2 focus:ring-emerald-500 text-sm font-bold shadow-inner">
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50">
                        <th class="px-8 py-5">Informasi Mitra</th>
                        <th class="px-8 py-5">PIC / Penanggung Jawab</th>
                        <th class="px-8 py-5 text-center">Data Jamaah</th>
                        <th class="px-8 py-5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($suppliers as $supplier)
                        <tr class="hover:bg-slate-50/80 transition duration-150 group">
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center font-black group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                                        <i class="fas fa-building text-xs"></i>
                                    </div>
                                    <div>
                                        <div class="text-sm font-black text-slate-800">{{ $supplier->name }}</div>
                                        <div class="text-[10px] font-bold text-slate-400 italic lowercase">{{ $supplier->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <div class="text-sm font-bold text-slate-700">{{ $supplier->contact_person }}</div>
                                <div class="text-[10px] font-black text-emerald-500 tracking-tighter"><i class="fas fa-phone-alt mr-1"></i> {{ $supplier->phone }}</div>
                            </td>
                            <td class="px-8 py-5 text-center">
                                <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-[10px] font-black rounded-full uppercase">
                                    {{ $supplier->products_count }} Jamaah
                                </span>
                            </td>
                            <td class="px-8 py-5 text-right">
                                <div class="flex items-center justify-end space-x-1">
                                    <a href="{{ route('admin.suppliers.show', $supplier) }}" class="p-2 text-slate-400 hover:text-emerald-600 transition"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('admin.suppliers.edit', $supplier) }}" class="p-2 text-slate-400 hover:text-blue-600 transition"><i class="fas fa-edit"></i></a>
                                    @if($supplier->products_count == 0)
                                        <a href="{{ route('admin.suppliers.delete', $supplier) }}" class="p-2 text-slate-400 hover:text-red-600 transition"><i class="fas fa-trash"></i></a>
                                    @else
                                        <button disabled class="p-2 text-slate-200 cursor-not-allowed"><i class="fas fa-trash"></i></button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-8 border-t border-slate-50">
            {{ $suppliers->appends(request()->query())->links() }}
        </div>
    </div>
@endsection