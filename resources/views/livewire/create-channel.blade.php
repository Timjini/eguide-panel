<form wire:submit="save">
    <x-input label="Channel name" name="name" type="text" placeholder="Grand Tour" wire:model="form.name" requiredIndicator=true />
    <div>
        @error('form.name') <span class="error">{{ $message }}</span> @enderror
    </div>

    <flux:button wire:click="save" variant="primary">Save</flux:button>
</form>