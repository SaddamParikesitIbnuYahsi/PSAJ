<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $packages = [
            [
                'name' => 'Paket Umroh Ekonomis (Reguler) - 9/12 Hari',
                'description' => 'Hotel ⭐3 dekat Haram, tiket PP, makan 3x, city tour Makkah & Madinah, perlengkapan umroh.',
            ],
            [
                'name' => 'Paket Umroh VIP (Premium) - 12/15 Hari',
                'description' => 'Hotel ⭐5 dekat/area Masjid, full service, makan 4x + snack, city tour premium, perlengkapan lengkap, bimbingan ustadz/mutawwif.',
            ],
            [
                'name' => 'Paket Umroh Keluarga (Executive) - 14/15 Hari',
                'description' => 'Hotel ⭐4 dekat Haram, tiket PP, makan 3x, wisata religi, opsi kamar khusus keluarga.',
            ],
            [
                'name' => 'Paket Umroh Ramadhan',
                'description' => 'Program khusus bulan Ramadhan (jadwal mengikuti ketersediaan seat & maskapai).',
            ],
            [
                'name' => 'Paket Umroh Plus Turki',
                'description' => 'Umroh + city tour Turki (Istanbul) (opsional dan mengikuti musim keberangkatan).',
            ],
        ];

        foreach ($packages as $package) {
            Category::updateOrCreate(['name' => $package['name']], $package);
        }
    }
}