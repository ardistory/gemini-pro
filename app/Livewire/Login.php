<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Login extends Component
{
    #[Validate('required|min:3')]
    public string $username;
    #[Validate('required|min:8')]
    public string $password;

    public function login()
    {
        if (Auth::attempt($this->validate(), true)) {
            notify('Login successful', 'Success!', 'success', 'topCenter');

            redirect()->route('dashboard');
        } else {
            redirect()->route('login');
            notify('Login failed', 'Error!', 'error', 'topCenter');
        }
    }

    #[Title('Login')]
    public function render()
    {
        return view('livewire.login');
    }
}
