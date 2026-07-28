<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            'poyo_api_key' => 'sk-lyCsygGVwzViUD8SrLkpn_WmlULLFgzib-nTvMcBIzb91Bxd0_O-AoqCbqqdPa',
            'poyo_base_url' => 'https://api.poyo.ai',
            'vision_prompt' => 'Identify the primary product in this image. Answer with a concise noun phrase of 2-5 words. For example: "a silver espresso machine", "a black leather shoe", or "a glass jar of honey". Output ONLY the noun phrase, do not include any other words, prefixes like "Description:", or punctuation.',
            'secret_prompt' => "The uploaded image is the ONLY product reference. Preserve the product branding, logo, typography, and graphics with absolute accuracy and keep every printed label element identical to the original. However, you MUST automatically clean up and restore the physical state of the product: if the product packaging is wrinkled, crumpled, torn, dusty, damaged, or slightly slanted/crooked, repair the tears, smooth out the wrinkles, straighten the slant, and tidy up the packaging so it appears brand new, perfectly aligned, symmetrical, and in pristine showroom condition.\n\nYour task is to transform this into a premium commercial advertising photograph.\n\nBefore generating the scene, carefully analyze the uploaded product and automatically determine:\n\n• The dominant and secondary colors of the packaging to create a harmonious color palette.\n• The product category (food, beverage, cosmetic, supplement, snack, coffee, tea, skincare, perfume, etc.).\n• Any ingredients, flavors, fruits, herbs, spices, flowers, chocolate, milk, coffee beans, leaves, honey, vanilla, nuts, berries, or natural elements shown or implied by the packaging.\n• The visual theme suggested by the packaging design, illustrations, icons, patterns, textures, and branding.\n• The target audience and premium positioning suggested by the packaging.\n• The appropriate mood and atmosphere.\n\nBased on this analysis, automatically create the best possible advertising scene.\n\nRequirements:\n\n- Build a luxurious, realistic, high-end commercial product photography composition.\n- Use a background inspired by the packaging colors, gradients, textures, and overall branding.\n- Place the product naturally as the main hero subject.\n- Generate elegant supporting props only if they match the ingredients or theme inferred from the packaging.\n- If fruit or ingredients appear on the package, include realistic fresh versions naturally in the scene.\n- If the packaging suggests a specific environment (nature, tropical, premium café, luxury skincare, freshness, wellness, organic, etc.), recreate that atmosphere.\n- Use premium lighting with cinematic highlights and soft shadows.\n- Add realistic reflections only when appropriate.\n- Maintain excellent visual hierarchy with the product remaining the strongest focal point.\n- Use balanced composition following commercial advertising standards.\n- Create natural foreground and background depth for a premium look.\n- Apply subtle atmospheric effects only when suitable (mist, water droplets, floating particles, light rays, steam, splashes, leaves, flowers, etc.).\n- Everything surrounding the product must reinforce the brand story suggested by the packaging.\n\nQuality:\n\nUltra realistic.\nCommercial advertising photography.\nLuxury branding.\nNatural materials.\nHighly detailed.\nPhotorealistic.\nProfessional studio quality.\nPremium color grading.\nSharp focus on the product.\nBeautiful depth of field.\nMagazine-quality product advertisement.\n8K resolution.\nExtremely realistic textures.\nElegant composition.\n\nImportant:\n\nNever invent a different flavor, ingredient, logo, brand identity, or packaging.\nNever replace the product.\nNever modify the product design.\nOnly improve the surrounding environment, lighting, composition, styling, and presentation while keeping the product perfectly authentic.Please note that my current product photos are...",
            'default_quality' => 'low',
            'credits_per_generation' => '8',
            'landing_hero_title' => 'Ubah Foto Produk',
            'landing_hero_subtitle' => 'Lewati biaya sewa studio foto yang mahal. Cukup unggah foto produk Anda dan buat desain foto iklan premium berkualitas komersial secara instan dengan kecerdasan AI.',
            'landing_hero_words' => 'Berkelas.,Premium.,Menjual.,Estetik.'
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
