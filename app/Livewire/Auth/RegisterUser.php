<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Component;

class RegisterUser extends Component
{
    #[Rule(['required', 'string', 'max:255'])]
    public ?string $name = '';

    #[Rule(['required', 'email', 'max:255', 'unique:users,email'])]
    public ?string $email = '';

    #[Rule(['required', 'string', 'min:8', 'confirmed', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*?&]/'])]
    public ?string $password = '';

    #[Rule(['required', 'string', 'min:8', 'same:password'])]
    public ?string $password_confirmation = '';

    public function mount()
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        }
    }

    public function render()
    {
        return view('livewire.auth.register-user')->layout('components.layouts.guest');
    }

    public function register()
    {
        $this->validate();

        $user = \App\Models\User::create([
            'name'     => $this->name,
            'email'    => $this->email,
            'password' => $this->password,
        ]);

        Auth::login($user);

        // Optionally send a welcome email
        $user->notify(new \App\Notifications\WelcomeEmail());

        return redirect('/dashboard');
    }
}
