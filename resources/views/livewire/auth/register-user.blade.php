<div>
    <x-form wire:submit="register" >
        <x-header title="Registro" separator />

        <x-input label="Name" wire:model="name" />
        <x-input label="E-mail" wire:model="email" />
        <x-password label="Password" wire:model="password" clearable />
        <x-password label="Password" wire:model="password_confirmation" clearable />

    
        <x-slot:actions>
            <x-button label="Registrar" class="btn-primary" type="submit" spinner="register" />
        </x-slot:actions>
    </x-form>
</div>
