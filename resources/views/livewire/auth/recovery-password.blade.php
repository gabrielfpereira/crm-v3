<div>
    
    <x-form wire:submit="submit">
        <x-header title="Recuperar Senha" separator />
        @if (session()->has('status'))
            <x-alert title="Hey!" description="{{ session()->get('status') }}" icon="o-envelope" class="alert-info" dismissible />
        @endif
    
        <x-input label="E-mail" wire:model="email" />
    
        <x-slot:actions>
            <x-button label="Recuperar Senha" class="btn-primary" type="submit" spinner="submit" />
        </x-slot:actions>
    </x-form>
</div>
