@extends('layouts.dashboard')

@section('title', 'Manifes Pendaftaran Jamaah')

@section('content')
    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-black text-slate-800">Manifes Pendaftaran Jamaah</h2>
            <p class="text-sm text-slate-500 font-medium italic">Manajemen data jamaah yang baru masuk ke sistem</p>
        </div>
        <nav class="flex px-4 py-2 bg-white rounded-xl shadow-sm border border-slate-50 text-xs font-bold uppercase tracking-widest text-slate-400">
            <a href="{{ route('staff.dashboard') }}" class="hover:text-emerald-600">Portal</a>
            <i class="fas fa-chevron-right mx-3 text-[10px]"></i>
            <span class="text-emerald-600">List Manifest</span>
        </nav>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-8">
            {{-- Form Filter --}}
            <form action="{{ route('staff.stock.incoming.list') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                <div class="md:col-span-2 relative">
                    <i class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 fas fa-search"></i>
                    <input type="text" name="search" class="w-full pl-11 pr-4 py-3 bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-emerald-500 text-sm" 
                           placeholder="Cari nama jamaah atau paket..." value="{{ request('search') }}">
                </div>
                <select name="status" class="px-4 py-3 bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-emerald-500 text-sm font-bold text-slate-600">
                    <option value="semua">Semua Status</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Tersedia</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Kuota Penuh/Menipis</option>
                </select>
                <button type="submit" class="bg-slate-900 text-white font-bold rounded-xl hover:bg-slate-800 transition py-3">
                    <i class="fas fa-filter mr-2"></i> Terapkan Filter
                </button>
            </form>

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-[11px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50">
                            <th class="px-4 py-4">Paket / Jamaah</th>
                            <th class="px-4 py-4 text-center">Pax (Seat)</th>
                            <th class="px-4 py-4">Agen / Cabang</th>
                            <th class="px-4 py-4 text-center">Status</th>
                            <th class="px-4 py-4">Tgl Daftar</th>
                            <th class="px-4 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($transactions as $data)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-4 py-4 font-bold text-slate-800">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl overflow-hidden border-2 border-emerald-50">
                                            <img src="{{ $data->image ? asset('storage/'.$data->image) : 'https://ui-avatars.com/api/?name='.urlencode($data->name).'&background=10b981&color=fff' }}" class="w-full h-full object-cover">
                                        </div>
                                        <div>
                                            <div class="text-sm">{{ $data->name }}</div>
                                            <div class="text-[10px] text-emerald-600 uppercase">{{ $data->category->name ?? 'UMROH' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-center text-sm font-black text-slate-700">{{ number_format($data->current_stock) }} Pax</td>
                                <td class="px-4 py-4 text-sm text-slate-500 font-bold">{{ $data->supplier->name ?? 'Internal Pusat' }}</td>
                                <td class="px-4 py-4 text-center">
                                    @if($data->current_stock <= 0)
                                        <span class="px-3 py-1 text-[9px] font-black uppercase rounded-full bg-red-100 text-red-700">Penuh</span>
                                    @elseif($data->current_stock <= $data->min_stock)
                                        <span class="px-3 py-1 text-[9px] font-black uppercase rounded-full bg-amber-100 text-amber-700">Menipis</span>
                                    @else
                                        <span class="px-3 py-1 text-[9px] font-black uppercase rounded-full bg-emerald-100 text-emerald-700">Tersedia</span>
                                    @endif
                                </td>
                                <td class="px-4 py-4 text-xs font-bold text-slate-400">{{ $data->created_at->format('d/m/Y') }}</td>
                                <td class="px-4 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <a href="#" class="p-2 text-slate-400 hover:text-emerald-600 transition"><i class="fas fa-eye"></i></a>
                                        <a href="#" class="p-2 text-slate-400 hover:text-blue-600 transition"><i class="fas fa-print"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="py-12 text-center text-slate-400 font-bold italic text-sm">Data jamaah tidak ditemukan. Silakan tambahkan melalui Admin.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-8">
                {{ $transactions->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection