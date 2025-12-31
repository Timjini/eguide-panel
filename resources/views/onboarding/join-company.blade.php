<x-layouts.onboarding :title="__('Join Company')">
    <div class="mt-8 sm:w-full sm:max-w-md ">
        <form method="POST" action="{{ route('companies.invitations.validate') }}" class=" py-8 px-4 shadow sm:rounded-lg sm:px-10 bg-white dark:bg-zinc-800" x-data="{ loading: false }" @submit="loading = true">
            @csrf
            <div class="border-b border-gray-200 pb-5 mb-6">
                <h3 class="text-lg font-medium leading-6">
                    Join Company
                </h3>
                <p class="mt-1 text-sm ">
                    Add provided invitation code to join your organization.
                </p>
            </div>

            <div class="space-y-4">
                <!-- New Organization Option -->
                <label class="relative flex items-start p-4">
                        <flux:input
                            name="invitation_code"
                            :label="__('Invitation Code')"
                            type="text"
                            required
                            autofocus
                            autocomplete="off"
                            placeholder="Enter your invitation code"
                        />
                    <div class="absolute inset-0 rounded-lg border-2 border-transparent group-hover:border-blue-200 pointer-events-none"></div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-8 flex flex-col sm:flex-row gap-3">
                <button type="button"
                        class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md  hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                    Back
                </button>
                <x-loading-button label=" {{ __('Submit') }}" />
            </div>
        </form>
    </div>
</x-layouts.onboarding>