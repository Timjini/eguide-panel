<x-layouts.app.sidebar :title="__('Members')">
    <flux:main>
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-6">
            Organization Members
        </h1>

        <livewire:member-table />
    </flux:main>
</x-layouts.app.sidebar>