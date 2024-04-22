<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

class Landingpage extends Component
{
    #[Title('Free AI Gateway For Developers')]
    public function render()
    {
        return view('livewire.landingpage');
    }
}
