<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <flux:callout class="aspect-video">
                    <flux:callout.heading icon="globe-europe-africa">Channels</flux:callout.heading>

                    <flux:callout.text>We've updated our Terms of Service and Privacy Policy. Please review them to stay informed.</flux:callout.text>
                </flux:callout>
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                 <flux:callout class="aspect-video">
                    <flux:callout.heading icon="users">Team</flux:callout.heading>

                    <flux:callout.text>We've updated our Terms of Service and Privacy Policy. Please review them to stay informed.</flux:callout.text>
                </flux:callout>
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                 <flux:callout class="aspect-video">
                    <flux:callout.heading icon="bolt">Activity</flux:callout.heading>

                    <flux:callout.text>We've updated our Terms of Service and Privacy Policy. Please review them to stay informed.</flux:callout.text>
                </flux:callout>
            </div>
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">

        </div>
    </div>
</x-layouts.app>