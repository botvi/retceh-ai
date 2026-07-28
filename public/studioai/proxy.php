<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

$apiKey = 'sk-lyCsygGVwzViUD8SrLkpn_WmlULLFgzib-nTvMcBIzb91Bxd0_O-AoqCbqqdPa';
$baseUrl = 'https://api.poyo.ai';

$action = isset($_GET['action']) ? $_GET['action'] : '';

// Helper function to send Curl requests
function sendCurlRequest($url, $method = 'GET', $headers = [], $postFields = null)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    if ($postFields !== null) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
    }

    // Optional: disable SSL verify if local environment has problems with CA certs
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if (curl_errno($ch)) {
        $error = curl_error($ch);
        curl_close($ch);
        return [
            'code' => 500,
            'response' => ['error' => 'cURL error: ' . $error]
        ];
    }

    curl_close($ch);
    return [
        'code' => $httpCode,
        'response' => json_decode($response, true) ?? $response
    ];
}

switch ($action) {
    case 'upload':
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['error' => 'Method not allowed']);
            exit;
        }

        if (!isset($_FILES['file'])) {
            http_response_code(400);
            echo json_encode(['error' => 'No file uploaded']);
            exit;
        }

        $file = $_FILES['file'];
        if ($file['error'] !== UPLOAD_ERR_OK) {
            http_response_code(400);
            echo json_encode(['error' => 'File upload error code: ' . $file['error']]);
            exit;
        }

        // Prepare multipart/form-data for cURL
        $cfile = new CURLFile($file['tmp_name'], $file['type'], $file['name']);
        $postFields = [
            'file' => $cfile,
            'file_name' => $file['name']
        ];

        $headers = [
            "Authorization: Bearer $apiKey"
        ];

        $result = sendCurlRequest("$baseUrl/api/common/upload/stream", 'POST', $headers, $postFields);

        http_response_code($result['code']);
        echo json_encode($result['response']);
        break;

    case 'upload_preset':
        $name = isset($_GET['name']) ? $_GET['name'] : '';
        if (!$name) {
            http_response_code(400);
            echo json_encode(['error' => 'Missing preset name']);
            exit;
        }

        $filePath = __DIR__ . '/referensi/' . basename($name);
        if (!file_exists($filePath)) {
            http_response_code(404);
            echo json_encode(['error' => 'Reference file not found']);
            exit;
        }

        // Prepare local file for cURL upload
        $mime = mime_content_type($filePath);
        $cfile = new CURLFile($filePath, $mime, basename($name));
        $postFields = [
            'file' => $cfile,
            'file_name' => basename($name)
        ];

        $headers = [
            "Authorization: Bearer $apiKey"
        ];

        $result = sendCurlRequest("$baseUrl/api/common/upload/stream", 'POST', $headers, $postFields);

        http_response_code($result['code']);
        echo json_encode($result['response']);
        break;

    case 'submit':
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['error' => 'Method not allowed']);
            exit;
        }

        $inputData = json_decode(file_get_contents('php://input'), true);
        if (!$inputData || !isset($inputData['image_urls'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Missing image_urls']);
            exit;
        }

        $optionalNote = isset($inputData['optional_note']) ? trim($inputData['optional_note']) : '';

        // 1. Identify the product using GPT-5 vision API
        $productDesc = 'the primary product';
        if (isset($inputData['image_urls'][0])) {
            $productImgUrl = $inputData['image_urls'][0];
            $visionPayload = [
                'model' => 'gpt-5',
                'input' => [
                    [
                        'role' => 'user',
                        'content' => [
                            [
                                'type' => 'input_text',
                                'text' => 'Identify the primary product in this image. Answer with a concise noun phrase of 2-5 words. For example: "a silver espresso machine", "a black leather shoe", or "a glass jar of honey". Output ONLY the noun phrase, do not include any other words, prefixes like "Description:", or punctuation.'
                            ],
                            [
                                'type' => 'input_image',
                                'image_url' => $productImgUrl
                            ]
                        ]
                    ]
                ],
                'max_output_tokens' => 50
            ];

            $headersForVision = [
                "Authorization: Bearer $apiKey",
                "Content-Type: application/json"
            ];

            $visionResult = sendCurlRequest("$baseUrl/v1/responses", 'POST', $headersForVision, json_encode($visionPayload));
            if ($visionResult['code'] === 200 && isset($visionResult['response']['data']['output'][0]['content'][0]['text'])) {
                $desc = trim($visionResult['response']['data']['output'][0]['content'][0]['text']);
                if (!empty($desc)) {
                    $productDesc = strtolower($desc);
                    $productDesc = rtrim($productDesc, '.');
                }
            }
        }

        // 2. Secret default prompt formula
        $secretPromptTemplate = "The uploaded image is the ONLY product reference. Preserve the product branding, logo, typography, and graphics with absolute accuracy and keep every printed label element identical to the original. However, you MUST automatically clean up and restore the physical state of the product: if the product packaging is wrinkled, crumpled, torn, dusty, damaged, or slightly slanted/crooked, repair the tears, smooth out the wrinkles, straighten the slant, and tidy up the packaging so it appears brand new, perfectly aligned, symmetrical, and in pristine showroom condition.\n\nYour task is to transform this into a premium commercial advertising photograph.\n\nBefore generating the scene, carefully analyze the uploaded product and automatically determine:\n\n• The dominant and secondary colors of the packaging to create a harmonious color palette.\n• The product category (food, beverage, cosmetic, supplement, snack, coffee, tea, skincare, perfume, etc.).\n• Any ingredients, flavors, fruits, herbs, spices, flowers, chocolate, milk, coffee beans, leaves, honey, vanilla, nuts, berries, or natural elements shown or implied by the packaging.\n• The visual theme suggested by the packaging design, illustrations, icons, patterns, textures, and branding.\n• The target audience and premium positioning suggested by the packaging.\n• The appropriate mood and atmosphere.\n\nBased on this analysis, automatically create the best possible advertising scene.\n\nRequirements:\n\n- Build a luxurious, realistic, high-end commercial product photography composition.\n- Use a background inspired by the packaging colors, gradients, textures, and overall branding.\n- Place the product naturally as the main hero subject.\n- Generate elegant supporting props only if they match the ingredients or theme inferred from the packaging.\n- If fruit or ingredients appear on the package, include realistic fresh versions naturally in the scene.\n- If the packaging suggests a specific environment (nature, tropical, premium café, luxury skincare, freshness, wellness, organic, etc.), recreate that atmosphere.\n- Use premium lighting with cinematic highlights and soft shadows.\n- Add realistic reflections only when appropriate.\n- Maintain excellent visual hierarchy with the product remaining the strongest focal point.\n- Use balanced composition following commercial advertising standards.\n- Create natural foreground and background depth for a premium look.\n- Apply subtle atmospheric effects only when suitable (mist, water droplets, floating particles, light rays, steam, splashes, leaves, flowers, etc.).\n- Everything surrounding the product must reinforce the brand story suggested by the packaging.\n\nQuality:\n\nUltra realistic.\nCommercial advertising photography.\nLuxury branding.\nNatural materials.\nHighly detailed.\nPhotorealistic.\nProfessional studio quality.\nPremium color grading.\nSharp focus on the product.\nBeautiful depth of field.\nMagazine-quality product advertisement.\n8K resolution.\nExtremely realistic textures.\nElegant composition.\n\nImportant:\n\nNever invent a different flavor, ingredient, logo, brand identity, or packaging.\nNever replace the product.\nNever modify the product design.\nOnly improve the surrounding environment, lighting, composition, styling, and presentation while keeping the product perfectly authentic.Please note that my current product photos are...";

        $finalPrompt = $secretPromptTemplate;
        if (!empty($optionalNote)) {
            $targetStr = "Please note that my current product photos are...";
            $pos = strpos($finalPrompt, $targetStr);
            if ($pos !== false) {
                $finalPrompt = str_replace($targetStr, "Please note that my current product photos are " . $optionalNote, $finalPrompt);
            } else {
                $finalPrompt .= "\nPlease note that my current product photos are " . $optionalNote;
            }
        } else {
            $targetStr = "Please note that my current product photos are...";
            $finalPrompt = str_replace($targetStr, "", $finalPrompt);
            $finalPrompt = rtrim($finalPrompt, "., ");
        }

        $editInstruction = isset($inputData['edit_instruction']) ? trim($inputData['edit_instruction']) : '';
        if (!empty($editInstruction)) {
            $finalPrompt .= "\n\nCRITICAL EDIT INSTRUCTION: The user has requested to modify/edit the previously generated design image. Please modify the scene according to this edit instruction: " . $editInstruction;
        }

        // 3. Configure model properties and submit task
        $payload = [
            'model' => 'gpt-image-2-edit',
            'input' => [
                'prompt' => $finalPrompt,
                'image_urls' => $inputData['image_urls'],
                'quality' => 'low', // default and hidden
                'size' => '1:1'
            ]
        ];

        $headers = [
            "Authorization: Bearer $apiKey",
            "Content-Type: application/json"
        ];

        $result = sendCurlRequest("$baseUrl/api/generate/submit", 'POST', $headers, json_encode($payload));

        // Debug logging
        file_put_contents('poyo_api_debug.log', date('[Y-m-d H:i:s] ') . "Submit task: Code=" . $result['code'] . ", Response=" . json_encode($result['response']) . "\n", FILE_APPEND);

        if ($result['code'] === 200 && is_array($result['response'])) {
            $result['response']['debug'] = [
                'optional_note' => $optionalNote,
                'product_desc' => $productDesc
            ];
        }

        http_response_code($result['code']);
        echo json_encode($result['response']);
        break;

    case 'status':
        $taskId = isset($_GET['task_id']) ? $_GET['task_id'] : '';
        if (!$taskId) {
            http_response_code(400);
            echo json_encode(['error' => 'Missing task_id']);
            exit;
        }

        $headers = [
            "Authorization: Bearer $apiKey"
        ];

        $result = sendCurlRequest("$baseUrl/api/generate/status/$taskId", 'GET', $headers);

        // Debug logging
        file_put_contents('poyo_api_debug.log', date('[Y-m-d H:i:s] ') . "Status for task $taskId: Code=" . $result['code'] . ", Response=" . json_encode($result['response']) . "\n", FILE_APPEND);

        http_response_code($result['code']);
        echo json_encode($result['response']);
        break;

    default:
        http_response_code(404);
        echo json_encode(['error' => 'Action not found']);
        break;
}
