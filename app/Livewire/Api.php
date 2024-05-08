<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;

class Api extends Component
{
    #[Title('API')]
    public function render(): View
    {
        return view('livewire.api');
    }
}
