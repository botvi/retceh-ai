<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Package;

class PackagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $packages = [
            [
                'name' => 'Starter',
                'price' => 15000,
                'credits' => 50,
                'features' => [
                    '50 Gelas Kopi',
                    'Prioritas pembuatan standar',
                    'Akses seluruh ukuran studio'
                ],
                'is_recommended' => false
            ],
            [
                'name' => 'Pro',
                'price' => 45000,
                'credits' => 200,
                'features' => [
                    '200 Gelas Kopi',
                    'Prioritas pembuatan tinggi',
                    'Akses seluruh ukuran studio',
                    'Lisensi penggunaan komersial'
                ],
                'is_recommended' => true
            ],
            [
                'name' => 'Enterprise',
                'price' => 99000,
                'credits' => 1000,
                'features' => [
                    '1000 Gelas Kopi',
                    'Prioritas pembuatan prioritas utama',
                    'Akses seluruh ukuran studio',
                    'Lisensi komersial & tanpa watermark'
                ],
                'is_recommended' => false
            ]
        ];

        foreach ($packages as $pkg) {
            Package::updateOrCreate(['name' => $pkg['name']], $pkg);
        }
    }
}
