<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil beberapa kategori & supplier yang sudah diset di seeder lain
        $ekonomis   = Category::where('name', 'like', 'Paket Umroh Ekonomis%')->first();
        $vip        = Category::where('name', 'like', 'Paket Umroh VIP%')->first();
        $keluarga   = Category::where('name', 'like', 'Paket Umroh Keluarga%')->first();
        $ramadhan   = Category::where('name', 'like', 'Paket Umroh Ramadhan%')->first();

        $pusat      = Supplier::where('email', 'pusat@almadinah-haromain.test')->first();
        $bandung    = Supplier::where('email', 'bandung@almadinah-haromain.test')->first();
        $solo       = Supplier::where('email', 'mitra.solo@almadinah-haromain.test')->first();

        $jamaah = [
            [
                'name'          => 'Ahmad Fikri',
                'sku'           => 'UMR-2025-0001',
                'category_id'   => optional($ekonomis)->id,
                'supplier_id'   => optional($pusat)->id,
                'description'   => 'Jamaah reguler keberangkatan awal tahun.',
                'purchase_price'=> 22000000,
                'selling_price' => 25000000,
                'current_stock' => 1,
                'min_stock'     => 0,
                'unit'          => 'pax',
            ],
            [
                'name'          => 'Siti Nurjanah',
                'sku'           => 'UMR-2025-0002',
                'category_id'   => optional($vip)->id,
                'supplier_id'   => optional($pusat)->id,
                'description'   => 'Paket VIP dengan kamar dekat Masjidil Haram.',
                'purchase_price'=> 40000000,
                'selling_price' => 45000000,
                'current_stock' => 1,
                'min_stock'     => 0,
                'unit'          => 'pax',
            ],
            [
                'name'          => 'Budi Santoso',
                'sku'           => 'UMR-2025-0003',
                'category_id'   => optional($keluarga)->id,
                'supplier_id'   => optional($bandung)->id,
                'description'   => 'Berangkat bersama keluarga, 4 orang dalam satu kamar.',
                'purchase_price'=> 30000000,
                'selling_price' => 35000000,
                'current_stock' => 1,
                'min_stock'     => 0,
                'unit'          => 'pax',
            ],
            [
                'name'          => 'Rahmawati',
                'sku'           => 'UMR-2025-0004',
                'category_id'   => optional($ramadhan)->id,
                'supplier_id'   => optional($solo)->id,
                'description'   => 'Program umroh khusus Ramadhan (10 akhir).',
                'purchase_price'=> 28000000,
                'selling_price' => 32000000,
                'current_stock' => 1,
                'min_stock'     => 0,
                'unit'          => 'pax',
            ],
            [
                'name'          => 'Hasan Al Habsyi',
                'sku'           => 'UMR-2025-0005',
                'category_id'   => optional($vip)->id,
                'supplier_id'   => optional($pusat)->id,
                'description'   => 'Paket VIP plus kebutuhan kursi roda dan pendamping khusus.',
                'purchase_price'=> 42000000,
                'selling_price' => 47000000,
                'current_stock' => 1,
                'min_stock'     => 0,
                'unit'          => 'pax',
            ],
        ];

        foreach ($jamaah as $data) {
            Product::updateOrCreate(
                ['sku' => $data['sku']],
                $data
            );
        }
    }
}

