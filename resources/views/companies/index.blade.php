<x-layouts.app.sidebar :title="$title ?? null">
    <flux:main>
        <h1> Create Company </h1>

        <div class="flex flex-col gap-6">
            <form method="POST" action="{{ route('companies.store') }}"
                class="flex flex-col gap-8 bg-amber-400 p-6 rounded-xl">
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

                    <flux:input name="website" :label="__('Website')" type="url"
                        placeholder="https://example.com" />

                    <flux:input name="phone_1" :label="__('Phone 1')" type="tel" autocomplete="tel" />

                    <flux:input name="phone_2" :label="__('Phone 2')" type="tel" />
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

                    <flux:input name="iban" :label="__('IBAN')" type="text" />

                    <flux:input name="swift_code" :label="__('SWIFT / BIC')" type="text" />
                </div>

                {{-- Preferences --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <flux:input name="preferred_language" :label="__('Preferred Language')" type="text"
                        value="en" />

                    <flux:input name="source" :label="__('Source')" type="text"
                        placeholder="Referral, Website, Sales, etc." />
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

    </flux:main>
</x-layouts.app.sidebar>
