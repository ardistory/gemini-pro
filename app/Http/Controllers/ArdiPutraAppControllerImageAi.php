<?php

namespace App\Http\Controllers;

use App\Models\Api;
use App\Models\Logs;
use App\Repository\ImageGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ArdiPutraAppControllerImageAi extends Controller
{
    private string $apiKey;
    private string $prompt;

    public function __construct(Request $request)
    {
        $this->apiKey = $request->query('key') ?? $request->header('X-Api-Key') ?? '';
        $this->prompt = $request->query('prompt') ?? json_decode($request->getContent(), true)['prompt'] ?? '';
    }

    public function responseImage()
    {
        try {
            $dataApi = Api::query()->where('key', '=', $this->apiKey)->firstOrFail();

            if ($dataApi['hit_available'] != 0) {
                foreach (ImageGenerator::usersBanned() as $user) {
                    if ($user == $this->apiKey) {
                        Storage::disk('local')->append('usersBanned.txt', $user);

                        return response()->json([
                            'message' => "user " . $this->apiKey . ' has been banned!'
                        ]);
                    }
                }

                $imageGenerator = App::make(ImageGenerator::class);

                if ($this->apiKey == env('CHAT_ID_OWNER')) {
                    $imageGenerator->setPrompt($this->prompt);
                    $base64image = $imageGenerator->generateImage();

                    return $base64image;
                }

                foreach ($imageGenerator->porbidWord() as $keyword) {
                    if (stripos($this->prompt, $keyword) !== false) {
                        return response()->json([
                            'username' => $dataApi['users_username'],
                            'code_status' => 200,
                            'hit_available' => $dataApi['hit_available'],
                            'message' => $this->prompt,
                            'response' => 'contains prohibited words'
                        ], 200);
                    }
                }

                $imageGenerator->setPrompt($this->prompt);
                $base64image = $imageGenerator->generateImage();

                if ($base64image != false) {
                    $log = json_encode([
                        'key' => $this->apiKey,
                        'prompt' => $this->prompt
                    ], JSON_PRETTY_PRINT);

                    Storage::disk('local')->append('log.txt', $log);

                    $newHitAvailable = $dataApi['hit_available'] - 1;

                    Api::query()->where('key', '=', $this->apiKey)->update([
                        'hit_available' => $newHitAvailable
                    ]);

                    // Store Image Temporary Online
                    $photo = fopen('photo.jpg', 'w+');
                    fwrite($photo, base64_decode($base64image));

                    $response = http::attach(
                        'image',
                        $photo,
                        uniqid('ardptr-') . '.jpg'
                    )->post('https://api.imgbb.com/1/upload', [
                                'key' => env('IMG_BB'),
                                'expiration' => 120
                            ]);

                    // Logs DB
                    Logs::query()->create([
                        'users_username' => $dataApi['users_username'],
                        'services_code_service' => 2
                    ]);

                    // Response JSON
                    return response()->json([
                        'username' => $dataApi['users_username'],
                        'code_status' => 200,
                        'hit_available' => $newHitAvailable,
                        'prompt' => $this->prompt,
                        'result' => json_decode($response->body(), true)['data']['display_url']
                    ], 200);
                } else {
                    return response()->json([
                        'alert' => 'Internal Server Error',
                        'code_status' => 500
                    ], 500);
                }
            } else {
                return response()->json([
                    'alert' => 'The API hit quota has run out',
                    'chat_my_telegram' => '@storynetsound',
                    'code_status' => 404
                ], 404);
            }
        } catch (\Exception $exception) {
            return response()->json([
                'alert' => 'Incorrect KEY',
                'code_status' => 404
            ], 404);
        }
    }
}
