<x-layouts.onboarding :title="__('Create Organization')">
    <div class="flex flex-col gap-6">
         <h1 class="text-2xl font-semibold">
                {{ __('Create Organization') }}
            </h1>
        <form method="POST" action="{{ route('companies.store') }}" class="flex flex-col gap-8 p-6 rounded-xl">
            @csrf
            {{-- Basic Information --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <flux:input name="legal_name" :label="__('Legal Name')" type="text" required
                    autocomplete="organization" />

                <flux:input name="contact_person" :label="__('Contact Person')" type="text" autocomplete="name" />
            </div>

            {{-- Contact Information --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <flux:input name="primary_email" :label="__('Primary Email')" type="email" autocomplete="email" />

                <flux:input name="website" :label="__('Website')" type="url" placeholder="https://example.com" />

                <flux:input name="phone_1" :label="__('Phone')" type="tel" autocomplete="tel" />
            </div>

            {{-- Address Information --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <flux:input name="address" :label="__('Address')" type="text" required />

                <flux:input name="post_code" :label="__('Post Code')" type="text" required />

                <flux:input name="city" :label="__('City')" type="text" required />

                <flux:input name="district" :label="__('District / State')" type="text" />

                <flux:input name="country" :label="__('Country')" type="text" required />
            </div>

            {{-- Business & Financial Information --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <flux:input name="vat_number" :label="__('VAT Number')" type="text" />
            </div>

            {{-- Notes --}}
            <flux:textarea name="notes" :label="__('Notes')" rows="4" />
            {{-- Submit --}}
            <div class="flex justify-end">
                <flux:button type="submit">
                    {{ __('Create Company') }}
                </flux:button>
            </div>
        </form>
    </div>
</x-layouts.onboarding>
