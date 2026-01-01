<form wire:submit="save" class="py-8 sm:px-4 bg-white dark:bg-zinc-800 gap-2">
    <x-input label="Channel name" name="name" type="text" placeholder="Grand Tour" wire:model="form.name" requiredIndicator=true />
    <div>
        @error('form.name') <span class="error">{{ $message }}</span> @enderror
    </div>

     <x-text-area label="Description" rows="2"  name="description" type="text" placeholder="Grand Tour" wire:model="form.description" requiredIndicator=false />
    <div>
        @error('form.description') <span class="error">{{ $message }}</span> @enderror
    </div>
    <x-input label="Start date" name="start_date" type="date" wire:model="form.stated_at" requiredIndicator=true />
    <div>
        @error('form.stated_at') <span class="error">{{ $message }}</span> @enderror
    </div>

    <x-input label="End date" name="end_date" type="date" wire:model="form.end_at" requiredIndicator=true />
    <div>
        @error('form.end_at') <span class="error">{{ $message }}</span> @enderror
    </div>
    <x-toggle-button label="Channel Status" wire:model="form.is_active"  />

    <div class="absolute inset-x-0 bottom-0 h-4">
        <div class="flex h-full items-center justify-end gap-4 bg-white dark:bg-zinc-800 px-4 sm:px-6">
            <x-primary-btn label="{{ __('Submit') }}" type="submit" class="" variant="primary" data-test="create-channel-button" />
        </div>
    </div>
</form>