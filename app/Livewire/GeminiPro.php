<?php

namespace App\Livewire;

use App\Repository\GeminiPro as RepositoryGeminiPro;
use Livewire\Component;

class GeminiPro extends Component
{

    public string $question = '';
    public string $response = '';

    public function generateResponse()
    {
        $geminiPro = new RepositoryGeminiPro($this->question);

        $data = $geminiPro->generateResponse() ? $geminiPro->generateResponse() : "Error";

        $this->response = $data->candidates[0]->content->parts[0]->text;
    }

    public function render()
    {
        return view('livewire.gemini-pro');
    }
}
