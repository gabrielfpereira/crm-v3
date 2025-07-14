<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Login extends Component
{
    #[Rule(['required', 'email'])]
    public ?string $email = '';

    #[Rule(['required', 'string', 'min:8'])]
    public ?string $password = '';

    public function render()
    {
        return view('livewire.auth.login')->layout('components.layouts.guest');
    }

    public function mount()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
    }

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            return redirect()->intended('/dashboard');
        }

        $this->addError('ops', 'The provided credentials do not match our records.');
    }
}
