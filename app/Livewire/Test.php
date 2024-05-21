<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

class Test extends Component
{
    #[Title('Test')]
    public function render()
    {
        return view('livewire.test');
    }
}
