@extends('layouts.dashboard')

@section('title', 'Daftar Manifest Jamaah')

@section('content')
    <!-- Header Page -->
    <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-4xl font-black text-slate-800 dark:text-white flex items-center gap-3">
                <span class="p-3 bg-emerald-100 text-emerald-600 rounded-2xl"><i class="fas fa-kaaba text-2xl"></i></span>
                Manifest Jamaah
            </h1>
            <p class="text-sm text-slate-500 font-medium mt-1">Manajemen seluruh data jamaah dan ketersediaan kuota paket</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="inline-flex items-center px-8 py-4 bg-emerald-600 text-white font-black rounded-2xl hover:bg-emerald-700 shadow-xl shadow-emerald-100 transition transform hover:-translate-y-1">
            <i class="fas fa-plus mr-2"></i> Registrasi Jamaah
        </a>
    </div>

    <!-- Stats Panel -->
    <div class="grid grid-cols-1 gap-6 mb-10 md:grid-cols-4">
        <div class="p-6 bg-white border border-slate-100 rounded-3xl shadow-sm flex items-center gap-4 transition hover:shadow-md">
            <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center"><i class="fas fa-users"></i></div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Jamaah</p>
                <p class="text-2xl font-black text-slate-800">{{ $products->total() }}</p>
            </div>
        </div>
        <div class="p-6 bg-white border border-slate-100 rounded-3xl shadow-sm flex items-center gap-4 transition hover:shadow-md">
            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center"><i class="fas fa-check-circle"></i></div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Seat Tersedia</p>
                <p class="text-2xl font-black text-slate-800">{{ $stockStats['in_stock'] }}</p>
            </div>
        </div>
        <div class="p-6 bg-white border border-slate-100 rounded-3xl shadow-sm flex items-center gap-4 transition hover:shadow-md border-b-4 border-b-amber-400">
            <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center"><i class="fas fa-hourglass-half"></i></div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Kuota Menipis</p>
                <p class="text-2xl font-black text-slate-800">{{ $stockStats['low_stock'] }}</p>
            </div>
        </div>
        <div class="p-6 bg-white border border-slate-100 rounded-3xl shadow-sm flex items-center gap-4 transition hover:shadow-md border-b-4 border-b-red-400">
            <div class="w-12 h-12 bg-red-50 text-red-600 rounded-xl flex items-center justify-center"><i class="fas fa-ban"></i></div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Kuota Penuh</p>
                <p class="text-2xl font-black text-slate-800">{{ $stockStats['out_of_stock'] }}</p>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden dark:bg-gray-800">
        <div class="p-8 border-b border-slate-50 flex flex-col lg:flex-row justify-between gap-6 bg-slate-50/30">
            <h2 class="text-sm font-black text-slate-800 uppercase tracking-[0.2em] flex items-center gap-2">
                <i class="fas fa-list text-emerald-600"></i> Manifest Data Terkini
            </h2>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.products.export', request()->query()) }}" class="p-2 text-slate-400 hover:text-emerald-600 transition" title="Export Data"><i class="fas fa-file-excel text-lg"></i></a>
                <button onclick="document.getElementById('importModal').classList.remove('hidden')" class="p-2 text-slate-400 hover:text-emerald-600 transition" title="Import Data"><i class="fas fa-file-upload text-lg"></i></button>
                <form action="{{ route('admin.products.index') }}" method="GET" class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama jamaah..." class="pl-10 pr-4 py-2 bg-white border-none rounded-xl focus:ring-2 focus:ring-emerald-500 shadow-inner text-sm font-bold">
                    <i class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-300 fas fa-search text-xs"></i>
                </form>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50">
                        <th class="px-8 py-5">Identitas Jamaah</th>
                        <th class="px-8 py-5">Paket / Agen</th>
                        <th class="px-8 py-5 text-right">Biaya (IDR)</th>
                        <th class="px-8 py-5 text-center">Seat</th>
                        <th class="px-8 py-5 text-center">Status</th>
                        <th class="px-8 py-5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($products as $product)
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-4 text-sm font-bold">
                                    <div class="w-10 h-10 rounded-xl overflow-hidden border-2 border-emerald-50">
                                        <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://ui-avatars.com/api/?name='.urlencode($product->name).'&background=10b981&color=fff' }}" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <div class="text-slate-800">{{ $product->name }}</div>
                                        <div class="text-[10px] text-slate-400 font-mono tracking-tighter">REG: {{ $product->sku }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                <div class="text-[10px] font-black text-emerald-600 uppercase">{{ $product->category->name ?? '-' }}</div>
                                <div class="text-xs font-bold text-slate-500">{{ $product->supplier->name ?? 'Pusat' }}</div>
                            </td>
                            <td class="px-8 py-5 text-right text-sm font-black text-slate-800">
                                {{ $product->formatted_selling_price }}
                            </td>
                            <td class="px-8 py-5 text-center text-sm font-black text-slate-700">
                                {{ number_format($product->current_stock, 0) }} Pax
                            </td>
                            <td class="px-8 py-5 text-center">
                                @if($product->current_stock <= 0)
                                    <span class="px-3 py-1 bg-red-100 text-red-700 text-[9px] font-black rounded-full uppercase">Full</span>
                                @elseif($product->current_stock <= $product->min_stock)
                                    <span class="px-3 py-1 bg-amber-100 text-amber-700 text-[9px] font-black rounded-full uppercase">Sisa Sedikit</span>
                                @else
                                    <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-[9px] font-black rounded-full uppercase">Tersedia</span>
                                @endif
                            </td>
                            <td class="px-8 py-5 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.products.show', $product) }}" class="p-2 text-slate-400 hover:text-emerald-600 transition"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('admin.products.edit', $product) }}" class="p-2 text-slate-400 hover:text-blue-600 transition"><i class="fas fa-edit"></i></a>
                                    <a href="{{ route('admin.products.confirm-delete', $product) }}" class="p-2 text-slate-400 hover:text-red-600 transition"><i class="fas fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-8 border-t border-slate-50">{{ $products->appends(request()->query())->links() }}</div>
    </div>
@endsection