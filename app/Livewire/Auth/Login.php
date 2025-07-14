<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\{Auth, RateLimiter};
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
        $key = $this->email . request()->ip();

        if (RateLimiter::tooManyAttempts($key, $perMinute = 5)) {
            $seconds = RateLimiter::availableIn($key);
            $this->addError('attempts', "Too many login attempts. Please try again in {$seconds} seconds.");

            return;
        }

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            RateLimiter::increment($key);
            $this->addError('ops', 'The provided credentials do not match our records.');

            return;
        }

        return redirect()->intended('/dashboard');
    }
}
