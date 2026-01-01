<x-layouts.app.sidebar :title="__('Members')">
    <flux:main>
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-6">
            Company invitations
        </h1>
        <x-drawer-button title="Create invitation" commandfor="drawer" />
        <x-drawer-dialog
            id="drawer"
            title="Send an invitation">
            <x-info-box icon="newspaper" title="Invite a member" message="Send an invitation to a member of your company." />
            <form method="POST" action="{{ route('companies.invitations.store') }}" class=" py-8 sm:px-4 bg-white dark:bg-zinc-800" x-data="{ loading: false }" @submit="loading = true">
                @csrf

                <x-input label="Recipient email" name="email" type="email" placeholder="email@example.com" requiredIndicator=true />
                <div class="absolute inset-x-0 bottom-0 h-4">
                    <div class="flex h-full items-center justify-end gap-4 bg-white dark:bg-zinc-800 px-4 sm:px-6">
                        <x-primary-btn label="{{ __('Send') }}" type="submit" class="" variant="primary" data-test="send-invitation-button" />
                    </div>
                </div>

            </form>
        </x-drawer-dialog>

        <livewire:company-invitation-table />
    </flux:main>
</x-layouts.app.sidebar>