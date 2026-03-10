@extends('layouts.dashboard')

@section('title', 'Detail Jamaah')

@section('content')
    <!-- Breadcrumb -->
    <div class="mb-6">
        <nav class="flex items-center mb-2 text-sm text-gray-600 dark:text-gray-400">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-600">Dashboard</a>
            <span class="mx-2">/</span>
            <a href="{{ route('admin.products.index') }}" class="hover:text-blue-600">Manifest Jamaah</a>
            <span class="mx-2">/</span>
            <span class="text-gray-500 dark:text-gray-300">Detail</span>
        </nav>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Detail Jamaah: {{ $product->name }}</h1>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <!-- Informasi Jamaah -->
        <div class="col-span-2 space-y-6">
            <!-- Card Informasi Utama -->
            <div class="overflow-hidden bg-white rounded-lg shadow dark:bg-gray-800">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-white">Informasi Jamaah</h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <!-- Kolom 1 -->
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Nama Jamaah</label>
                                <p class="mt-1 text-sm font-semibold text-gray-900 dark:text-white">{{ $product->name }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">No. Registrasi / Paspor</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $product->sku }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Program Paket</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">
                                    {{ $product->category ? $product->category->name : '-' }}
                                </p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Mitra / Agen</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">
                                    {{ $product->supplier ? $product->supplier->name : '-' }}
                                </p>
                            </div>
                        </div>

                        <!-- Kolom 2 -->
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Biaya Pokok (HPP)</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">
                                    Rp {{ number_format($product->purchase_price, 0, ',', '.') }}
                                </p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Harga Paket ke Jamaah</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">
                                    Rp {{ number_format($product->selling_price, 0, ',', '.') }}
                                </p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Kuota Seat</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">
                                    {{ $product->current_stock }} {{ $product->unit }}
                                    @if($product->current_stock <= $product->min_stock)
                                        <span class="ml-2 text-xs text-red-500">(Kuota Menipis)</span>
                                    @endif
                                </p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Batas Min Kuota</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $product->min_stock }} {{ $product->unit }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Deskripsi</label>
                        <p class="mt-1 text-sm text-gray-900 dark:text-white">
                            {{ $product->description ?: 'Tidak ada deskripsi' }}
                        </p>
                    </div>

                    <!-- Info Tambahan -->
                    <div class="grid grid-cols-2 gap-4 mt-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Dibuat Pada</label>
                            <p class="mt-1 text-sm text-gray-900 dark:text-white">
                                {{ $product->created_at->translatedFormat('d F Y H:i') }}
                            </p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Diupdate Pada</label>
                            <p class="mt-1 text-sm text-gray-900 dark:text-white">
                                {{ $product->updated_at->translatedFormat('d F Y H:i') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Riwayat Transaksi -->
            <div class="overflow-hidden bg-white rounded-lg shadow dark:bg-gray-800">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-medium text-gray-900 dark:text-white">Riwayat Transaksi</h2>
                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            Total: {{ $product->stockTransactions->count() }} transaksi
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    @if($product->stockTransactions->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">
                                            Tanggal
                                        </th>
                                        <th scope="col" class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">
                                            Jenis
                                        </th>
                                        <th scope="col" class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">
                                            Jumlah
                                        </th>
                                        <th scope="col" class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">
                                            Catatan
                                        </th>
                                        <th scope="col" class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">
                                            User
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                    @foreach($product->stockTransactions as $transaction)
                                        <tr>
                                            <td class="px-4 py-3 text-sm text-gray-900 dark:text-white whitespace-nowrap">
                                                {{ $transaction->date->translatedFormat('d M Y H:i') }}
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-900 dark:text-white whitespace-nowrap">
                                                @if($transaction->type === 'Masuk')
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                        <i class="mr-1 fas fa-arrow-down"></i> Masuk
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                                        <i class="mr-1 fas fa-arrow-up"></i> Keluar
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                                                {{ $transaction->quantity }} {{ $product->unit }}
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                                                {{ $transaction->notes ?: '-' }}
                                            </td>
                                            <td class="px-4 py-3 text-sm text-gray-900 dark:text-white whitespace-nowrap">
                                                {{ $transaction->user->name }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="py-6 text-center">
                            <i class="mx-auto text-3xl text-gray-400 fas fa-box-open"></i>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Belum ada riwayat transaksi untuk jamaah ini.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar Kanan -->
        <div class="space-y-6">
            <!-- Card Bukti Pembayaran -->
            <div class="overflow-hidden bg-white rounded-lg shadow dark:bg-gray-800">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-white">Bukti Pembayaran</h2>
                </div>
                <div class="p-6">
                    @if($product->image)
                        <div class="overflow-hidden rounded-lg">
                            @if(pathinfo($product->image, PATHINFO_EXTENSION) === 'pdf')
                                <a href="{{ asset('storage/' . $product->image) }}" target="_blank" class="flex flex-col items-center justify-center p-6 text-center bg-gray-100 rounded dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600">
                                    <i class="text-3xl text-red-500 fas fa-file-pdf"></i>
                                    <span class="mt-2 text-sm text-gray-600 dark:text-gray-300">Lihat Bukti Pembayaran (PDF)</span>
                                </a>
                            @else
                                <img src="{{ asset('storage/' . $product->image) }}"
                                     alt="Bukti pembayaran {{ $product->name }}"
                                     class="object-cover w-full h-48 mx-auto">
                            @endif
                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center p-6 text-center bg-gray-100 rounded dark:bg-gray-700">
                            <i class="text-3xl text-gray-400 fas fa-receipt"></i>
                            <span class="mt-2 text-sm text-gray-500 dark:text-gray-400">Belum ada bukti pembayaran</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Card Statistik Kuota -->
            <div class="overflow-hidden bg-white rounded-lg shadow dark:bg-gray-800">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-white">Statistik Kuota</h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-4 text-center rounded-lg bg-blue-50 dark:bg-blue-900/30">
                            <p class="text-sm font-medium text-blue-600 dark:text-blue-300">Total Masuk</p>
                            <p class="mt-1 text-xl font-bold text-blue-700 dark:text-blue-200">
                                {{ $product->stockTransactions->where('type', 'Masuk')->sum('quantity') }}
                            </p>
                        </div>
                        <div class="p-4 text-center rounded-lg bg-purple-50 dark:bg-purple-900/30">
                            <p class="text-sm font-medium text-purple-600 dark:text-purple-300">Total Keluar</p>
                            <p class="mt-1 text-xl font-bold text-purple-700 dark:text-purple-200">
                                {{ $product->stockTransactions->where('type', 'Keluar')->sum('quantity') }}
                            </p>
                        </div>
                    </div>
                    <div class="p-4 mt-4 text-center rounded-lg bg-green-50 dark:bg-green-900/30">
                        <p class="text-sm font-medium text-green-600 dark:text-green-300">Kuota Saat Ini</p>
                        <p class="mt-1 text-2xl font-bold text-green-700 dark:text-green-200">
                            {{ $product->current_stock }} {{ $product->unit }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Card Aksi -->
            <div class="overflow-hidden bg-white rounded-lg shadow dark:bg-gray-800">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-white">Aksi</h2>
                </div>
                <div class="p-6">
                    <div class="flex flex-col space-y-3">
                        <a href="{{ route('admin.products.edit', $product->id) }}"
                           class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <i class="mr-2 fas fa-edit"></i> Edit Data Jamaah
                        </a>

                        <a href="{{ route('admin.products.confirm-delete', $product->id) }}"
                           class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            <i class="mr-2 fas fa-trash"></i> Hapus Data Jamaah
                        </a>

                        <a href="{{ route('admin.products.index') }}"
                           class="flex items-center justify-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">
                            <i class="mr-2 fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
