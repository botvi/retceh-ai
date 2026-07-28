<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimoni;
use App\Models\User;

class TestimonisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        if (!$user) {
            $user = User::create([
                'name' => 'Seeded User',
                'username' => 'user1',
                'email' => 'user@gmail.com',
                'no_wa' => '08123456789',
                'role' => 'user',
                'password' => bcrypt('password'),
                'credits' => 100
            ]);
        }

        $reviews = [
            [
                'user_id' => $user->id,
                'name' => 'Budi Santoso',
                'role' => 'Toko Kopi Lokal',
                'pesan' => 'Sangat menghemat budget! Cukup unggah foto HP, hasilnya langsung siap tayang di Instagram.',
                'rating' => 5,
                'status' => 'approved'
            ],
            [
                'user_id' => $user->id,
                'name' => 'Dewi Lestari',
                'role' => 'Kosmetik Herbal',
                'pesan' => 'Detail kemasannya 100% akurat. Pantulan cahaya dan bayangan sangat halus seperti asli.',
                'rating' => 5,
                'status' => 'approved'
            ],
            [
                'user_id' => $user->id,
                'name' => 'Roni Wijaya',
                'role' => 'Digital Marketer',
                'pesan' => 'Proses pembuatan cepat sekali. Kualitas rasionya mantap untuk membuat banner iklan Shopee.',
                'rating' => 5,
                'status' => 'approved'
            ],
            [
                'user_id' => $user->id,
                'name' => 'Siti Rahma',
                'role' => 'Owner Hijab Brand',
                'pesan' => 'Latar studio estetik sekali. Warna latar belakang sangat serasi dengan warna produk hijab saya.',
                'rating' => 5,
                'status' => 'approved'
            ],
            [
                'user_id' => $user->id,
                'name' => 'Andi Pratama',
                'role' => 'Snack Distributor',
                'pesan' => 'Pencahayaannya mantap. Sangat membantu membuat aset promosi katalog produk baru.',
                'rating' => 5,
                'status' => 'approved'
            ]
        ];

        foreach ($reviews as $rev) {
            Testimoni::create($rev);
        }
    }
}
