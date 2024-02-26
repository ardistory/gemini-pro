<?php

namespace App\Livewire;

use App\Repository\GeminiPro as RepositoryGeminiPro;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class GeminiPro extends Component
{

    public string $question = '';
    public array $response = [];
    public array $wdyt = [
        "buatkan saya cerita pendek menarik",
        "cara mendapatkan uang di internet?",
        "roadmap laravel seperti apa?",
        "kiat kiat jadi programmer GG",
        "build hero alucard",
        "cara ke mitik",
        "tutorial membuat pisang goreng",
        "apa itu machine learning?",
        "siapa saja korban penculikan prabowo?",
        "apa yang terjadi, setelah jepang kalah perang?",
    ];

    public function generateResponse()
    {
        $geminiPro = new RepositoryGeminiPro($this->question);

        try {
            $this->response = $geminiPro->generateResponse() ?? "Error";

            $this->reset('question');
        } catch (\Exception $exception) {
            $this->response[0] = "{$exception->getMessage()}: Coba pertanyaan lain";
        }
    }

    public function render()
    {
        return view('livewire.gemini-pro');
    }
}
