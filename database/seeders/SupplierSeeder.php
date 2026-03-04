<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        // Agen / mitra utama pusat
        Supplier::updateOrCreate(
            ['email' => 'pusat@almadinah-haromain.test'],
            [
                'name'           => 'PT Al Madinah Haromain Travel',
                'address'        => 'Jl. Sudirman No. 12, Jakarta Pusat',
                'contact_person' => 'Ustadz Ahmad Fauzi',
                'phone'          => '0812-1111-2222',
            ]
        );

        // Cabang / mitra di Bandung
        Supplier::updateOrCreate(
            ['email' => 'bandung@almadinah-haromain.test'],
            [
                'name'           => 'Al Madinah Haromain Cabang Bandung',
                'address'        => 'Jl. Asia Afrika No. 8, Bandung',
                'contact_person' => 'Sdr. Ridwan Hakim',
                'phone'          => '0813-3333-4444',
            ]
        );

        // Agen reseller
        Supplier::updateOrCreate(
            ['email' => 'mitra.solo@almadinah-haromain.test'],
            [
                'name'           => 'Mitra Umroh Solo Barokah',
                'address'        => 'Jl. Slamet Riyadi No. 45, Solo',
                'contact_person' => 'Ibu Siti Nurjanah',
                'phone'          => '0821-5555-6666',
            ]
        );
    }
}

