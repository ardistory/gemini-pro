<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Title;
use Livewire\Component;

class GeminiPro extends Component
{
    protected \App\Repository\GeminiPro $geminiPro;
    public string $question = '';
    public array $wdyt;
    public array $responseText;

    public function mount(\App\Repository\GeminiPro $geminiPro)
    {
        $this->wdyt = $geminiPro->getWdyt();
    }

    public function askTheQuestion()
    {
        if ($this->question != '') {
            $this->geminiPro = app()->make(\App\Repository\GeminiPro::class);
            $this->geminiPro->setQuestion($this->question);

            $data = $this->geminiPro->generateResponse();

            if ($data != false) {
                $this->responseText[] = $data;
            } else {
                Session::flash('error', 'Silahkan coba pertanyaan lain!');
            }

            $this->reset('question');
        } else {
            Session::flash('error', 'Form dilarang kosong!');
        }
    }

    #[Title('Dashboard')]
    public function render()
    {
        return view('livewire.dashboard');
    }
}
