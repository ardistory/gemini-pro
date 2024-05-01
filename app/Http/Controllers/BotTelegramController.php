<?php

namespace App\Http\Controllers;

use App\Repository\GeminiPro;
use App\Repository\ImageGenerator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class BotTelegramController extends Controller
{
    private GeminiPro $geminiPro;
    public string $textResponse = '';
    public string $chatIdRequest = '';
    public string $firstnameRequest = '';
    public string $usernameRequest = '';
    public string $textRequest = '';
    public bool $isContinue = false;

    public function __construct()
    {
        $this->geminiPro = App::make(GeminiPro::class);
    }

    public function getResponse(): JsonResponse
    {
        return response()->json([
            'Author' => 'Ardi Putra',
            'GitHub' => 'https://github.com/ardistory'
        ]);
    }

    private function httpResponse(array $queryParameter, string $method, string $contentType): void
    {
        Http::withHeaders([
            "Content-Type: " . $contentType
        ])
            ->withBody(json_encode($queryParameter))
            ->post("https://api.telegram.org/bot" . env('TELEGRAM_BOT_TOKEN') . "/$method");
    }

    private function imageResponse(array $postBody, string $method, string $imageBase64)
    {
        $imageData = base64_decode($imageBase64);

        if ($imageData !== false) {
            $namaFile = uniqid('pic_') . '.png';

            $tempFilePath = Storage::disk('local')->put($namaFile, $imageData);
            if ($tempFilePath !== false) {
                $response = Http::attach('photo', file_get_contents(storage_path('app/' . $namaFile)), 'photo.png')
                    ->post("https://api.telegram.org/bot" . env('TELEGRAM_BOT_TOKEN') . "/$method", $postBody);

                Storage::disk('local')->delete($namaFile);

                return ($response->successful()) ? 'Photo sent successfully!' : 'Failed to send photo. Error: ' . $response->status();
            } else {
                return 'Failed to create temporary file for the photo.';
            }
        } else {
            return 'Invalid base64 image data.';
        }
    }

    private function isChatFromOwner(string $prompt)
    {
        $imageGenerator = App::make(ImageGenerator::class);

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
                $this->httpResponse([
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

    public function sendResponse(Request $request)
    {
        if ($request->header('X-Telegram-Bot-Api-Secret-Token') == 'berserk') {
            $requestAll = $request->all();

            try {
                $this->chatIdRequest = $requestAll['message']['from']['id'];
                $this->firstnameRequest = $requestAll['message']['from']['first_name'];
                $this->usernameRequest = $requestAll['message']['from']['username'];
                $this->textRequest = $requestAll['message']['text'];
            } catch (\Exception $exception) {
                $this->httpResponse([
                    'text' => 'Throw exception detected, laporkan masalah ke @ardistory___',
                    'chat_id' => $this->chatIdRequest
                ], 'sendMessage', 'application/json');
            }

            if (str_contains($this->textRequest, "img:") || str_contains($this->textRequest, "IMG:")) {
                try {
                    $imageGenerator = new ImageGenerator();

                    $response = $this->isChatFromOwner($this->textRequest);

                    ($response == 'Failed to send photo. Error: 400') ? $this->httpResponse([
                        'text' => "generate gambar gagal!\nlaporkan bug & masalah lainnya ke IG : @ardistory___",
                        'chat_id' => $this->chatIdRequest
                    ], 'sendMessage', 'application/json') : '';

                    return response()->json(['message' => $response], 200);
                } catch (\Exception $exception) {
                    $this->httpResponse([
                        'text' => 'Throw exception detected, laporkan masalah ke @ardistory___',
                        'chat_id' => $this->chatIdRequest
                    ], 'sendMessage', 'application/json');
                }
            } else {
                try {
                    if ($this->textRequest == '/start') {
                        if (Storage::disk('local')->exists($this->chatIdRequest . '_session.json')) {
                            $this->httpResponse([
                                'text' => 'Session exist, bisa langsung ajukan pertanyaan',
                                'chat_id' => $this->chatIdRequest,
                                'parse_mode' => 'Markdown'
                            ], 'sendMessage', 'application/json');

                            return response()->json([
                                'info' => "Session " . $this->chatIdRequest . '_session.json exists',
                                'message' => 'Session exist, bisa langsung ajukan pertanyaan'
                            ]);
                        }

                        $this->httpResponse([
                            'text' => 'session dimulai, silahkan ajukan pertanyaan',
                            'chat_id' => $this->chatIdRequest,
                            'parse_mode' => 'Markdown'
                        ], 'sendMessage', 'application/json');

                        $safetySettings = [
                            "safetySettings" => [
                                [
                                    "category" => "HARM_CATEGORY_SEXUALLY_EXPLICIT",
                                    "threshold" => "BLOCK_NONE"
                                ],
                                [
                                    "category" => "HARM_CATEGORY_HATE_SPEECH",
                                    "threshold" => "BLOCK_NONE"
                                ],
                                [
                                    "category" => "HARM_CATEGORY_HARASSMENT",
                                    "threshold" => "BLOCK_NONE"
                                ],
                                [
                                    "category" => "HARM_CATEGORY_DANGEROUS_CONTENT",
                                    "threshold" => "BLOCK_NONE"
                                ]
                            ]
                        ];

                        Storage::disk('local')->put($this->chatIdRequest . '_session.json', json_encode($safetySettings, JSON_PRETTY_PRINT));

                        return response()->json([
                            'info' => "Created new session : " . $this->chatIdRequest . '_session.json',
                            'message' => 'session dimulai, silahkan ajukan pertanyaan'
                        ]);
                    } else if ($this->textRequest == '/listSession') {
                        $allFiles = Storage::disk('local')->allFiles();

                        foreach ($allFiles as $file) {
                            if (str_ends_with($file, '.json')) {
                                $this->httpResponse([
                                    'text' => $file,
                                    'chat_id' => $this->chatIdRequest
                                ], 'sendMessage', 'application/json');
                            }
                        }

                        return response()->json([
                            'status' => 'list session'
                        ]);
                    } else if ($this->textRequest == '/clearSession') {
                        $allFiles = Storage::disk('local')->allFiles();

                        foreach ($allFiles as $file) {
                            if (str_ends_with($file, '.json')) {
                                Storage::disk('local')->delete($file);

                                $this->httpResponse([
                                    'text' => $file . " deleted",
                                    'chat_id' => $this->chatIdRequest
                                ], 'sendMessage', 'application/json');
                            }
                        }

                        return response()->json([
                            'status' => 'session cleared'
                        ]);
                    } else if (Storage::disk('local')->exists($this->chatIdRequest . '_session.json')) {
                        $this->geminiPro->setChatIdRequest($this->chatIdRequest);
                        $this->geminiPro->setQuestion($this->textRequest);
                        $responseFromGeminiPro = $this->geminiPro->generateResponse();

                        if ($responseFromGeminiPro != false) {
                            $arrayResponse = $responseFromGeminiPro['contents'][1]['parts'][0]['text'];

                            $collectionArrayResponse = Collection::make($arrayResponse);
                            $collectionArrayResponse->map(function ($value) {
                                $this->textResponse .= str_replace("//", "\n", $value . "\n");
                            });

                            $this->httpResponse([
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
                                            "category" => "HARM_CATEGORY_SEXUALLY_EXPLICIT",
                                            "threshold" => "BLOCK_NONE"
                                        ],
                                        [
                                            "category" => "HARM_CATEGORY_HATE_SPEECH",
                                            "threshold" => "BLOCK_NONE"
                                        ],
                                        [
                                            "category" => "HARM_CATEGORY_HARASSMENT",
                                            "threshold" => "BLOCK_NONE"
                                        ],
                                        [
                                            "category" => "HARM_CATEGORY_DANGEROUS_CONTENT",
                                            "threshold" => "BLOCK_NONE"
                                        ]
                                    ];
                                }

                                Storage::disk('local')->put($this->chatIdRequest . '_session.json', json_encode($arraySessionFromFile, JSON_PRETTY_PRINT));
                            } else {
                                Storage::disk('local')->put($this->chatIdRequest . '_session.json', json_encode($this->geminiPro->getConversation(), JSON_PRETTY_PRINT));
                            }

                            $arraySession = json_decode(Storage::get($this->chatIdRequest . '_session.json'), true);

                            return response()->json($arraySession);
                        } else {
                            $this->httpResponse([
                                'text' => '😶‍🌫️',
                                'chat_id' => $this->chatIdRequest
                            ], 'sendMessage', 'application/json');
                        }

                    } else if (!Storage::disk('local')->exists($this->chatIdRequest . '_session.txt')) {
                        $this->httpResponse([
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
                    $this->httpResponse([
                        'text' => 'Throw exception detected, laporkan masalah ke @ardistory___',
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
