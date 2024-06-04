<?php

namespace App\Livewire;

use App\Models\Api;
use App\Models\User;
use App\Repository\GeminiPro;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Title;
use Livewire\Component;

class Test extends Component
{
    public string $apiKey;
    public string $message;
    public string $prompt;
    public string $urlImage;
    public array $randomRecommend;
    public bool $isRunOutQuota = false;
    public bool $isFailedGenerateImage = false;

    public function mount()
    {
        $this->apiKey = User::find(Auth::user()->username)->api->key;
        $this->message = '';
        $this->prompt = '';
        $this->urlImage = 'https://learnertrip.com/wp-content/uploads/2023/02/best-ai-generate-images.png';
        $this->randomRecommend = GeminiPro::getWdyt();
    }

    public function testChat()
    {
        $dataApi = Api::query()->where('key', '=', $this->apiKey)->first('hit_available');

        if ($dataApi['hit_available'] != 0) {
            if (Storage::disk('local')->exists($this->apiKey . '_session.json')) {
                $response = Http::timeout(60)->get(env('APP_URL') . "/get/text?key={$this->apiKey}&message={$this->message}");

                ($response->successful()) ? $this->reset('message') : $this->reset('message');
            } else {
                $this->clearChat();

                $response = Http::timeout(60)->get(env('APP_URL') . "/get/text?key={$this->apiKey}&message={$this->message}");

                ($response->successful()) ? $this->reset('message') : $this->reset('message');
            }
        } else {
            $this->isRunOutQuota = true;
        }
    }

    public function clearChat()
    {
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

        Storage::disk('local')->put($this->apiKey . '_session.json', json_encode($safetySettings, JSON_PRETTY_PRINT));
    }

    public function generateImage()
    {
        $dataApi = Api::query()->where('key', '=', $this->apiKey)->first('hit_available');

        if ($dataApi['hit_available'] != 0) {
            $response = Http::timeout(60)->get(env('APP_URL') . "/get/image?key={$this->apiKey}&prompt={$this->prompt}");

            $responseUrlImage = json_decode($response->body(), true)['result'];

            if ($responseUrlImage != false) {
                $this->urlImage = $responseUrlImage;
            } else {
                $this->isFailedGenerateImage = true;
            }

            ($response->successful()) ? $this->reset('prompt') : $this->reset('prompt');
        } else {
            $this->isRunOutQuota = true;
        }
    }

    #[Title('Test')]
    public function render()
    {
        $dataChatFull = json_decode(Storage::disk('local')->get($this->apiKey . '_session.json'), true);

        $intervensiContent = [];

        if (isset($dataChatFull['contents'])) {
            foreach ($dataChatFull['contents'] as $chatContent) {
                $intervensiContent[] = [
                    'role' => $chatContent['role'],
                    'text' => explode("\n", $chatContent['parts'][0]['text'])
                ];
            }
        }

        return view('livewire.test', [
            'chats' => $intervensiContent
        ]);
    }
}
