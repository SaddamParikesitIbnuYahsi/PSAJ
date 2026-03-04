@extends('layouts.dashboard')

@section('title', 'Profil Mitra: ' . $supplier->name)

@section('content')
<div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
        <div class="flex items-center space-x-2 text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-emerald-600">Dashboard</a>
            <i class="fas fa-chevron-right text-[8px]"></i>
            <a href="{{ route('admin.suppliers.index') }}" class="hover:text-emerald-600">Direktori Mitra</a>
            <i class="fas fa-chevron-right text-[8px]"></i>
            <span class="text-emerald-600 font-bold uppercase">Detail Profil</span>
        </div>
        <h1 class="text-3xl font-black text-slate-800">Partner: {{ $supplier->name }}</h1>
    </div>
    <div class="flex space-x-3">
        <a href="{{ route('admin.suppliers.edit', $supplier->id) }}" class="px-6 py-3 bg-white border border-slate-100 text-amber-600 text-sm font-bold rounded-xl hover:bg-slate-50 transition shadow-sm">
            <i class="fas fa-edit mr-2"></i> Edit Data
        </a>
        <a href="{{ route('admin.suppliers.index') }}" class="px-6 py-3 bg-slate-100 text-slate-500 text-sm font-bold rounded-xl hover:bg-slate-200 transition">
            Kembali
        </a>
    </div>
</div>

<div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
    <!-- Informasi Utama -->
    <div class="lg:col-span-1">
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 space-y-8">
            <div class="flex flex-col items-center">
                <div class="w-24 h-24 bg-emerald-50 rounded-3xl flex items-center justify-center text-3xl font-black text-emerald-600 mb-4 border-2 border-emerald-100">
                    {{ substr($supplier->name, 0, 1) }}
                </div>
                <h3 class="text-lg font-black text-slate-800">{{ $supplier->name }}</h3>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1 italic">Terdaftar: {{ $supplier->created_at->format('d M Y') }}</p>
            </div>

            <div class="space-y-6 pt-4 border-t border-slate-50">
                <div class="flex items-start gap-4">
                    <div class="w-8 h-8 rounded-lg bg-slate-50 flex items-center justify-center text-slate-400 flex-shrink-0"><i class="fas fa-envelope text-xs"></i></div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">Surel Resmi</p>
                        <p class="text-sm font-bold text-slate-700">{{ $supplier->email ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div class="w-8 h-8 rounded-lg bg-emerald-50 flex items-center justify-center text-emerald-600 flex-shrink-0"><i class="fas fa-phone-alt text-xs"></i></div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">Kontak Agen</p>
                        <p class="text-sm font-black text-emerald-700 tracking-tighter">{{ $supplier->phone }}</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div class="w-8 h-8 rounded-lg bg-slate-50 flex items-center justify-center text-slate-400 flex-shrink-0"><i class="fas fa-map-marker-alt text-xs"></i></div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">Alamat Kantor Cabang</p>
                        <p class="text-sm font-medium text-slate-600 leading-relaxed">{{ $supplier->address ?? 'Lokasi belum diinput.' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Riwayat Pendaftaran dari Mitra Ini -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
            <div class="px-8 py-6 border-b border-slate-50 bg-slate-50/30">
                <h3 class="text-sm font-black text-slate-800 uppercase tracking-widest flex items-center gap-2">
                    <i class="fas fa-users text-emerald-600"></i> Jamaah Terdaftar Via Agen Ini
                </h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50">
                            <th class="px-8 py-4">Nama Jamaah</th>
                            <th class="px-8 py-4">Paket / Seat</th>
                            <th class="px-8 py-4">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 text-sm">
                        @forelse($supplier->products as $product)
                        <tr class="hover:bg-slate-50">
                            <td class="px-8 py-5">
                                <div class="font-black text-slate-800">{{ $product->name }}</div>
                                <div class="text-[10px] font-bold text-slate-400 font-mono tracking-tighter">{{ $product->sku }}</div>
                            </td>
                            <td class="px-8 py-5">
                                <div class="text-xs font-bold text-slate-600">{{ $product->category->name ?? '-' }}</div>
                                <div class="text-[10px] font-black text-emerald-600 uppercase">{{ $product->current_stock }} Pax</div>
                            </td>
                            <td class="px-8 py-5">
                                <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest {{ $product->current_stock <= 0 ? 'bg-red-100 text-red-700' : 'bg-emerald-100 text-emerald-700' }}">
                                    {{ $product->current_stock <= 0 ? 'Sold Out' : 'Active' }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-8 py-20 text-center text-slate-400 font-bold italic">Mitra ini belum memiliki pendaftaran jamaah.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection