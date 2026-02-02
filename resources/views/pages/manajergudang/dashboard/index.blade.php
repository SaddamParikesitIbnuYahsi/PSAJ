@extends('layouts.dashboard')

@section('title', 'Dashboard Operasional Umroh')

@section('content')
    <!-- Header Section - Ahlan wa Sahlan -->
    <div class="relative mb-10 overflow-hidden rounded-[2.5rem] shadow-sm border border-slate-100">
        <div class="absolute inset-0 bg-gradient-to-r from-emerald-600/10 to-amber-500/5 backdrop-blur-md"></div>
        <div class="relative p-8">
            <!-- Breadcrumb -->
            <nav class="flex items-center mb-6 space-x-2 text-[10px] font-black uppercase tracking-widest text-slate-400">
                <span class="px-3 py-1.5 text-emerald-700 bg-emerald-100 rounded-lg">
                    <i class="mr-2 fas fa-tachometer-alt"></i>Dashboard Operasional
                </span>
            </nav>

            <!-- Title Section -->
            <div class="flex flex-col items-start justify-between space-y-6 lg:flex-row lg:items-center lg:space-y-0">
                <div class="space-y-2">
                    <h1 class="text-3xl font-black text-slate-800 dark:text-white leading-tight">
                        <i class="mr-3 text-emerald-600 fas fa-mosque"></i>
                        Ahlan wa Sahlan, {{ Auth::user()->name }}!
                    </h1>
                    <p class="text-sm font-medium text-slate-500 italic">
                        Ringkasan pendaftaran jamaah dan logistik keberangkatan hari ini
                    </p>
                </div>
                <div class="flex items-center space-x-3">
                    <!-- Route tetap manajergudang.stock.in -->
                    <a href="{{ route('manajergudang.stock.in') }}"
                       class="inline-flex items-center px-6 py-3.5 text-sm font-bold text-slate-600 bg-white border border-slate-100 rounded-2xl hover:bg-slate-50 transition shadow-sm">
                        <i class="mr-2 fas fa-user-plus text-emerald-600"></i>
                        <span>Registrasi Baru</span>
                    </a>
                    <!-- Route tetap manajergudang.stock.out -->
                    <a href="{{ route('manajergudang.stock.out') }}"
                       class="inline-flex items-center px-6 py-3.5 text-sm font-bold text-white bg-emerald-600 rounded-2xl hover:bg-emerald-700 transition shadow-lg shadow-emerald-100 transform hover:-translate-y-1">
                        <i class="mr-2 fas fa-plane-departure"></i>
                        <span>Rencana Terbang</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Notification -->
    @if(session('success'))
    <div class="p-4 mb-6 text-emerald-800 bg-emerald-50 border-l-4 border-emerald-500 rounded-r-xl font-bold">
        <i class="mr-2 fas fa-check-circle"></i> {{ session('success') }}
    </div>
    @endif

    <!-- Statistics Cards - Rebranded -->
    <div class="grid grid-cols-1 gap-6 mb-10 sm:grid-cols-2 lg:grid-cols-4">
        <!-- Total Jamaah -->
        <div class="p-6 bg-white border border-slate-100 rounded-[2rem] shadow-sm transition hover:shadow-md group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center transition-colors group-hover:bg-emerald-600 group-hover:text-white">
                    <i class="text-xl fas fa-users"></i>
                </div>
                <span class="text-[10px] font-black text-emerald-600 uppercase tracking-widest bg-emerald-50 px-2 py-1 rounded">Jamaah</span>
            </div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Total Jamaah</p>
            <p class="text-3xl font-black text-slate-800 mt-1">{{ number_format($totalProducts ?? 0) }}</p>
        </div>

        <!-- Mitra/Agen -->
        <div class="p-6 bg-white border border-slate-100 rounded-[2rem] shadow-sm transition hover:shadow-md group">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-blue-600/10 opacity-0 group-hover:opacity-100 transition-opacity rounded-[2rem]"></div>
            <div class="relative flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center transition-colors group-hover:bg-blue-600 group-hover:text-white">
                    <i class="text-xl fas fa-handshake"></i>
                </div>
                <span class="text-[10px] font-black text-blue-600 uppercase tracking-widest bg-blue-50 px-2 py-1 rounded">Agen</span>
            </div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Total Mitra</p>
            <p class="text-3xl font-black text-slate-800 mt-1">{{ number_format($totalSuppliers ?? 0) }}</p>
        </div>

        <!-- Daftar Hari Ini -->
        <div class="p-6 bg-white border border-slate-100 rounded-[2rem] shadow-sm transition hover:shadow-md group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center transition-colors group-hover:bg-indigo-600 group-hover:text-white">
                    <i class="text-xl fas fa-user-check"></i>
                </div>
                <span class="text-[10px] font-black text-indigo-600 uppercase tracking-widest bg-indigo-50 px-2 py-1 rounded">Input</span>
            </div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Daftar Hari Ini</p>
            <p class="text-3xl font-black text-slate-800 mt-1">{{ number_format($incomingTodayCount ?? 0) }}</p>
        </div>

        <!-- Terbang Hari Ini -->
        <div class="p-6 bg-white border border-slate-100 rounded-[2rem] shadow-sm transition hover:shadow-md group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center transition-colors group-hover:bg-amber-500 group-hover:text-white">
                    <i class="text-xl fas fa-plane-arrival"></i>
                </div>
                <span class="text-[10px] font-black text-amber-600 uppercase tracking-widest bg-amber-50 px-2 py-1 rounded">Flight</span>
            </div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Terbang Hari Ini</p>
            <p class="text-3xl font-black text-slate-800 mt-1">{{ number_format($outgoingTodayCount ?? 0) }}</p>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
        <!-- Left Column - Charts and Low Stock -->
        <div class="space-y-8 lg:col-span-2">
            <!-- Grafik Aktivitas -->
            <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-6 border-b border-slate-50 bg-slate-50/30 flex items-center justify-between">
                    <h2 class="text-lg font-black text-slate-800 uppercase tracking-tighter">
                        <i class="mr-2 text-emerald-600 fas fa-chart-line"></i>
                        Tren Pendaftaran & Flight
                    </h2>
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic">7 Hari Terakhir</span>
                </div>
                <div class="p-6">
                    <div id="main-chart"></div>
                </div>
            </div>

            <!-- Kuota Paket Hampir Penuh -->
            <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-6 border-b border-slate-50 bg-red-50/30">
                    <h2 class="text-sm font-black text-red-700 uppercase tracking-widest">
                        <i class="mr-2 fas fa-exclamation-triangle"></i>
                        Kuota Paket Menipis
                    </h2>
                </div>
                <div class="p-6 divide-y divide-slate-50">
                    @forelse ($lowStockProducts as $product)
                        <div class="flex items-center justify-between py-4 group">
                            <div>
                                <p class="font-bold text-slate-800">{{ $product->name }}</p>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">Minimal Kuota: {{ $product->min_stock }} Pax</p>
                            </div>
                            <div class="text-right">
                                <span class="text-lg font-black text-red-600">{{ $product->current_stock }}</span>
                                <span class="text-[10px] font-bold text-slate-400 uppercase ml-1">Sisa Seat</span>
                            </div>
                        </div>
                    @empty
                        <div class="py-12 text-center text-slate-300">
                            <i class="fas fa-check-circle text-emerald-500 text-4xl mb-3"></i>
                            <p class="text-sm font-bold uppercase tracking-widest">Semua Kuota Paket Aman</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Right Column - Recent Activities -->
        <div class="space-y-8">
            <!-- Recent Transactions Card -->
            <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden text-sm">
                <div class="p-6 border-b border-slate-50 bg-slate-50/30">
                    <h2 class="text-sm font-black text-slate-800 uppercase tracking-widest">Aktivitas Terbaru</h2>
                </div>
                <div class="p-6 space-y-6">
                    @forelse ($recentTransactions as $transaction)
                        <div class="flex items-start space-x-4 border-b border-slate-50 last:border-0 pb-4">
                            <div class="flex-shrink-0 flex items-center justify-center w-10 h-10 rounded-xl {{ $transaction->type == 'Masuk' ? 'bg-emerald-50 text-emerald-600' : 'bg-amber-50 text-amber-600' }}">
                                <i class="{{ $transaction->type == 'Masuk' ? 'fas fa-user-plus' : 'fas fa-plane-departure' }}"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-black text-slate-800 truncate">{{ $transaction->product->name ?? 'Jamaah Umum' }}</p>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">{{ $transaction->date->format('d M Y • H:i') }} WIB</p>
                            </div>
                            <div class="font-black {{ $transaction->type == 'Masuk' ? 'text-emerald-600' : 'text-amber-600' }}">
                                {{ $transaction->type == 'Masuk' ? '+' : '-' }}{{ $transaction->quantity }}
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-slate-300 italic py-6">Belum ada pergerakan data</p>
                    @endforelse
                </div>
            </div>

            <!-- Recent Suppliers Card (Agen) -->
            <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-6 border-b border-slate-50 bg-slate-50/30">
                    <h2 class="text-sm font-black text-slate-800 uppercase tracking-widest">Mitra / Agen Baru</h2>
                </div>
                <div class="p-6 space-y-6">
                    @forelse ($recentSuppliers as $supplier)
                        <div class="flex items-center space-x-4 border-b border-slate-50 last:border-0 pb-4">
                            <div class="w-10 h-10 bg-emerald-50 rounded-full flex items-center justify-center font-black text-emerald-600 text-xs shadow-inner">
                                {{ substr($supplier->name, 0, 1) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-bold text-slate-800 truncate">{{ $supplier->name }}</p>
                                <p class="text-[10px] font-bold text-slate-400 truncate">{{ $supplier->email }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-slate-300 italic py-6">Belum ada agen baru</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const chartData = {!! json_encode($chartData) !!};
            const options = {
                series: [
                    {
                        name: 'Pendaftaran',
                        data: chartData.incoming,
                        color: '#059669' // Emerald
                    },
                    {
                        name: 'Keberangkatan',
                        data: chartData.outgoing,
                        color: '#f59e0b' // Amber
                    }
                ],
                chart: {
                    type: 'area',
                    height: 350,
                    toolbar: { show: false },
                    fontFamily: 'Plus Jakarta Sans, sans-serif'
                },
                fill: {
                    type: 'gradient',
                    gradient: { shadeIntensity: 1, opacityFrom: 0.3, opacityTo: 0.1, stops: [0, 90, 100] }
                },
                dataLabels: { enabled: false },
                stroke: { curve: 'smooth', width: 3 },
                xaxis: {
                    categories: chartData.categories,
                    axisBorder: { show: false },
                    axisTicks: { show: false }
                },
                grid: {
                    borderColor: '#f1f5f9',
                    strokeDashArray: 4
                },
                legend: {
                    position: 'top',
                    horizontalAlign: 'right',
                    fontWeight: 700
                }
            };
            const chart = new ApexCharts(document.querySelector("#main-chart"), options);
            chart.render();
        });
    </script>
@endpush