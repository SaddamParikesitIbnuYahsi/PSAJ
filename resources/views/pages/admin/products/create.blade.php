@extends('layouts.dashboard')

@section('title', 'Registrasi Jamaah Baru')

@section('content')
    <!-- Header Section -->
    <div class="mb-8">
        <!-- Breadcrumb Premium -->
        <nav class="flex mb-4 text-[10px] font-black uppercase tracking-[0.2em]">
            <ol class="inline-flex items-center space-x-2">
                <li class="inline-flex items-center text-slate-400">
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-emerald-600 transition-colors flex items-center">
                        <i class="fas fa-home mr-2 text-xs"></i> Dashboard
                    </a>
                </li>
                <i class="fas fa-chevron-right text-[8px] text-slate-300"></i>
                <li>
                    <a href="{{ route('admin.products.index') }}" class="text-slate-400 hover:text-emerald-600 transition-colors">Data Jamaah</a>
                </li>
                <i class="fas fa-chevron-right text-[8px] text-slate-300"></i>
                <li class="text-emerald-600">Registrasi Baru</li>
            </ol>
        </nav>

        <!-- Page Title -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-black text-slate-800 dark:text-white">Registrasi Jamaah Baru</h1>
                <p class="mt-1 text-sm font-medium text-slate-500">Masukkan data manifest pendaftaran jamaah ke dalam sistem bindo umroh</p>
            </div>
            <div class="flex items-center space-x-3">
                <button type="button" class="inline-flex items-center px-4 py-2 text-xs font-bold text-slate-600 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition shadow-sm" onclick="window.print()">
                    <i class="fas fa-print mr-2"></i> Cetak Form
                </button>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    @if ($errors->any())
        <div class="mb-8 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r-xl shadow-sm font-bold">
            <div class="flex items-center mb-2">
                <i class="fas fa-exclamation-triangle mr-2"></i>
                <span>Mohon periksa kembali inputan Anda:</span>
            </div>
            <ul class="list-disc list-inside text-xs font-medium space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Main Form Card -->
    <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden dark:bg-gray-800 dark:border-gray-700">
        <!-- Form Header -->
        <div class="px-8 py-5 border-b border-slate-50 bg-slate-50/30 flex items-center justify-between">
            <h2 class="text-sm font-black text-slate-800 dark:text-white uppercase tracking-widest flex items-center">
                <i class="fas fa-id-card mr-3 text-emerald-600"></i>
                Manifes Pendaftaran
            </h2>
            <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-[10px] font-black rounded-full uppercase">Form Input Baru</span>
        </div>

        <!-- Form Body -->
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="p-8" id="productForm">
            @csrf

            <div class="grid grid-cols-1 gap-10 lg:grid-cols-12">
                <!-- Left Column - Informasi Utama -->
                <div class="lg:col-span-8 space-y-8">
                    
                    <!-- Section: Informasi Jamaah -->
                    <div class="p-8 border border-slate-100 rounded-3xl bg-slate-50/50 dark:bg-gray-800/50 dark:border-gray-700">
                        <h3 class="text-xs font-black text-emerald-700 dark:text-emerald-400 mb-6 uppercase tracking-[0.2em]">
                            <i class="fas fa-user-circle mr-2"></i> Data Personal & Paket
                        </h3>
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <!-- Nama Jamaah (name) -->
                            <div class="md:col-span-2 space-y-2">
                                <label for="name" class="text-sm font-bold text-slate-700 dark:text-gray-300">Nama Lengkap Jamaah <span class="text-red-500">*</span></label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                       class="w-full px-5 py-4 bg-white border border-slate-200 rounded-2xl focus:ring-2 focus:ring-emerald-500 font-bold dark:bg-gray-700 dark:text-white outline-none transition-all"
                                       placeholder="Sesuai Paspor / KTP" autofocus>
                                @error('name') <p class="mt-2 text-xs text-red-600 font-bold">{{ $message }}</p> @enderror
                            </div>

                            <!-- SKU (No Paspor / ID) -->
                            <div class="space-y-2">
                                <div class="flex items-center justify-between">
                                    <label for="sku" class="text-sm font-bold text-slate-700 dark:text-gray-300 uppercase tracking-tighter">ID Registrasi / Paspor <span class="text-red-500">*</span></label>
                                    <button type="button" id="generateSkuBtn" class="text-[10px] font-black text-emerald-600 bg-emerald-50 px-2 py-1 rounded-lg hover:bg-emerald-600 hover:text-white transition">
                                        <i class="fas fa-magic mr-1"></i> AUTO ID
                                    </button>
                                </div>
                                <input type="text" id="sku" name="sku" value="{{ old('sku') }}" required
                                       class="w-full px-5 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 font-mono text-sm dark:bg-gray-700 dark:text-white outline-none shadow-inner"
                                       placeholder="ID Keberangkatan">
                                @error('sku') <p class="mt-2 text-xs text-red-600 font-bold">{{ $message }}</p> @enderror
                            </div>

                            <!-- Unit (Satuan) -->
                            <div class="space-y-2">
                                <label for="unit" class="text-sm font-bold text-slate-700 dark:text-gray-300">Tipe Pendaftaran <span class="text-red-500">*</span></label>
                                <select id="unit" name="unit" required
                                        class="w-full px-5 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 font-bold dark:bg-gray-700 dark:text-white outline-none cursor-pointer">
                                    <option value="pax" {{ old('unit') == 'pax' ? 'selected' : '' }}>Pax (Perorangan)</option>
                                    <option value="group" {{ old('unit') == 'group' ? 'selected' : '' }}>Grup / Keluarga</option>
                                </select>
                            </div>

                            <!-- Category (Program Paket) -->
                            <div class="space-y-2">
                                <label for="category_id" class="text-sm font-bold text-slate-700 dark:text-gray-300">Program Paket Umroh <span class="text-red-500">*</span></label>
                                <select id="category_id" name="category_id" required
                                        class="w-full px-5 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 font-bold dark:bg-gray-700 dark:text-white outline-none cursor-pointer">
                                    <option value="">Pilih Program Paket</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Supplier (Agen) -->
                            <div class="space-y-2">
                                <label for="supplier_id" class="text-sm font-bold text-slate-700 dark:text-gray-300">Agen / Kantor Cabang</label>
                                <select id="supplier_id" name="supplier_id"
                                        class="w-full px-5 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 font-bold dark:bg-gray-700 dark:text-white outline-none cursor-pointer">
                                    <option value="">Pendaftaran Pusat</option>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                            {{ $supplier->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Section: Biaya & Kuota -->
                    <div class="p-8 border border-slate-100 rounded-3xl bg-slate-50/50 dark:bg-gray-800/50 dark:border-gray-700">
                        <h3 class="text-xs font-black text-amber-600 dark:text-amber-400 mb-6 uppercase tracking-[0.2em]">
                            <i class="fas fa-money-bill-wave mr-2"></i> Administrasi Biaya & Seat
                        </h3>
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <!-- Purchase Price (HPP) -->
                            <div class="space-y-2">
                                <label for="purchase_price" class="text-sm font-bold text-slate-700 dark:text-gray-300 uppercase tracking-tighter">Biaya Pokok (HPP) <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 font-black text-xs">Rp</span>
                                    <input type="hidden" id="purchase_price_raw" name="purchase_price" value="{{ old('purchase_price', '0') }}">
                                    <input type="text" id="purchase_price_display" value="{{ old('purchase_price', '0') }}" required
                                           class="w-full pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 font-black dark:bg-gray-700 dark:text-white outline-none">
                                </div>
                            </div>

                            <!-- Selling Price (Harga Paket) -->
                            <div class="space-y-2">
                                <label for="selling_price" class="text-sm font-bold text-slate-700 dark:text-gray-300 uppercase tracking-tighter">Harga Jual Paket <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 font-black text-xs">Rp</span>
                                    <input type="hidden" id="selling_price_raw" name="selling_price" value="{{ old('selling_price', '0') }}">
                                    <input type="text" id="selling_price_display" value="{{ old('selling_price', '0') }}" required
                                           class="w-full pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 font-black dark:bg-gray-700 dark:text-white outline-none shadow-sm">
                                </div>
                                <div id="profitMargin" class="mt-2 text-[10px] font-bold text-emerald-600 hidden">
                                    <i class="fas fa-chart-line mr-1"></i> Estimasi Margin: <span id="marginAmount"></span> (<span id="marginPercent"></span>%)
                                </div>
                            </div>

                            <!-- Current Stock (Kuota Awal) -->
                            <div class="space-y-2">
                                <label for="current_stock" class="text-sm font-bold text-slate-700 dark:text-gray-300">Kuota Awal Seat <span class="text-red-500">*</span></label>
                                <input type="number" id="current_stock" name="current_stock" value="{{ old('current_stock', '0') }}" min="0" required
                                       class="w-full px-5 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 font-black dark:bg-gray-700 dark:text-white outline-none">
                            </div>

                            <!-- Minimum Stock (Batas Min) -->
                            <div class="space-y-2">
                                <label for="min_stock" class="text-sm font-bold text-slate-700 dark:text-gray-300">Batas Kuota Minimum <span class="text-red-500">*</span></label>
                                <input type="number" id="min_stock" name="min_stock" value="{{ old('min_stock', '0') }}" min="0" required
                                       class="w-full px-5 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 font-black dark:bg-gray-700 dark:text-white outline-none">
                                <p class="mt-1 text-[10px] text-slate-400 font-medium italic">*Sistem akan memberi peringatan jika seat sisa angka ini.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="p-8 border border-slate-100 rounded-3xl bg-slate-50/50 dark:bg-gray-800/50 dark:border-gray-700">
                        <h3 class="text-xs font-black text-purple-600 dark:text-purple-400 mb-6 uppercase tracking-[0.2em]">
                            <i class="fas fa-sticky-note mr-2"></i> Rincian / Catatan Jamaah
                        </h3>
                        <div class="space-y-2">
                            <textarea id="description" name="description" rows="5"
                                      class="w-full px-5 py-4 bg-white border border-slate-200 rounded-2xl focus:ring-2 focus:ring-emerald-500 font-medium dark:bg-gray-700 dark:text-white outline-none"
                                      placeholder="Tuliskan spesifikasi berkas (paspor, visa), permintaan khusus kamar, atau informasi kesehatan jamaah...">{{ old('description') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Foto & Panduan -->
                <div class="lg:col-span-4 space-y-8">
                    <div class="sticky top-24">
                        <div class="p-8 border border-slate-100 rounded-[2rem] bg-white shadow-sm dark:bg-gray-800/50 dark:border-gray-700">
                            <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-6 flex items-center">
                                <i class="fas fa-camera mr-2"></i> Foto Jamaah / Berkas
                            </h3>

                            <!-- Image Preview -->
                            <div class="mb-6 group relative">
                                <img id="imagePreview" class="w-full aspect-square object-cover rounded-3xl border-4 border-white shadow-lg bg-slate-100" src="https://ui-avatars.com/api/?name=Jamaah&background=f1f5f9&color=cbd5e1&size=256" alt="Preview">
                                <button type="button" id="removeImageBtn" class="absolute -top-2 -right-2 p-2 bg-red-500 text-white rounded-full shadow-lg hover:bg-red-600 transition" style="display: none;">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>

                            <!-- Upload Button -->
                            <div class="space-y-4">
                                <input type="file" id="image" name="image" accept="image/*" class="hidden">
                                <label for="image" class="cursor-pointer group block">
                                    <div class="flex flex-col items-center justify-center w-full py-6 px-4 bg-emerald-50 border-2 border-emerald-100 border-dashed rounded-2xl group-hover:bg-emerald-100 transition-all">
                                        <i class="fas fa-cloud-upload-alt text-2xl text-emerald-600 mb-2"></i>
                                        <span class="text-xs font-black text-emerald-700 uppercase tracking-widest">Unggah Berkas</span>
                                    </div>
                                </label>
                                <p class="text-center text-[10px] text-slate-400 font-bold uppercase tracking-tighter">Format: JPG, PNG • Maks: 2MB</p>
                            </div>
                        </div>

                        <!-- Panduan Cepat -->
                        <div class="mt-8 p-6 bg-emerald-900 rounded-[2rem] text-white shadow-xl relative overflow-hidden">
                            <div class="relative z-10">
                                <h4 class="text-[10px] font-black uppercase tracking-widest text-emerald-400 mb-4">Langkah Input:</h4>
                                <ul class="text-[11px] font-bold space-y-3">
                                    <li class="flex items-start"><i class="fas fa-check-circle mr-2 mt-0.5 text-emerald-400"></i> Pastikan nama sesuai Paspor/KTP.</li>
                                    <li class="flex items-start"><i class="fas fa-check-circle mr-2 mt-0.5 text-emerald-400"></i> Pilih program paket dengan teliti.</li>
                                    <li class="flex items-start"><i class="fas fa-check-circle mr-2 mt-0.5 text-emerald-400"></i> Harga jual harus mencakup profit biro.</li>
                                </ul>
                            </div>
                            <i class="fas fa-kaaba absolute -right-4 -bottom-4 text-white/5 text-8xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-between mt-12 pt-8 border-t border-slate-50 dark:border-gray-700">
                <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic">
                    <i class="fas fa-info-circle mr-1"></i> Data dienkripsi secara aman
                </div>
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.products.index') }}"
                       class="px-8 py-3 text-sm font-bold text-slate-400 hover:text-slate-600 transition">
                        Batal
                    </a>
                    <button type="submit"
                            class="px-10 py-4 bg-emerald-600 text-white font-black rounded-2xl hover:bg-emerald-700 shadow-xl shadow-emerald-100 transition transform hover:-translate-y-1 active:scale-95">
                        <i class="fas fa-save mr-2"></i> Daftarkan Jamaah
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        // KODE JAVASCRIPT TETAP SAMA (Hanya Label Pesan yang berubah)
        
        // Generate SKU
        document.getElementById('generateSkuBtn').addEventListener('click', function() {
            const name = document.getElementById('name').value;
            const category = document.getElementById('category_id').value;

            if (!name) {
                alert('Harap isi nama jamaah terlebih dahulu');
                return;
            }

            if (!category) {
                alert('Harap pilih program paket terlebih dahulu');
                return;
            }

            const categoryPrefix = document.querySelector(`#category_id option[value="${category}"]`).text.substring(0, 3).toUpperCase();
            const namePrefix = name.substring(0, 3).toUpperCase();
            const randomNum = Math.floor(1000 + Math.random() * 9000);

            const sku = `${categoryPrefix}-${namePrefix}-${randomNum}`;
            document.getElementById('sku').value = sku;
        });

        // Image Preview
        document.getElementById('image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById('imagePreview').src = event.target.result;
                    document.getElementById('removeImageBtn').style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });

        // Remove Image
        document.getElementById('removeImageBtn').addEventListener('click', function() {
            document.getElementById('image').value = '';
            document.getElementById('imagePreview').src = 'https://ui-avatars.com/api/?name=Jamaah&background=f1f5f9&color=cbd5e1&size=256';
            this.style.display = 'none';
        });

        // Currency Formatting (Logic sama persis)
        const purchasePriceInput = document.getElementById('purchase_price_display');
        const sellingPriceInput = document.getElementById('selling_price_display');
        const purchasePriceRaw = document.getElementById('purchase_price_raw');
        const sellingPriceRaw = document.getElementById('selling_price_raw');
        const profitMargin = document.getElementById('profitMargin');

        function formatCurrency(input, rawInput) {
            let value = input.value.replace(/[^0-9]/g, '');
            value = value === '' ? '0' : value;
            rawInput.value = value;
            input.value = new Intl.NumberFormat('id-ID').format(value);
        }

        function calculateProfitMargin() {
            const purchase = parseInt(purchasePriceRaw.value) || 0;
            const selling = parseInt(sellingPriceRaw.value) || 0;

            if (purchase > 0 && selling > 0) {
                const margin = selling - purchase;
                const percent = ((margin / purchase) * 100).toFixed(2);

                document.getElementById('marginAmount').textContent = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(margin);

                document.getElementById('marginPercent').textContent = percent;
                profitMargin.classList.remove('hidden');
            } else {
                profitMargin.classList.add('hidden');
            }
        }

        purchasePriceInput.addEventListener('input', function() {
            formatCurrency(purchasePriceInput, purchasePriceRaw);
            calculateProfitMargin();
        });

        sellingPriceInput.addEventListener('input', function() {
            formatCurrency(sellingPriceInput, sellingPriceRaw);
            calculateProfitMargin();
        });

        formatCurrency(purchasePriceInput, purchasePriceRaw);
        formatCurrency(sellingPriceInput, sellingPriceRaw);
        calculateProfitMargin();
    </script>
@endpush