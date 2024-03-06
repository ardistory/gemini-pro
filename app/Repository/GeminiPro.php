<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class GeminiPro
{
    public array $storage;
    public array $innerContents;
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

    public function __construct()
    {
        $this->storage = [];
        $this->innerContents = [];
    }

    public static function getWdyt(): array
    {
        return self::$wdyt;
    }

    public function generateResponse()
    {
        // URL tujuan
        $url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=' . env('GEMINI_API_KEY');

        $data = [
            "contents" => $this->innerContents
        ];

        // Konversi data ke format JSON
        $json_data = json_encode($data);

        // Konfigurasi curl
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Eksekusi curl dan tangani respons
        $response = curl_exec($ch);

        if ($response) {
            // Tampilkan respons
            $data = json_decode($response);

            $formatData = explode("\n", $data->candidates[0]->content->parts[0]->text);

            $collection = Collection::make($formatData);

            $collection->map(function ($value) {
                $this->storage[] = str_replace("*", "", $value);
            });

            $this->innerContents[] = [
                'role' => 'model',
                'parts' => [
                    [
                        'text' => $this->storage
                    ]
                ]
            ];

            return [
                "contents" => $this->innerContents
            ];
        } else {
            return false;
        }
    }
}
