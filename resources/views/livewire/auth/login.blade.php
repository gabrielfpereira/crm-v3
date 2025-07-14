<div>
    <x-form wire:submit="login">
    {{-- Full error bag --}}
    {{-- All attributes are optional --}}
        <x-errors title="Oops!" description="Please, fix them." icon="o-face-frown" />
    
        <x-input label="E-mail" wire:model="email" />
        <x-password label="Password" wire:model="password" clearable />
    
        <x-slot:actions>
            <x-button label="Entrar" class="btn-primary" type="submit" spinner="login" />
        </x-slot:actions>
    </x-form>
</div>
