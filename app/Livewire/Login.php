<?php

namespace App\Livewire;

use App\Events\UserLogin;
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
            event(new UserLogin($this->validate()));

            notify('Login successful', 'Success!', 'success', 'bottomLeft');

            redirect()->route('dashboard');
        } else {
            notify('Login failed, please check your username & password again', 'Error!', 'error', 'topLeft');

            redirect()->route('login');
        }
    }

    #[Title('Login')]
    public function render()
    {
        return view('livewire.login');
    }
}
