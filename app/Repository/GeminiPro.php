<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class GeminiPro
{
    private string $chatIdRequest;
    private string $theQuestion;
    public static array $wdyt = [
        "buatkan saya cerita pendek menarik",
        "cara mendapatkan uang di internet?",
        "roadmap laravel seperti apa?",
        "kiat kiat jadi programmer java",
        "roadmap bahasa pemrograman java",
        "build hero alucard?",
        "cara push rank mobile legends?",
        "tutorial membuat pisang goreng",
        "apa itu machine learning?",
        "apa yang terjadi pada tahun 1988 di indonesia?",
        "apa yang terjadi, setelah jepang kalah perang?",
    ];

    public string $url;
    public array $postBody = [
        'contents' => [],
        'safetySettings' => [
            [
                "category" => "HARM_CATEGORY_DANGEROUS_CONTENT",
                "threshold" => "BLOCK_ONLY_HIGH"
            ]
        ]
    ];
    public array $responseText;
    public static function getWdyt(): array
    {
        return self::$wdyt;
    }

    public function __construct()
    {
        $this->url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=' . env('GEMINI_API_KEY');
    }

    public function setChatIdRequest(string $chatId)
    {
        $this->chatIdRequest = $chatId;
    }

    public function setQuestion(string $yourQuestion)
    {
        $this->theQuestion = $yourQuestion;

        $this->postBody['contents'][] = [
            'role' => 'user',
            'parts' => [
                [
                    'text' => $yourQuestion
                ]
            ]
        ];
    }

    public function generateResponse()
    {
        $ch = curl_init($this->url);

        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");

        if (Storage::disk('local')->exists($this->chatIdRequest . '_session.json')) {

            $getSessionFromFile = Storage::disk('local')->get($this->chatIdRequest . '_session.json');
            $arraySessionFromFile = json_decode($getSessionFromFile, true);

            $arraySessionFromFile['contents'][] = [
                'role' => 'user',
                'parts' => [
                    [
                        'text' => $this->theQuestion
                    ]
                ]
            ];

            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arraySessionFromFile));
        } else {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($this->postBody));
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if ($response) {
            $responseText = json_decode($response, true);

            if (isset($responseText['candidates'][0]['content']['parts'][0]['text'])) {
                $formatData = explode("\n", $responseText['candidates'][0]['content']['parts'][0]['text']);

                $formatDataCollection = Collection::make($formatData);

                $formatDataCollection->map(function ($value) {
                    $this->responseText[] = str_replace("*", "", $value);
                });

                $this->postBody['contents'][] = [
                    'role' => 'model',
                    'parts' => [
                        [
                            'text' => $this->responseText
                        ]
                    ]
                ];

                return $this->postBody;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getConversation(): array
    {
        return $this->postBody;
    }
}
