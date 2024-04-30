<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Register extends Component
{
    #[Validate('required|min:5', as: 'Username')]
    public string $username;
    #[Validate('required|min:3', as: 'First name')]
    public string $first_name;
    #[Validate('required|min:3', as: 'Last name')]
    public string $last_name;
    #[Validate('required|min:3|email', as: 'Email')]
    public string $email;
    #[Validate('required|min:8')]
    public string $password_confirmation;
    #[Validate('required|min:8|confirmed')]
    public string $password;

    public bool $isTaken = false;

    public function register()
    {
        try {
            $user = User::query()->create($this->validate());

            $user->sendEmailVerificationNotification();

            notify('registration was successful', 'Success!', 'success', 'topCenter');

            redirect()->route('login');
        } catch (\Exception $exception) {
            notify('registration failed', 'Failed!', 'error', 'topCenter');

            redirect()->route('register');
        }
    }

    #[Title('Register')]
    public function render()
    {
        $isUsernameTaken = User::query()->where('username', '=', $this->username ?? '')->first();

        $this->isTaken = $isUsernameTaken == !null;

        return view('livewire.register', [
            'isUsernameTaken' => $isUsernameTaken == !null
        ]);
    }
}
