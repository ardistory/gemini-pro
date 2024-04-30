<?php

namespace App\Livewire\Partials;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EmailNotice extends Component
{
    public function refresh()
    {
        $user = User::find(Auth::user()->username);

        if ($user->email_verified_at != null) {
            notify('The detected email has been verified', 'Success!', 'success', 'topCenter');

            redirect()->route('dashboard');
        } else {
            notify('Please verification your email first', 'Error!', 'error', 'topCenter');

            redirect()->route('verification.notice');
        }
    }

    public function render()
    {
        return view('livewire.partials.email-notice');
    }
}
