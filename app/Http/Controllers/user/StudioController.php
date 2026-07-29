<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\Setting;
use App\Models\AiGeneration;
use App\Models\User;

class StudioController extends Controller
{
    public function index(Request $request)
    {
        return view('pageuser.studio.index');
    }

    /**
     * Proxy: Analyze uploaded image with Poyo AI and return category suggestions.
     * Downloads the image server-side and sends as Base64 to avoid 403 on remote URLs.
     */
    public function suggest(Request $request)
    {
        $request->validate([
            'image_url' => 'required|string',
        ]);

        $apiKey  = Setting::getValue('poyo_api_key', '');
        $baseUrl = Setting::getValue('poyo_base_url', 'https://api.poyo.ai');

        if (empty($apiKey)) {
            return response()->json(['success' => false, 'error' => 'API key not configured'], 500);
        }

        // Download image and convert to base64 Data URI
        try {
            $imgResponse = Http::withOptions(['verify' => false])
                ->timeout(15)
                ->get($request->image_url);

            if (!$imgResponse->successful()) {
                return response()->json(['success' => false, 'error' => 'Cannot download image: ' . $imgResponse->status()], 422);
            }

            $contentType = $imgResponse->header('Content-Type') ?: 'image/jpeg';
            // Normalize mime type
            if (str_contains($contentType, 'webp')) $contentType = 'image/webp';
            elseif (str_contains($contentType, 'png'))  $contentType = 'image/png';
            else $contentType = 'image/jpeg';

            $base64 = base64_encode($imgResponse->body());
            $dataUri = "data:{$contentType};base64,{$base64}";

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Image download failed: ' . $e->getMessage()], 500);
        }

        $prompt = 'You are a product categorization assistant. Look at this product image and return exactly 7 to 8 relevant product category suggestions.' . "\n\n" .
                  'Rules:' . "\n" .
                  '- Each suggestion MUST be in the format: "English Name (Nama Indonesia)"' . "\n" .
                  '- Examples: "Coffee (Kopi)", "Skincare Serum (Serum Perawatan Kulit)", "Wristwatch (Jam Tangan)", "Snack (Camilan)"' . "\n" .
                  '- Keep suggestions short (1-4 words each side)' . "\n" .
                  '- Be specific to what you see in the image' . "\n" .
                  '- Return ONLY a JSON array of strings, no explanation, no markdown. Example: ["Coffee (Kopi)", "Beverage (Minuman)"]';

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type'  => 'application/json',
            ])
            ->withOptions(['verify' => false])
            ->timeout(30)
            ->post("$baseUrl/v1/responses", [
                'model' => 'gpt-5',
                'input' => [
                    [
                        'role' => 'user',
                        'content' => [
                            ['type' => 'input_text',  'text'      => $prompt],
                            ['type' => 'input_image', 'image_url' => $dataUri],
                        ],
                    ],
                ],
                'max_output_tokens' => 300,
            ]);

            if (!$response->successful()) {
                \Log::error('Poyo suggest API error', ['status' => $response->status(), 'body' => $response->body()]);
                return response()->json(['success' => false, 'error' => 'AI API error: ' . $response->status()], 500);
            }

            $data = $response->json();

            // Extract text output — loop all output items (first may be 'reasoning', text is in 'message' type)
            $text = '';
            $allOutputs = $data['output'] ?? $data['data']['output'] ?? [];
            foreach ($allOutputs as $item) {
                if (($item['type'] ?? '') === 'message' && !empty($item['content'])) {
                    foreach ($item['content'] as $block) {
                        if (($block['type'] ?? '') === 'output_text' && isset($block['text'])) {
                            $text = $block['text'];
                            break 2;
                        }
                    }
                }
            }

            // Parse JSON array from text
            $suggestions = [];
            if (!empty($text) && preg_match('/\[.*\]/s', $text, $match)) {
                $suggestions = json_decode($match[0], true) ?? [];
            }

            return response()->json(['success' => true, 'suggestions' => $suggestions]);

        } catch (\Exception $e) {
            \Log::error('Poyo suggest exception', ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Upload product image to POYO stream endpoint.
     */
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:5120', // 5MB max
        ]);

        $apiKey = Setting::getValue('poyo_api_key', 'sk-lyCsygGVwzViUD8SrLkpn_WmlULLFgzib-nTvMcBIzb91Bxd0_O-AoqCbqqdPa');
        $baseUrl = Setting::getValue('poyo_base_url', 'https://api.poyo.ai');

        $file = $request->file('file');
        
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
            ])
            ->withOptions(['verify' => false])
            ->attach('file', file_get_contents($file->getPathname()), $file->getClientOriginalName())
            ->post("$baseUrl/api/common/upload/stream", [
                'file_name' => $file->getClientOriginalName(),
            ]);

            if ($response->successful()) {
                $resData = $response->json();
                if (isset($resData['data']['file_url'])) {
                    return response()->json([
                        'success' => true,
                        'file_url' => $resData['data']['file_url']
                    ]);
                }
            }
            
            return response()->json([
                'success' => false,
                'error' => 'Gagal mengunggah ke server API: ' . $response->body()
            ], 400);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Koneksi API bermasalah: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Submit AI photo design generation task.
     */
    public function submit(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'require_login' => true,
                'error' => 'Silakan login terlebih dahulu untuk membuat desain.'
            ], 401);
        }

        $request->validate([
            'image_urls' => 'required|array',
            'optional_note' => 'nullable|string',
            'edit_instruction' => 'nullable|string'
        ]);

        $user = Auth::user();
        $isEdit = $request->filled('edit_instruction');
        $requiredCredits = $isEdit ? 6 : 8;

        if ($user->credits < $requiredCredits) {
            return response()->json([
                'success' => false,
                'error' => 'Saldo Ignis Token tidak mencukupi'
            ], 400);
        }

        $apiKey = Setting::getValue('poyo_api_key', 'sk-lyCsygGVwzViUD8SrLkpn_WmlULLFgzib-nTvMcBIzb91Bxd0_O-AoqCbqqdPa');
        $baseUrl = Setting::getValue('poyo_base_url', 'https://api.poyo.ai');
        $visionPrompt = Setting::getValue('vision_prompt');
        $secretPrompt = Setting::getValue('secret_prompt');

        $imageUrl = $request->image_urls[0];
        $productDesc = 'produk utama';

        // 1. Identify product name via GPT-5 vision check
        try {
            $visionResponse = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json'
            ])
            ->withOptions(['verify' => false])
            ->post("$baseUrl/v1/responses", [
                'model' => 'gpt-5',
                'input' => [
                    [
                        'role' => 'user',
                        'content' => [
                            [
                                'type' => 'input_text',
                                'text' => $visionPrompt
                            ],
                            [
                                'type' => 'input_image',
                                'image_url' => $imageUrl
                            ]
                        ]
                    ]
                ],
                'max_output_tokens' => 50
            ]);

            if ($visionResponse->successful()) {
                $visionData = $visionResponse->json();
                if (isset($visionData['data']['output'][0]['content'][0]['text'])) {
                    $desc = trim($visionData['data']['output'][0]['content'][0]['text']);
                    if (!empty($desc)) {
                        $productDesc = rtrim(strtolower($desc), '.');
                    }
                }
            }
        } catch (\Exception $e) {
            // Keep default description if vision check fails
        }

        // 2. Format final prompt
        $optionalNote = $request->optional_note ? trim($request->optional_note) : '';
        $finalPrompt = $secretPrompt;
        $targetStr = "Please note that my current product photos are...";
        
        if (!empty($optionalNote)) {
            if (strpos($finalPrompt, $targetStr) !== false) {
                $finalPrompt = str_replace($targetStr, "Please note that my current product photos are " . $optionalNote, $finalPrompt);
            } else {
                $finalPrompt .= "\nPlease note that my current product photos are " . $optionalNote;
            }
        } else {
            $finalPrompt = str_replace($targetStr, "", $finalPrompt);
            $finalPrompt = rtrim($finalPrompt, "., ");
        }

        if ($isEdit) {
            $finalPrompt .= "\n\nCRITICAL EDIT INSTRUCTION: The user has requested to modify/edit the previously generated design image. Please modify the scene according to this edit instruction: " . $request->edit_instruction;
        }

        // 3. Submit generation task
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json'
            ])
            ->withOptions(['verify' => false])
            ->post("$baseUrl/api/generate/submit", [
                'model' => 'gpt-image-2-edit',
                'input' => [
                    'prompt' => $finalPrompt,
                    'image_urls' => $request->image_urls,
                    'quality' => Setting::getValue('default_quality', 'low'),
                    'size' => '1:1'
                ]
            ]);

            if ($response->successful()) {
                $resData = $response->json();
                if (isset($resData['data']['task_id'])) {
                    $taskId = $resData['data']['task_id'];

                    // Deduct credits
                    $user->credits -= $requiredCredits;
                    User::where('id', $user->id)->update(['credits' => $user->credits]);

                    // Store pending task in database
                    AiGeneration::create([
                        'user_id' => $user->id,
                        'original_image_path' => $imageUrl,
                        'generated_image_url' => null,
                        'category' => $optionalNote ?: ($isEdit ? 'Edit Desain' : 'Produk Utama'),
                        'prompt' => $finalPrompt,
                        'task_id' => $taskId,
                        'status' => 'pending'
                    ]);

                    return response()->json([
                        'success' => true,
                        'task_id' => $taskId,
                        'product_desc' => $productDesc,
                        'remaining_credits' => $user->credits
                    ]);
                }
            }

            return response()->json([
                'success' => false,
                'error' => 'Gagal mengirim tugas render: ' . $response->body()
            ], 400);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'API Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Poll status of the task.
     */
    public function status($taskId)
    {
        $apiKey = Setting::getValue('poyo_api_key', 'sk-lyCsygGVwzViUD8SrLkpn_WmlULLFgzib-nTvMcBIzb91Bxd0_O-AoqCbqqdPa');
        $baseUrl = Setting::getValue('poyo_base_url', 'https://api.poyo.ai');

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
            ])
            ->withOptions(['verify' => false])
            ->get("$baseUrl/api/generate/status/$taskId");

            if ($response->status() === 429) {
                return response()->json([
                    'success' => true,
                    'status' => 'processing',
                    'message' => 'Rate limit hit, polling continues'
                ]);
            }

            if ($response->successful()) {
                $resData = $response->json();
                $data = isset($resData['data']) ? $resData['data'] : $resData;
                $status = isset($data['status']) ? strtolower($data['status']) : 'running';

                if ($status === 'finished' || $status === 'succeed' || $status === 'success' || $status === 'completed') {
                    // Extract image URL
                    $finalUrl = null;
                    if (isset($data['files']) && count($data['files']) > 0) {
                        $resultFile = collect($data['files'])->firstWhere('file_type', 'image') ?: $data['files'][0];
                        $finalUrl = $resultFile['file_url'];
                    } elseif (isset($data['output']['url'])) {
                        $finalUrl = $data['output']['url'];
                    } elseif (isset($data['file_url'])) {
                        $finalUrl = $data['file_url'];
                    } elseif (isset($data['url'])) {
                        $finalUrl = $data['url'];
                    }

                    if ($finalUrl) {
                        // Update generation record
                        AiGeneration::where('task_id', $taskId)->update([
                            'status' => 'completed',
                            'generated_image_url' => $finalUrl
                        ]);

                        return response()->json([
                            'success' => true,
                            'status' => 'completed',
                            'file_url' => $finalUrl
                        ]);
                    }
                } elseif ($status === 'failed' || $status === 'error') {
                    $errMsg = isset($data['error_message']) ? $data['error_message'] : 'Gagal memproses di server render';
                    
                    AiGeneration::where('task_id', $taskId)->update([
                        'status' => 'failed'
                    ]);

                    return response()->json([
                        'success' => true,
                        'status' => 'failed',
                        'error_message' => $errMsg
                    ]);
                }

                return response()->json([
                    'success' => true,
                    'status' => $status
                ]);
            }

            return response()->json([
                'success' => false,
                'error' => 'Gagal mengambil status: ' . $response->body()
            ], 400);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'API Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Save generated image manually.
     */
    public function save(Request $request)
    {
        $request->validate([
            'original_image_path' => 'required|string',
            'generated_image_url' => 'required|string',
            'category' => 'nullable|string',
            'prompt' => 'nullable|string'
        ]);

        try {
            AiGeneration::create([
                'user_id' => Auth::id(),
                'original_image_path' => $request->original_image_path,
                'generated_image_url' => $request->generated_image_url,
                'category' => $request->category ?: 'Produk',
                'prompt' => $request->prompt,
                'status' => 'completed'
            ]);

            return response()->json([
                'success' => true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}