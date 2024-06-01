<?php

namespace App\Http\Controllers;

use App\Models\Api;
use App\Repository\GeminiPro;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ArdiPutraAppController extends Controller
{
    private GeminiPro $geminiPro;
    private string $apiKey;
    private string $message;
    private string $textResponse;

    public function __construct(Request $request)
    {
        $this->geminiPro = App::make(GeminiPro::class);
        $this->apiKey = $request->query('key') ?? $request->header('X-Api-Key');
        $this->message = $request->query('message') ?? json_decode($request->getContent(), true)['message'];
        $this->textResponse = '';
    }

    public function responseText(): JsonResponse
    {
        try {
            $username = Api::query()->where('key', '=', $this->apiKey)->firstOrFail(['users_username']);

            $this->geminiPro = App::make(GeminiPro::class);
            $this->geminiPro->setChatIdRequest($this->apiKey);
            $this->geminiPro->setQuestion($this->message);
            $responseFromGeminiPro = $this->geminiPro->generateResponse();


            if ($responseFromGeminiPro != false) {
                $arrayResponse = $responseFromGeminiPro['contents'][1]['parts'][0]['text'];

                $collectionArrayResponse = Collection::make($arrayResponse);
                $collectionArrayResponse->map(function ($value) {
                    $this->textResponse .= $value . "\n";
                });

                if (Storage::disk('local')->exists($this->apiKey . '_session.json')) {
                    $getSessionFromFile = Storage::disk('local')->get($this->apiKey . '_session.json');

                    $arraySessionFromFile = json_decode($getSessionFromFile, true);

                    $arraySessionFromFile['contents'][] = [
                        'role' => 'user',
                        'parts' => [
                            [
                                'text' => $this->message
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

                    Storage::disk('local')->put($this->apiKey . '_session.json', json_encode($arraySessionFromFile, JSON_PRETTY_PRINT));
                } else {
                    Storage::disk('local')->put($this->apiKey . '_session.json', json_encode($this->geminiPro->getConversation(), JSON_PRETTY_PRINT));
                }

                $arraySession = json_decode(Storage::get($this->apiKey . '_session.json'), true);

                return response()->json([
                    'username' => $username['users_username'],
                    'code_status' => 200,
                    'hit_available' => 500,
                    'message' => $this->message,
                    'response' => $arraySession['contents']
                ], 200);
            } else {
                return response()->json([
                    'alert' => 'Server Error',
                    'code_status' => 500
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
