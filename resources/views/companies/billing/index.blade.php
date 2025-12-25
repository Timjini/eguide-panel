<x-layouts.app.sidebar :title="__('Organization')">
    <flux:main>
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-6">
            Billing & Invoices
        </h1>

        {{ var_dump($subscription) }}
    </flux:main>
</x-layouts.app.sidebar>
