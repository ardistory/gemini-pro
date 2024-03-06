<?php

namespace App\Livewire;

use App\Repository\GeminiPro as RepositoryGeminiPro;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class GeminiPro extends Component
{
    public string $question = '';
    public array $wdyt;
    public array $fullData;
    public function mount()
    {
        $this->wdyt = RepositoryGeminiPro::getWdyt();
    }

    public function askTheQuestion()
    {
        RepositoryGeminiPro::$innerContents[] = [
            'role' => 'user',
            'parts' => [
                [
                    'text' => $this->question
                ]
            ]
        ];

        $this->reset('question');

        $api = new RepositoryGeminiPro();

        $this->fullData[] = $api->generateResponse();
        Log::info(json_encode(RepositoryGeminiPro::$innerContents, JSON_PRETTY_PRINT));
    }

    public function render()
    {
        return view('livewire.gemini-pro');
    }
}
