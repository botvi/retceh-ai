<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ShowcaseItem;

class ShowcaseItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $showcaseItems = [
            [
                'title' => 'Cold Brew Coffee',
                'description' => 'Pencahayaan flat berganti kemegahan studio warm amber backlight.',
                'image_before' => 'studioai/images/coffee_before.png',
                'image_after' => 'studioai/images/coffee_after.png',
                'label_before' => 'Foto Asli',
                'label_after' => 'Hasil AI',
                'category_label' => 'Kopi Botol'
            ],
            [
                'title' => 'Organic Face Serum',
                'description' => 'Tampil segar di atas panggung riak air jernih dan daun monstera.',
                'image_before' => 'studioai/images/serum_before.png',
                'image_after' => 'studioai/images/serum_after.png',
                'label_before' => 'Foto Asli',
                'label_after' => 'Hasil AI',
                'category_label' => 'Botol Serum'
            ],
            [
                'title' => 'Crispy Potato Chips',
                'description' => 'Kemasan berdiri gagah dengan kepingan kentang melayang di udara.',
                'image_before' => 'studioai/images/chips_before.png',
                'image_after' => 'studioai/images/chips_after.png',
                'label_before' => 'Foto Asli',
                'label_after' => 'Hasil AI',
                'category_label' => 'Kemasan Snack'
            ]
        ];

        foreach ($showcaseItems as $item) {
            ShowcaseItem::updateOrCreate(['title' => $item['title']], $item);
        }
    }
}
