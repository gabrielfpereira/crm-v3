<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\{Layout, Rule};
use Livewire\Component;

class RecoveryPassword extends Component
{
    #[Rule(['required', 'email'])]
    public ?string $email = '';

    #[Layout('components.layouts.guest')]
    public function render()
    {
        return view('livewire.auth.recovery-password');
    }

    public function submit()
    {
        $this->validate();

        Password::sendResetLink($this->only('email'));

        session()->flash('status', 'Verification link sent to your email address.');
    }
}
