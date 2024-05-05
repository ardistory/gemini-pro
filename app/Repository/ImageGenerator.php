<?php

namespace App\Repository;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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
        $headers = [
            'X-RapidAPI-Key' => env('RAPID_API'),
            'Content-Type' => 'application/json'
        ];

        $postBody = [
            'negative_prompt' => '',
            'prompt' => $this->prompt,
            'width' => 512,
            'height' => 512,
            'hr_scale' => 2
        ];

        $url = 'https://imageai-generator.p.rapidapi.com/image';

        $httpRequestImage = Http::withHeaders($headers)->withBody(json_encode($postBody))->post($url);

        $response = $httpRequestImage->body();

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
            'hentai',
            'cantik',
            'cewek',
            'xnxx',
            'xvideos',
            'porn',
            'porno',
            'xhamster',
            'bokep',
            'missionary',
            'kiss',
            'woman',
            'pose',
            'masturbates',
            'bugil',
            'bikini',
            'dick',
            'nipples',
            'nipple',
            'boob',
            'boobs',
            'gay',
            'topless',
            'bra',
            'booty',
            'fvck',
            '18+',
            'telanjang'
        ];
    }
}