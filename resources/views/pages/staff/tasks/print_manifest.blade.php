<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Manifest - {{ $product->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .no-print { display: none; }
            body { background: white; }
        }
    </style>
</head>
<body class="bg-gray-100 p-10" onload="window.print()">
    <div class="max-w-3xl mx-auto bg-white p-10 rounded-xl shadow-sm border border-gray-200 relative">
        <!-- Header -->
        <div class="flex justify-between items-center border-b-2 border-emerald-600 pb-6 mb-8">
            <div>
                <h1 class="text-2xl font-black text-gray-800 uppercase">Manifes Jamaah</h1>
                <p class="text-sm text-emerald-600 font-bold">Al Madinah Haromain Tour & Travel</p>
            </div>
            <div class="text-right">
                <p class="text-xs text-gray-400 uppercase font-bold">Tanggal Cetak</p>
                <p class="text-sm font-bold">{{ date('d/m/Y H:i') }}</p>
            </div>
        </div>

        <div class="grid grid-cols-3 gap-8">
            <!-- Foto -->
            <div class="col-span-1">
                <div class="w-full aspect-[3/4] bg-gray-50 border-2 border-emerald-100 rounded-lg overflow-hidden">
                    <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://ui-avatars.com/api/?name='.urlencode($product->name).'&background=10b981&color=fff' }}" class="w-full h-full object-cover">
                </div>
            </div>

            <!-- Data -->
            <div class="col-span-2 space-y-4">
                <div>
                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Nama Lengkap</label>
                    <p class="text-lg font-black text-gray-800">{{ $product->name }}</p>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">No. Registrasi</label>
                        <p class="text-sm font-mono font-bold">{{ $product->sku }}</p>
                    </div>
                    <div>
                        <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Sisa Seat</label>
                        <p class="text-sm font-bold">{{ $product->current_stock }} Pax</p>
                    </div>
                </div>
                <div>
                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Program Paket</label>
                    <p class="text-sm font-bold text-emerald-700">{{ $product->category->name ?? '-' }}</p>
                </div>
                <div>
                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Agen Terdaftar</label>
                    <p class="text-sm font-bold">{{ $product->supplier->name ?? 'Kantor Pusat' }}</p>
                </div>
            </div>
        </div>

        <div class="mt-12 pt-8 border-t border-dashed border-gray-200 flex justify-between items-center">
            <div class="text-[10px] text-gray-400 italic">
                * Dokumen ini sah dikeluarkan oleh sistem operasional biro.
            </div>
            <div class="w-24 h-24 bg-gray-100 flex items-center justify-center rounded border border-gray-200">
                <span class="text-[8px] text-gray-300">QR CODE</span>
            </div>
        </div>
    </div>

    <div class="mt-8 text-center no-print">
        <button onclick="window.close()" class="px-6 py-2 bg-gray-800 text-white rounded-full text-xs font-bold uppercase tracking-widest">Tutup Halaman</button>
    </div>
</body>
</html>