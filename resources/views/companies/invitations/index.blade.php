<x-layouts.app.sidebar :title="__('Members')">
    <flux:main>
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-6">
            Company invitations
        </h1>
        <button command="show-modal" commandfor="drawer" class="rounded-md bg-gray-800 px-2.5 py-1.5 text-sm font-semibold text-white inset-ring inset-ring-white/5 hover:bg-gray-700 dark:bg-accent-foreground ">Create invitation</button>
        <el-dialog>
        <dialog id="drawer" aria-labelledby="drawer-title" class="fixed inset-0 size-auto max-h-none max-w-none overflow-hidden bg-transparent not-open:hidden backdrop:bg-transparent">
            <el-dialog-backdrop class="absolute inset-0 bg-gray-900/50 transition-opacity duration-500 ease-in-out data-closed:opacity-0"></el-dialog-backdrop>

            <div tabindex="0" class="absolute inset-0 pl-10 focus:outline-none sm:pl-16">
            <el-dialog-panel class="group/dialog-panel relative ml-auto block size-full max-w-md transform transition duration-500 ease-in-out data-closed:translate-x-full sm:duration-700">
                <!-- Close button, show/hide based on slide-over state. -->
                <div class="absolute top-0 left-0 -ml-8 flex pt-4 pr-2 duration-500 ease-in-out group-data-closed/dialog-panel:opacity-0 sm:-ml-10 sm:pr-4">
                <button type="button" command="close" commandfor="drawer" class="relative rounded-md text-gray-400 hover:text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                    <span class="absolute -inset-2.5"></span>
                    <span class="sr-only">Close panel</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6">
                    <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
                </div>

                <div class="relative flex h-full flex-col overflow-y-auto bg-white dark:bg-zinc-800 py-6 shadow-xl after:absolute after:inset-y-0 after:left-0 after:w-px after:bg-white/10">
                <div class="px-4 sm:px-6">
                    <h2 id="drawer-title" class="text-base font-semibold text-gray-900 dark:text-gray-100">Send an invitation</h2>
                </div>
                <div class="relative mt-6 flex-1 px-4 sm:px-6">
                    <x-info-box icon="newspaper" title="Invite a member" message="Send an invitation to a member of your company." />
                    <form method="POST" action="{{ route('companies.invitations.store') }}" class=" py-8 sm:px-4 bg-white dark:bg-zinc-800" x-data="{ loading: false }" @submit="loading = true">
                        @csrf

                        <x-input label="Recipient email" name="email" type="email" placeholder="email@example.com" requiredIndicator=true />
                         <div class="absolute inset-x-0 bottom-0 h-16">
                        <div class="flex h-full items-center justify-end gap-4 bg-white dark:bg-zinc-800 px-4 sm:px-6">
                        <x-primary-btn label="{{ __('Send') }}" type="submit" class="" variant="primary" data-test="send-invitation-button" />
                        </div>
                    </div>

                    </form>
                </div>
                </div>
            </el-dialog-panel>
            </div>
        </dialog>
        </el-dialog>
        <livewire:company-invitation-table/>
    </flux:main>
</x-layouts.app.sidebar>