@props(['label' => 'Toggle'])

<flux:field variant="inline" class="mt-4 p-1">
    <flux:label>{{ $label }}</flux:label>
    <flux:switch {{ $attributes }} />
    <flux:error :name="$attributes->wire('model')->value()" />
</flux:field>   