<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Testimoni;
use App\Models\ShowcaseItem;
use App\Models\Setting;

class IndexController extends Controller
{
    public function index()
    {
        $hero_title = Setting::getValue('landing_hero_title', 'Ubah Foto Produk');
        $hero_subtitle = Setting::getValue('landing_hero_subtitle', 'Lewati biaya sewa studio foto yang mahal.');
        
        $words_str = Setting::getValue('landing_hero_words', 'Berkelas.,Premium.,Menjual.,Estetik.');
        $hero_words = array_filter(array_map('trim', explode(',', $words_str)));

        $showcase_items = ShowcaseItem::all();
        $testimonis = Testimoni::with('user')->orderBy('created_at', 'desc')->get();

        return view('pageuser.landing.index', compact('hero_title', 'hero_subtitle', 'hero_words', 'showcase_items', 'testimonis'));
    }
}