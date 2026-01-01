<x-layouts.app.sidebar :title="__('Channels')">
    <flux:main>
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-6">
            Channels
        </h1>
        <livewire:create-channel />
        <livewire:channel-table />
    </flux:main>
</x-layouts.app.sidebar>