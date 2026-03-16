@extends('layouts.dashboard')

@section('title', 'Pembayaran Paket Umroh')

@push('scripts')
<script>
    document.addEventListener('alpine:init', function() {
        Alpine.data('paymentForm', () => ({ paymentMethod: 'bayar_langsung', showPaymentInfo: false }));
    });
    document.addEventListener('DOMContentLoaded', function() {
        var fileInput = document.getElementById('bukti_pembayaran');
        var btnStep1 = document.getElementById('btnStep1');
        var hintStep1 = document.getElementById('hintStep1');
        var step2Box = document.getElementById('step2Box');

        function setStep1Enabled(enabled) {
            if (!btnStep1) return;
            btnStep1.disabled = !enabled;
            if (enabled) {
                btnStep1.classList.remove('bg-gray-300', 'dark:bg-gray-600', 'cursor-not-allowed');
                btnStep1.classList.add('bg-emerald-600', 'hover:bg-emerald-700', 'cursor-pointer');
                if (hintStep1) hintStep1.textContent = '1) Bukti sudah dipilih. Klik Lanjut untuk menampilkan tombol Confirm final.';
            } else {
                btnStep1.classList.add('bg-gray-300', 'dark:bg-gray-600', 'cursor-not-allowed');
                btnStep1.classList.remove('bg-emerald-600', 'hover:bg-emerald-700', 'cursor-pointer');
                if (hintStep1) hintStep1.textContent = '1) Pilih file bukti pembayaran, lalu klik tombol Lanjut.';
            }
        }

        if (fileInput && btnStep1) {
            fileInput.addEventListener('change', function() {
                var hasFile = this.files && this.files.length > 0;
                setStep1Enabled(hasFile);
                if (!hasFile && step2Box) step2Box.classList.add('hidden');
            });

            btnStep1.addEventListener('click', function() {
                if (btnStep1.disabled) return;
                if (step2Box) {
                    step2Box.classList.remove('hidden');
                    step2Box.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                }
            });
        }
    });
</script>
@endpush

