<?php

namespace App\Livewire;

use App\Charts\MostUseApi;
use Livewire\Attributes\Title;
use Livewire\Component;

class Dashboard extends Component
{
    #[Title('Dashboard')]
    public function render(MostUseApi $mostUseApi)
    {
        return view('livewire.dashboard', [
            'chart' => $mostUseApi->build()
        ]);
    }
}
