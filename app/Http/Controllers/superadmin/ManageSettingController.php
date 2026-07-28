<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use RealRashid\SweetAlert\Facades\Alert;

class ManageSettingController extends Controller
{
    public function index()
    {
        $settings = [
            'poyo_api_key'          => Setting::getValue('poyo_api_key'),
            'poyo_base_url'         => Setting::getValue('poyo_base_url'),
            'vision_prompt'         => Setting::getValue('vision_prompt'),
            'secret_prompt'         => Setting::getValue('secret_prompt'),
            'default_quality'       => Setting::getValue('default_quality', 'low'),
            'credits_per_generation'=> Setting::getValue('credits_per_generation', 8),
            'landing_hero_title'    => Setting::getValue('landing_hero_title'),
            'landing_hero_subtitle' => Setting::getValue('landing_hero_subtitle'),
            'landing_hero_words'    => Setting::getValue('landing_hero_words'),
            // Payment Gateway (QRIS KlikQris)
            'qris_api_key'          => Setting::getValue('qris_api_key'),
            'qris_merchant_id'      => Setting::getValue('qris_merchant_id'),
            'qris_webhook_url'      => Setting::getValue('qris_webhook_url'),
        ];

        return view('pagesuperadmin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'poyo_api_key'           => 'required|string',
            'poyo_base_url'          => 'required|url',
            'vision_prompt'          => 'required|string',
            'secret_prompt'          => 'required|string',
            'default_quality'        => 'required|string',
            'credits_per_generation' => 'required|integer|min:0',
            'landing_hero_title'     => 'required|string',
            'landing_hero_subtitle'  => 'required|string',
            'landing_hero_words'     => 'required|string',
            // Payment Gateway
            'qris_api_key'           => 'nullable|string',
            'qris_merchant_id'       => 'nullable|string',
            'qris_webhook_url'       => 'nullable|url',
        ]);

        foreach ($request->only([
            'poyo_api_key', 'poyo_base_url', 'vision_prompt', 'secret_prompt',
            'default_quality', 'credits_per_generation', 'landing_hero_title',
            'landing_hero_subtitle', 'landing_hero_words',
            'qris_api_key', 'qris_merchant_id', 'qris_webhook_url',
        ]) as $key => $value) {
            Setting::setValue($key, $value);
        }

        Alert::success('Berhasil', 'Konfigurasi website berhasil diperbarui!');
        return redirect()->route('manage-settings.index');
    }
}
