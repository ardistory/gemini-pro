<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

class Api extends Component
{
    #[Title('API')]
    public function render(): View
    {
        return view('livewire.api', [
            'api_key' => User::find(Auth::user()->username)->api->key
        ]);
    }
}
