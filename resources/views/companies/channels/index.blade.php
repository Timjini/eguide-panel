<x-layouts.app.sidebar :title="__('Channels')">
    <flux:main>
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-6">
            Channels
        </h1>
        <x-drawer-button title="Create channel" commandfor="channelDrawer" />
        <x-drawer-dialog
            id="channelDrawer"
            title="Create a channel">
            <x-info-box icon="newspaper" title="Create a channel" message="Generate channel code to share with the guide and tourist for the live channel" />
            <livewire:create-channel />
        </x-drawer-dialog>

        <livewire:channel-table />
    </flux:main>
</x-layouts.app.sidebar>