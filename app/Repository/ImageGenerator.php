<?php

namespace App\Repository;

class ImageGenerator
{
    protected string $prompt = '';
    protected string $base64image = '';

    public function setPrompt(string $prompt)
    {
        $this->prompt = $prompt;
    }

    public function generateImage()
    {
        $ch = curl_init();

        $postHeader = [
            "X-RapidAPI-Key: " . env('RAPID_API'),
            "content-type: application/json"
        ];

        $postBody = [
            'negative_prompt' => '',
            'prompt' => $this->prompt,
            'width' => 512,
            'height' => 512,
            'hr_scale' => 2
        ];

        curl_setopt_array($ch, [
            CURLOPT_URL => "https://imageai-generator.p.rapidapi.com/image",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($postBody),
            CURLOPT_HTTPHEADER => $postHeader,
        ]);

        $response = curl_exec($ch);

        return $response;
    }

    public function porbidWord()
    {
        return [
            'nude',
            'naked',
            'sexy',
            'hot',
            'full body',
            'xxx',
            'pussy',
            'memek',
            'kontol',
            'sperm',
            'sperma',
            'body',
            'women',
            'girl',
            'vagina',
            'penis',
            'titit',
            'japanese',
            'ass',
            'tit',
            'fuck',
            'ewe',
            'ngentot',
            'toket',
            'breast',
            'milf',
            'loly',
            'hentai'
        ];
    }
}