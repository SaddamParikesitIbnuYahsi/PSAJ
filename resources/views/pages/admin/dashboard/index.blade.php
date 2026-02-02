@extends('layouts.dashboard')

@section('title', 'Dashboard Admin Umroh')

@section('content')
    <!-- Header Section - Ahlan wa Sahlan -->
    <div class="relative mb-8 overflow-hidden rounded-3xl shadow-sm border border-slate-100">
        <div class="absolute inset-0 bg-gradient-to-r from-emerald-600/5 to-amber-500/5 backdrop-blur-sm"></div>
        <div class="relative p-8">
            <!-- Breadcrumb -->
            <nav class="flex items-center mb-6 space-x-2 text-xs font-black uppercase tracking-widest">
                <span class="px-3 py-1.5 text-emerald-700 bg-emerald-100 rounded-lg">
                    <i class="mr-2 fas fa-kaaba"></i>Portal Pusat
                </span>
            </nav>

            <!-- Title Section -->
            <div class="flex flex-col items-start justify-between space-y-6 lg:flex-row lg:items-center lg:space-y-0">
                <div class="space-y-2">
                    <h1 class="text-3xl font-black text-slate-800 dark:text-white leading-tight">
                        <i class="mr-3 text-emerald-600 fas fa-mosque"></i>
                        Ahlan wa Sahlan, {{ Auth::user()->name }}!
                    </h1>
                    <p class="text-slate-500 dark:text-gray-400 font-medium italic">
                        Ringkasan operasional pendaftaran dan keberangkatan jamaah hari ini.
                    </p>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.reports.stock') }}"
                       class="inline-flex items-center px-6 py-3.5 text-sm font-bold text-slate-600 bg-white border border-slate-100 rounded-2xl hover:bg-slate-50 transition shadow-sm">
                        <i class="mr-2 fas fa-print"></i>
                        <span>Cetak Manifest</span>
                    </a>
                    <a href="{{ route('admin.products.create') }}"
                       class="inline-flex items-center px-6 py-3.5 text-sm font-bold text-white bg-emerald-600 rounded-2xl hover:bg-emerald-700 transition shadow-lg shadow-emerald-100 transform hover:-translate-y-1">
                        <i class="mr-2 fas fa-user-plus"></i>
                        <span>Input Jamaah Baru</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Notification -->
    @if(session('success'))
    <div class="p-4 mb-6 text-emerald-800 bg-emerald-50 border-l-4 border-emerald-500 rounded-r-xl font-bold flex items-center">
        <i class="mr-3 fas fa-check-circle"></i> {{ session('success') }}
    </div>
    @endif

    <!-- Statistik Utama -->
    <div class="grid grid-cols-1 gap-6 mb-8 sm:grid-cols-2 lg:grid-cols-4">
        <!-- Jamaah Terdaftar -->
        <div class="p-6 bg-white border border-slate-100 rounded-[2rem] shadow-sm hover:shadow-md transition group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center transition-colors group-hover:bg-emerald-600 group-hover:text-white">
                    <i class="text-xl fas fa-users"></i>
                </div>
                <span class="text-[10px] font-black text-emerald-600 uppercase tracking-widest bg-emerald-50 px-2 py-1 rounded">Jamaah</span>
            </div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Total Jamaah</p>
            <p class="text-3xl font-black text-slate-800 mt-1">{{ number_format($totalProducts ?? 0) }}</p>
        </div>

        <!-- Agen/Mitra -->
        <div class="p-6 bg-white border border-slate-100 rounded-[2rem] shadow-sm hover:shadow-md transition group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center transition-colors group-hover:bg-amber-500 group-hover:text-white">
                    <i class="text-xl fas fa-handshake"></i>
                </div>
                <span class="text-[10px] font-black text-amber-600 uppercase tracking-widest bg-amber-50 px-2 py-1 rounded">Mitra</span>
            </div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Agen Cabang</p>
            <p class="text-3xl font-black text-slate-800 mt-1">{{ number_format($totalSuppliers ?? 0) }}</p>
        </div>

        <!-- Paket Layanan -->
        <div class="p-6 bg-white border border-slate-100 rounded-[2rem] shadow-sm hover:shadow-md transition group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center transition-colors group-hover:bg-blue-600 group-hover:text-white">
                    <i class="text-xl fas fa-th-large"></i>
                </div>
                <span class="text-[10px] font-black text-blue-600 uppercase tracking-widest bg-blue-50 px-2 py-1 rounded">Program</span>
            </div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Paket Umroh</p>
            <p class="text-3xl font-black text-slate-800 mt-1">{{ number_format($totalCategories ?? 0) }}</p>
        </div>

        <!-- Staf Operasional -->
        <div class="p-6 bg-white border border-slate-100 rounded-[2rem] shadow-sm hover:shadow-md transition group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-slate-100 text-slate-600 rounded-2xl flex items-center justify-center transition-colors group-hover:bg-slate-800 group-hover:text-white">
                    <i class="text-xl fas fa-user-tie"></i>
                </div>
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest bg-slate-100 px-2 py-1 rounded">Internal</span>
            </div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Total Staf</p>
            <p class="text-3xl font-black text-slate-800 mt-1">{{ number_format($totalUsers ?? 0) }}</p>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
        
        <div class="space-y-8 lg:col-span-2">
            <!-- Grafik Aktivitas Pendaftaran -->
            <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-6 border-b border-slate-50 flex items-center justify-between">
                    <h2 class="text-lg font-black text-slate-800">
                        <i class="mr-2 text-emerald-600 fas fa-chart-area"></i>
                        Grafik Pendaftaran & Keberangkatan
                    </h2>
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">7 Hari Terakhir</span>
                </div>
                <div class="p-6">
                    <div id="main-chart"></div>
                </div>
            </div>

            <!-- Kuota Paket Hampir Penuh (Low Stock) -->
            <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-6 border-b border-slate-50 bg-red-50/30">
                    <h2 class="text-lg font-black text-red-700 uppercase tracking-tight">
                        <i class="mr-2 fas fa-exclamation-circle text-red-500 animate-pulse"></i>
                        Status Kuota Kritis
                    </h2>
                </div>
                <div class="divide-y divide-slate-50">
                    @forelse ($lowStockProducts as $product)
                        <div class="flex items-center justify-between p-6 hover:bg-slate-50 transition">
                            <div>
                                <p class="font-bold text-slate-800">{{ $product->name }}</p>
                                <p class="text-[10px] font-black text-slate-400 uppercase">Kuota Min: {{ $product->min_stock }} Pax</p>
                            </div>
                            <div class="text-right">
                                <span class="text-lg font-black text-red-600">{{ $product->current_stock }}</span>
                                <span class="text-[10px] font-bold text-slate-400 uppercase ml-1">Sisa Seat</span>
                            </div>
                        </div>
                    @empty
                        <div class="py-12 text-center text-slate-400">
                            <i class="fas fa-check-circle text-emerald-500 text-4xl mb-3"></i>
                            <p class="text-sm font-bold uppercase tracking-widest">Semua kuota paket masih tersedia</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="space-y-8">
            <!-- Aktivitas Registrasi Terbaru -->
            <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-6 border-b border-slate-50">
                    <h2 class="text-lg font-black text-slate-800 flex items-center gap-2">
                        <i class="fas fa-history text-emerald-600"></i>
                        Aktivitas Terkini
                    </h2>
                </div>
                <div class="p-6 space-y-6">
                    @forelse ($recentTransactions as $transaction)
                        <div class="flex items-start space-x-4 border-b border-slate-50 last:border-0 pb-4">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0 {{ $transaction->type == 'Masuk' ? 'bg-emerald-50 text-emerald-600' : 'bg-amber-50 text-amber-600' }}">
                                <i class="{{ $transaction->type == 'Masuk' ? 'fas fa-user-plus' : 'fas fa-plane-departure' }}"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-bold text-slate-800 truncate">{{ $transaction->product->name ?? 'Jamaah Umum' }}</p>
                                <p class="text-[10px] font-black text-slate-400 uppercase">{{ $transaction->date->format('d M Y') }} • {{ $transaction->type == 'Masuk' ? 'Pendaftar' : 'Terbang' }}</p>
                            </div>
                            <div class="text-sm font-black {{ $transaction->type == 'Masuk' ? 'text-emerald-600' : 'text-amber-600' }}">
                                {{ $transaction->type == 'Masuk' ? '+' : '-' }}{{ $transaction->quantity }}
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-slate-300 italic text-sm py-6">Belum ada pergerakan data</p>
                    @endforelse
                </div>
            </div>

            <!-- Staf/Pengguna Baru -->
            <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-6 border-b border-slate-50 bg-slate-50/50">
                    <h2 class="text-xs font-black uppercase tracking-[0.2em] text-slate-400">Pengguna Terdaftar Baru</h2>
                </div>
                <div class="p-6 space-y-5">
                    @forelse ($recentUsers as $user)
                        <div class="flex items-center space-x-4">
                            <img class="w-10 h-10 rounded-full border-2 border-emerald-50 shadow-sm" src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=10b981&color=fff" alt="">
                            <div>
                                <p class="text-sm font-bold text-slate-800 leading-none">{{ $user->name }}</p>
                                <p class="text-[10px] font-black text-emerald-600 uppercase tracking-tighter mt-1">{{ $user->role }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-xs text-center text-slate-400 py-4 italic">Belum ada pendaftaran akun baru</p>
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
                        name: 'Pendaftar Baru',
                        data: chartData.incoming,
                        color: '#10b981' // Emerald
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
                    fontFamily: 'inherit'
                },
                fill: {
                    type: 'gradient',
                    gradient: { shadeIntensity: 1, opacityFrom: 0.4, opacityTo: 0.1, stops: [0, 90, 100] }
                },
                dataLabels: { enabled: false },
                stroke: { curve: 'smooth', width: 3 },
                xaxis: {
                    categories: chartData.categories,
                    axisBorder: { show: false },
                    axisTicks: { show: false }
                },
                grid: { borderColor: '#f1f5f9', strokeDashArray: 4 },
                legend: { position: 'top', horizontalAlign: 'right', fontWeight: 700 }
            };
            const chart = new ApexCharts(document.querySelector("#main-chart"), options);
            chart.render();
        });
    </script>
@endpush