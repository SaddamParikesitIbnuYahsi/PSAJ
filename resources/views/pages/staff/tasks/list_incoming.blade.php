@extends('layouts.dashboard')

@section('title', 'Manifest Pendaftaran Jamaah')

@section('content')
    {{-- Header dengan Breadcrumb Premium --}}
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

    @if (session('success'))
        <div class="p-4 mb-6 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 rounded-r-xl shadow-sm font-bold flex items-center">
            <i class="fas fa-check-circle mr-3"></i> {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-8">
            {{-- Form Filter --}}
            <form action="{{ route('staff.stock.incoming.list') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                <div class="md:col-span-2 relative">
                    <i class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 fas fa-search"></i>
                    <input type="text" name="search" class="w-full pl-11 pr-4 py-3 bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-emerald-500 text-sm" 
                           placeholder="Cari nama jamaah atau paket..." value="{{ $search ?? '' }}">
                </div>
                <select name="status" class="px-4 py-3 bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-emerald-500 text-sm font-bold text-slate-600">
                    <option value="semua">Semua Status</option>
                    <option value="pending" {{ ($selectedStatus ?? '') == 'pending' ? 'selected' : '' }}>Tertunda (Pending)</option>
                    <option value="completed" {{ ($selectedStatus ?? '') == 'completed' ? 'selected' : '' }}>Selesai (Lunas)</option>
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
                            <th class="px-4 py-4 text-center">Pax</th>
                            <th class="px-4 py-4">Agen / Cabang</th>
                            <th class="px-4 py-4">Status</th>
                            <th class="px-4 py-4">Tgl Input</th>
                            <th class="px-4 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($transactions as $transaction)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-4 py-4 font-bold text-slate-800">
                                    <div class="text-sm">{{ optional($transaction->product)->name ?? 'N/A' }}</div>
                                    <div class="text-[10px] text-emerald-600 uppercase">{{ optional($transaction->product)->sku ?? 'Umroh' }}</div>
                                </td>
                                <td class="px-4 py-4 text-center text-sm font-black text-slate-700">{{ $transaction->quantity }} Org</td>
                                <td class="px-4 py-4 text-sm text-slate-500">{{ optional($transaction->supplier)->name ?? 'Internal' }}</td>
                                <td class="px-4 py-4">
                                    <span class="px-3 py-1 text-[10px] font-black uppercase rounded-full {{ $transaction->status == 'completed' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                                        {{ $transaction->status }}
                                    </span>
                                </td>
                                <td class="px-4 py-4 text-xs font-bold text-slate-400">{{ \Carbon\Carbon::parse($transaction->date)->format('d/m/Y') }}</td>
                                <td class="px-4 py-4 text-right">
                                    @if($transaction->status == 'pending')
                                        <a href="{{ route('staff.stock.incoming.confirm', $transaction) }}" class="px-4 py-2 bg-emerald-600 text-white text-[10px] font-black uppercase rounded-lg hover:bg-emerald-700 transition shadow-lg shadow-emerald-50">Validasi</a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="py-12 text-center text-slate-400 font-bold italic">Data jamaah tidak ditemukan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{-- Pagination --}}
            <div class="mt-8">
                {{ $transactions->links() }}
            </div>
        </div>
    </div>
@endsection