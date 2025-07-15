<div>
    <x-form wire:submit="submit">
        <x-header title="Nova Senha" separator />
        @if (session()->has('status'))
            <x-alert title="Hey!" description="{{ session()->get('status') }}" icon="o-envelope" class="alert-info" dismissible />
        @endif
    
        <x-password label="Password" wire:model="password" clearable />
        <x-password label="Password" wire:model="password_confirmation" clearable />
    
        <x-slot:actions>
            <x-button label="Salvar Senha" class="btn-primary" type="submit" spinner="submit" />
        </x-slot:actions>
    </x-form>
</div>
