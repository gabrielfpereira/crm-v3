<div>
    <x-form wire:submit="login">
        <x-header title="Fazer Login" separator />
        <x-errors title="Oops!" description="Please, fix them." icon="o-face-frown" />
    
        <x-input label="E-mail" wire:model="email" />
        <x-password label="Password" wire:model="password" clearable />
    
        <x-slot:actions>
            <div class="flex items-center justify-between w-full">
                <a href="{{ route('auth.recovery-password') }}" class="text-sm text-blue-600 hover:underline">Esqueci minha senha</a>
                <x-button label="Login" class="btn-primary" type="submit" spinner="login" />
            </div>
        </x-slot:actions>
    </x-form>
</div>