@section('content')
<div class="container p-4 mx-auto sm:p-8">
    <div x-data="paymentForm">
        <div class="py-8">
            <div class="flex items-center gap-4 mb-8">
                <div class="flex items-center justify-center w-12 h-12 rounded-full bg-gradient-to-br from-green-100 to-green-200 dark:from-green-900/50 dark:to-green-800/50">
                    <i class="text-xl text-green-600 fas fa-shopping-cart dark:text-green-400"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Pembayaran Paket Umroh</h1>
                    <p class="mt-1 text-gray-500 dark:text-gray-400">
                        Lengkapi data jamaah dan upload bukti pembayaran untuk konfirmasi.
                    </p>
                </div>
            </div>

            <form action="{{ route('manajergudang.stock.in.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 gap-8 mt-8 lg:grid-cols-3">
                @csrf
                <input type="hidden" name="package_id" value="{{ $package->id }}">
                <input type="hidden" name="package_price" value="{{ $packagePrice }}">

                <div class="p-6 space-y-6 bg-white rounded-xl shadow-lg lg:col-span-2 dark:bg-slate-800">
                    @if (session('error'))
                        <div class="p-4 mb-4 text-red-700 bg-red-100 border-l-4 border-red-500 dark:bg-red-900/30 dark:text-red-300" role="alert">
                            <p class="font-bold">Gagal</p>
                            <p class="mt-1 text-sm">{{ session('error') }}</p>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="p-4 mb-4 text-red-700 bg-red-100 border-l-4 border-red-500 dark:bg-red-900/30 dark:text-red-300" role="alert">
                            <p class="font-bold">Terjadi Kesalahan</p>
                            <ul>@foreach ($errors->all() as $error)<li>- {{ $error }}</li>@endforeach</ul>
                        </div>
                    @endif

                    {{-- Paket Terpilih (Read-only) --}}
                    <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 dark:bg-emerald-900/20 dark:border-emerald-800">
                        <h3 class="flex items-center mb-3 text-base font-bold text-emerald-800 dark:text-emerald-300">
                            <i class="mr-2 fas fa-check-circle"></i> Paket Terpilih
                        </h3>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $package->name }}</p>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ $package->description }}</p>
                        <p class="mt-2 text-2xl font-bold text-emerald-600 dark:text-emerald-400">
                            Rp {{ number_format($packagePrice, 0, ',', '.') }}
                        </p>
                    </div>

                    <div>
                        <label for="name" class="flex items-center mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                            <i class="w-5 mr-2 fas fa-user"></i>Nama Jamaah <span class="ml-1 text-red-500">*</span>
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Nama lengkap jamaah" class="w-full px-4 py-2 text-sm border rounded-lg dark:bg-slate-700 dark:border-gray-600 dark:text-white" required>
                    </div>

                    <div>
                        <label for="sku" class="flex items-center mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                            <i class="w-5 mr-2 fas fa-id-card"></i>No. Registrasi / Paspor (Opsional)
                        </label>
                        <input type="text" id="sku" name="sku" value="{{ old('sku') }}" placeholder="Contoh: UMR-2025-0001" class="w-full px-4 py-2 text-sm border rounded-lg dark:bg-slate-700 dark:border-gray-600 dark:text-white">
                    </div>

                    <div>
                        <label for="supplier_id" class="flex items-center mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                            <i class="w-5 mr-2 fas fa-handshake"></i>Mitra / Agen <span class="ml-1 text-red-500">*</span>
                        </label>
                        <select id="supplier_id" name="supplier_id" class="w-full px-4 py-2 text-sm border rounded-lg dark:bg-slate-700 dark:border-gray-600 dark:text-white" required>
                            <option value="" disabled selected>-- Pilih Mitra / Agen --</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                    {{ $supplier->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div>
                            <label for="quantity" class="flex items-center mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                <i class="w-5 mr-2 fas fa-user-plus"></i>Jumlah Seat <span class="ml-1 text-red-500">*</span>
                            </label>
                            <input type="number" id="quantity" name="quantity" value="{{ old('quantity', 1) }}" placeholder="1" min="1" class="w-full px-4 py-2 text-sm border rounded-lg dark:bg-slate-700 dark:border-gray-600 dark:text-white" required>
                        </div>
                        <div>
                            <label for="transaction_date" class="flex items-center mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                <i class="w-5 mr-2 fas fa-calendar-alt"></i>Tanggal Transaksi <span class="ml-1 text-red-500">*</span>
                            </label>
                            <input type="date" id="transaction_date" name="transaction_date" value="{{ old('transaction_date', now()->format('Y-m-d')) }}" class="w-full px-4 py-2 text-sm border rounded-lg dark:bg-slate-700 dark:border-gray-600 dark:text-white" required>
                        </div>
                    </div>

                    <div>
                        <label class="flex items-center mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                            <i class="w-5 mr-2 fas fa-wallet"></i>Metode Pembayaran
                        </label>
                        <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                            <button type="button"
                                @click="paymentMethod = 'bayar_langsung'"
                                :class="paymentMethod === 'bayar_langsung'
                                    ? 'border-emerald-500 bg-emerald-50 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300'
                                    : 'border-slate-200 bg-slate-50 text-slate-600 dark:bg-slate-700 dark:border-slate-600 dark:text-slate-200'"
                                class="flex items-center w-full px-4 py-3 text-sm font-semibold border rounded-xl transition">
                                <i class="mr-2 fas fa-money-bill-wave"></i>
                                Bayar Langsung
                            </button>
                            <button type="button"
                                @click="paymentMethod = 'nyicil'"
                                :class="paymentMethod === 'nyicil'
                                    ? 'border-emerald-500 bg-emerald-50 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300'
                                    : 'border-slate-200 bg-slate-50 text-slate-600 dark:bg-slate-700 dark:border-slate-600 dark:text-slate-200'"
                                class="flex items-center w-full px-4 py-3 text-sm font-semibold border rounded-xl transition">
                                <i class="mr-2 fas fa-calendar-check"></i>
                                Nyicil / Cicilan
                            </button>
                        </div>
                        <input type="hidden" name="payment_method" x-model="paymentMethod">
                        <p class="mt-2 text-xs text-slate-500 dark:text-slate-400" x-show="paymentMethod === 'nyicil'">
                            Skema cicilan dapat disesuaikan saat konfirmasi dengan admin.
                        </p>
                    </div>

                    <div>
                        <label for="notes" class="flex items-center mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                            <i class="w-5 mr-2 fas fa-pencil-alt"></i>Catatan Tambahan (Opsional)
                        </label>
                        <textarea id="notes" name="notes" rows="3" placeholder="Contoh: Catatan khusus jamaah / permintaan kamar" class="w-full px-4 py-2 text-sm border rounded-lg dark:bg-slate-700 dark:border-gray-600 dark:text-white">{{ old('notes') }}</textarea>
                    </div>

                    <div class="pt-4 border-t border-dashed dark:border-slate-700">
                        <button type="button"
                                @click="showPaymentInfo = !showPaymentInfo"
                                class="inline-flex items-center px-5 py-3 text-sm font-bold text-emerald-600 dark:text-emerald-400 hover:underline">
                            <i class="mr-2 fas" :class="showPaymentInfo ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                            Instruksi Pembayaran
                        </button>
                    </div>

                    <div x-show="showPaymentInfo" x-cloak class="p-4 mt-4 text-sm border rounded-xl bg-emerald-50 border-emerald-200 dark:bg-emerald-900/20 dark:border-emerald-800 text-slate-800 dark:text-slate-200">
                        <p class="mb-2">
                            Silakan lakukan pembayaran ke rekening berikut:
                        </p>
                        <div class="p-3 mb-3 text-sm font-bold bg-white dark:bg-slate-800 border border-emerald-200 dark:border-emerald-800 rounded-lg">
                            BANK BSI (Syariah)<br>
                            No. Rekening: <span class="font-black">1234 5678 9012</span><br>
                            a.n. <span class="font-black">PT Al Madinah Haromain Travel</span>
                        </div>
                        <p class="mb-2">
                            Setelah transfer, <span class="font-bold">wajib upload bukti pembayaran</span> di form sebelah kanan.
                        </p>
                    </div>
                </div>

                {{-- Sidebar Kanan: Upload Bukti Pembayaran --}}
                <div class="lg:col-span-1">
                    <div class="sticky p-6 bg-white rounded-xl shadow-lg top-24 dark:bg-slate-800">
                        <h3 class="flex items-center pb-4 text-lg font-semibold text-gray-900 border-b dark:text-white dark:border-slate-700">
                            <i class="mr-3 text-emerald-500 fas fa-file-upload"></i>Upload Bukti Pembayaran
                        </h3>
                        <p class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                            Upload screenshot atau foto bukti transfer (wajib)<span class="text-red-500">*</span>
                        </p>
                        <div class="mb-4">
                            <input type="file" id="bukti_pembayaran" name="bukti_pembayaran"
                                accept="image/*,.pdf"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 dark:file:bg-emerald-900/30 dark:file:text-emerald-300"
                                required>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Format: JPG, PNG, GIF, atau PDF (max 5MB)</p>
                        </div>

                        <div>
                            <p class="mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Detail Paket</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">{{ $package->name }}</p>
                            <p class="mt-1 text-lg font-bold text-emerald-600 dark:text-emerald-400">
                                Rp {{ number_format($packagePrice, 0, ',', '.') }}
                            </p>
                        </div>

                        <div class="pt-6">
                            <p class="mb-2 text-xs text-gray-500 dark:text-gray-400" id="hintStep1">
                                1) Pilih file bukti pembayaran, lalu klik tombol Lanjut.
                            </p>
                            <button type="button" id="btnStep1"
                                disabled
                                class="flex items-center justify-center w-full px-6 py-3 font-semibold text-white rounded-lg shadow-md transition bg-gray-300 dark:bg-gray-600 cursor-not-allowed">
                                <i class="mr-2 fas fa-arrow-right"></i>Lanjut
                            </button>
                        </div>

                        <div id="step2Box" class="hidden mt-5 p-4 rounded-xl border border-emerald-200 bg-emerald-50 dark:bg-emerald-900/20 dark:border-emerald-800">
                            <p class="text-sm font-bold text-emerald-800 dark:text-emerald-300 mb-2">
                                2) Konfirmasi Pengiriman ke Admin
                            </p>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mb-4">
                                Pastikan data jamaah sudah benar. Setelah Confirm, data akan masuk ke Manifest Admin.
                            </p>
                            <button type="submit" id="btnConfirmSubmit"
                                class="flex items-center justify-center w-full px-6 py-3 font-semibold text-white bg-emerald-600 rounded-lg shadow-md hover:bg-emerald-700 transition">
                                <i class="mr-2 fas fa-check-circle"></i>Confirm — Kirim ke Admin
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
