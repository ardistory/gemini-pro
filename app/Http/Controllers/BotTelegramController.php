<?php

namespace App\Http\Controllers;

use App\Repository\GeminiPro;
use App\Repository\ImageGenerator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class BotTelegramController extends Controller
{
    public string $textResponse = '';
    public string $chatIdRequest = '';
    public string $firstnameRequest = '';
    public string $usernameRequest = '';
    public string $textRequest = '';
    public bool $isContinue = false;


    private function curlResponse(array $queryParameter, string $method, string $contentType)
    {
        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => "https://api.telegram.org/bot" . env('TELEGRAM_BOT_TOKEN') . "/$method",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($queryParameter),
            CURLOPT_HTTPHEADER => [
                "content-type: " . $contentType
            ],
        ]);

        $response = curl_exec($ch);

        return $response;
    }

    private function imageResponse(array $postBody, string $method, string $imageBase64)
    {
        $imageData = base64_decode($imageBase64);

        if ($imageData !== false) {
            $namaFile = uniqid('pic_') . '.png';

            $tempFilePath = Storage::put('public/' . $namaFile, $imageData);
            $lokasiFile = storage_path('app/public/' . $namaFile);
            if ($tempFilePath !== false) {
                $response = Http::attach('photo', file_get_contents($lokasiFile), 'photo.png')
                    ->post("https://api.telegram.org/bot" . env('TELEGRAM_BOT_TOKEN') . "/$method", $postBody);

                Storage::delete('public/' . $namaFile);

                return ($response->successful()) ? 'Photo sent successfully!' : 'Failed to send photo. Error: ' . $response->status();
            } else {
                return 'Failed to create temporary file for the photo.';
            }
        } else {
            return 'Invalid base64 image data.';
        }
    }

    private function isChatFromOwner(ImageGenerator $imageGenerator, string $prompt)
    {
        $trimmedTextRequest = str_ireplace("img:", "", $prompt);

        if ($this->chatIdRequest == env('CHAT_ID_OWNER')) {
            $imageGenerator->setPrompt($trimmedTextRequest);
            $base64image = $imageGenerator->generateImage();

            $log = json_encode([
                'username' => $this->usernameRequest,
                'chat_id' => $this->chatIdRequest,
                'prompt' => str_ireplace("img:", "", $this->textRequest)
            ], JSON_PRETTY_PRINT);

            Storage::disk('local')->append('log.txt', $log);

            $response = $this->imageResponse([
                'chat_id' => $this->chatIdRequest
            ], 'sendPhoto', $base64image);

            return $response;
        }

        foreach ($imageGenerator->porbidWord() as $keyword) {
            if (stripos($trimmedTextRequest, $keyword) !== false) {
                $this->curlResponse([
                    'text' => 'Mengandung kata-kata yang di larang!',
                    'chat_id' => $this->chatIdRequest
                ], 'sendMessage', 'application/json');

                return "Mengandung kata-kata yang di larang!";
            }
        }

        $imageGenerator->setPrompt($trimmedTextRequest);
        $base64image = $imageGenerator->generateImage();

        $log = json_encode([
            'username' => $this->usernameRequest,
            'chat_id' => $this->chatIdRequest,
            'prompt' => str_ireplace("img:", "", $this->textRequest)
        ], JSON_PRETTY_PRINT);

        Storage::disk('local')->append('log.txt', $log);

        $response = $this->imageResponse([
            'chat_id' => $this->chatIdRequest
        ], 'sendPhoto', $base64image);

        return "Safe guest!";
    }

    public function sendResponse(Request $request, GeminiPro $geminiPro)
    {
        if ($request->header('X-Telegram-Bot-Api-Secret-Token') == 'berserk') {
            $requestAll = $request->all();

            try {
                $this->chatIdRequest = $requestAll['message']['from']['id'];
                $this->firstnameRequest = $requestAll['message']['from']['first_name'];
                $this->usernameRequest = $requestAll['message']['from']['username'];
                $this->textRequest = $requestAll['message']['text'];
            } catch (\Exception $exception) {
                $this->curlResponse([
                    'text' => $exception->getMessage(),
                    'chat_id' => $this->chatIdRequest
                ], 'sendMessage', 'application/json');
            }

            if (str_contains($this->textRequest, "img:") || str_contains($this->textRequest, "IMG:")) {
                try {
                    $imageGenerator = new ImageGenerator();

                    $response = $this->isChatFromOwner($imageGenerator, $this->textRequest);

                    return response()->json(['message' => $response], 200);
                } catch (\Exception $exception) {
                    $this->curlResponse([
                        'text' => $exception->getMessage(),
                        'chat_id' => $this->chatIdRequest
                    ], 'sendMessage', 'application/json');
                }
            } else {
                try {
                    if ($this->textRequest == '/start') {
                        if (Storage::disk('local')->exists($this->chatIdRequest . '_session.json')) {
                            $this->curlResponse([
                                'text' => 'Session exist, bisa langsung ajukan pertanyaan',
                                'chat_id' => $this->chatIdRequest,
                                'parse_mode' => 'Markdown'
                            ], 'sendMessage', 'application/json');

                            return response()->json([
                                'info' => "Session " . $this->chatIdRequest . '_session.json exists',
                                'message' => 'Session exist, bisa langsung ajukan pertanyaan'
                            ]);
                        }

                        $this->curlResponse([
                            'text' => 'session dimulai, silahkan ajukan pertanyaan',
                            'chat_id' => $this->chatIdRequest,
                            'parse_mode' => 'Markdown'
                        ], 'sendMessage', 'application/json');

                        Storage::disk('local')->put($this->chatIdRequest . '_session.json', '');

                        return response()->json([
                            'info' => "Created new session : " . $this->chatIdRequest . '_session.json',
                            'message' => 'session dimulai, silahkan ajukan pertanyaan'
                        ]);
                    } else if (Storage::disk('local')->exists($this->chatIdRequest . '_session.json')) {
                        $geminiPro->setChatIdRequest($this->chatIdRequest);
                        $geminiPro->setQuestion($this->textRequest);
                        $responseFromGeminiPro = $geminiPro->generateResponse();

                        if ($responseFromGeminiPro != false) {
                            $arrayResponse = $responseFromGeminiPro['contents'][1]['parts'][0]['text'];

                            $collectionArrayResponse = Collection::make($arrayResponse);
                            $collectionArrayResponse->map(function ($value) {
                                $this->textResponse .= str_replace("```", "`", $value . "\n");
                            });

                            $this->curlResponse([
                                'text' => $this->textResponse,
                                'chat_id' => $this->chatIdRequest,
                                'parse_mode' => 'Markdown'
                            ], 'sendMessage', 'application/json');

                            if (Storage::disk('local')->exists($this->chatIdRequest . '_session.json')) {
                                $getSessionFromFile = Storage::disk('local')->get($this->chatIdRequest . '_session.json');

                                $arraySessionFromFile = json_decode($getSessionFromFile, true);

                                $arraySessionFromFile['contents'][] = [
                                    'role' => 'user',
                                    'parts' => [
                                        [
                                            'text' => $this->textRequest
                                        ]
                                    ]
                                ];

                                $arraySessionFromFile['contents'][] = [
                                    'role' => 'model',
                                    'parts' => [
                                        [
                                            'text' => $this->textResponse
                                        ]
                                    ]
                                ];

                                if (!isset($arraySessionFromFile['safetySettings'])) {
                                    $arraySessionFromFile['safetySettings'][] = [
                                        [
                                            "category" => "HARM_CATEGORY_DANGEROUS_CONTENT",
                                            "threshold" => "BLOCK_ONLY_HIGH"
                                        ]
                                    ];
                                }

                                Storage::disk('local')->put($this->chatIdRequest . '_session.json', json_encode($arraySessionFromFile, JSON_PRETTY_PRINT));
                            } else {
                                Storage::disk('local')->put($this->chatIdRequest . '_session.json', json_encode($geminiPro->getConversation(), JSON_PRETTY_PRINT));
                            }

                            $arraySession = json_decode(Storage::get($this->chatIdRequest . '_session.json'), true);

                            return response()->json($arraySession);
                        } else {
                            $this->curlResponse([
                                'text' => '😶‍🌫️',
                                'chat_id' => $this->chatIdRequest
                            ], 'sendMessage', 'application/json');
                        }

                    } else if (!Storage::disk('local')->exists($this->chatIdRequest . '_session.txt')) {
                        $this->curlResponse([
                            'text' => 'silahkan mulai session dengan cara mengetik `/start`',
                            'chat_id' => $this->chatIdRequest,
                            'parse_mode' => 'Markdown'
                        ], 'sendMessage', 'application/json');

                        return response()->json([
                            'info' => "Session " . $this->chatIdRequest . '_session.txt does\'nt exists',
                            'message' => 'silahkan mulai session dengan cara mengetik `/start`'
                        ]);
                    }
                } catch (\Exception $exception) {
                    $this->curlResponse([
                        'text' => $exception->getMessage(),
                        'chat_id' => $this->chatIdRequest
                    ], 'sendMessage', 'application/json');
                }

                return response()->json(['responseGemini' => $this->textResponse], 200);
            }
        } else {
            return response(['error_message' => 'Missing header'], 200);
        }
    }
}
