<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\{Auth, Hash, Password};
use Livewire\Attributes\{Layout, Rule};
use Livewire\Component;

class ResetPassword extends Component
{
    #[Rule(['required', 'email', 'exists:users,email'])]
    public ?string $email = '';

    public ?string $token = '';

    #[Rule(['required', 'string', 'min:8', 'confirmed', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*?&]/'])]
    public ?string $password = '';

    #[Rule(['required', 'same:password'])]
    public ?string $password_confirmation = '';

    #[Layout('components.layouts.guest')]
    public function render()
    {
        return view('livewire.auth.reset-password');
    }

    public function mount($token = null, $email = null)
    {
        $this->token = request()->input('token') ?? $token;
        $this->email = request()->input('email') ?? $email;

        $this->validateToken();
    }

    public function validateToken()
    {
        if (!$this->token || !$this->email) {
            session()->flash('error', 'Invalid token or email.');

            return redirect()->route('login');
        }

        $tokens = \Illuminate\Support\Facades\DB::table('password_reset_tokens')
            ->where('email', $this->email)
            ->get();

        if ($tokens->isEmpty()) {
            session()->flash('error', 'No reset token found for this email.');

            return redirect()->route('login');
        }

        foreach ($tokens as $token) {

            if (!Hash::check($this->token, $token->token)) {
                session()->flash('error', 'Invalid or expired token.');

                return redirect()->route('login');
            }
        }

    }

    public function submit()
    {
        $this->validate();

        Password::reset(
            ['email' => $this->email, 'token' => $this->token, 'password' => $this->password],
            function (User $user, $password) {
                $user->password = $password;
                $user->save();

                event(new \Illuminate\Auth\Events\PasswordReset($user));
            }
        );

        Auth::login(User::where('email', $this->email)->first());

        session()->flash('status', 'Password has been reset successfully.');

        return redirect()->route('dashboard');
    }
}
