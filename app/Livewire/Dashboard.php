<?php

namespace App\Livewire;

use App\Charts\MostUseApi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

class Dashboard extends Component
{
    #[Title('Dashboard')]
    public function render(MostUseApi $mostUseApi)
    {
        return view('livewire.dashboard', [
            'chart' => $mostUseApi->build(),
            'hitAvailable' => User::find(Auth::user()->username)->api->hit_available
        ]);
    }
}
