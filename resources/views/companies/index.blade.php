<x-layouts.app.sidebar :title="__('Organization')">
    <flux:main>
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-6">
            Organization
        </h1>

        @if (!$company)
            <div class="flex justify-center min-h-[60vh]">
                <div
                    class="max-w-md text-center rounded-xl p-8 shadow-sm
                           border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900 dark:shadow-none">

                    <div
                        class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full
                               bg-indigo-100 dark:bg-gray-900/40">
                        <svg class="h-7 w-7 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor"
                            stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M9 21V10m6 11V10M5 21h14" />
                        </svg>
                    </div>

                    <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100">
                        No Organization Found
                    </h2>

                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        You haven’t created a company yet. Create one to manage billing,
                        users, and company details in one place.
                    </p>

                    <div class="mt-6">
                        <a href="{{ route('companies.create') }}"
                            class="inline-flex items-center justify-center rounded-lg
                                  bg-indigo-600 px-5 py-2.5 text-sm font-medium text-white
                                  hover:bg-indigo-700 dark:hover:bg-indigo-500 transition">
                            Create Company
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div
                class="max-w-4xl mx-auto rounded-xl p-8
                       bg-white shadow
                       dark:bg-gray-900 dark:shadow-none dark:border dark:border-gray-800">

                <div class="flex items-center gap-4">
                    @if ($company->logo_path)
                        <img src="{{ asset($company->logo_path) }}"
                            class="h-16 w-16 rounded-lg object-contain border
                                    border-gray-200 dark:border-gray-700"
                            alt="{{ $company->name }}">
                    @endif

                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                            {{ $company->name }}
                        </h1>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            {{ $company->legal_name }}
                        </p>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Website</p>
                        <p class="font-medium text-gray-900 dark:text-gray-100">
                            {{ $company->website ?? '—' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Phone</p>
                        <p class="font-medium text-gray-900 dark:text-gray-100">
                            {{ $company->phone_1 ?? '—' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">VAT Number</p>
                        <p class="font-medium text-gray-900 dark:text-gray-100">
                            {{ $company->vat_number ?? '—' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Country</p>
                        <p class="font-medium text-gray-900 dark:text-gray-100">
                            {{ $company->country ?? '—' }}
                        </p>
                    </div>
                </div>
            </div>
        @endif
    </flux:main>
</x-layouts.app.sidebar>
