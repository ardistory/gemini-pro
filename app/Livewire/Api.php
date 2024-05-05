<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

class Api extends Component
{
    #[Title('API')]
    public function render()
    {
        return view('livewire.api');
    }
}
