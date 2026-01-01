@props([
    'icon' => null,
    'title' => null,
    'message' => null,
    ])
<flux:callout>
    <flux:callout.heading icon="{{ $icon }}">{{ $title }}</flux:callout.heading>

    <flux:callout.text>{{ $message }}</flux:callout.text>
</flux:callout>