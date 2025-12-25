<x-layouts.onboarding :title="__('Onboarding')">

<div>
    <a href={{ route('onboarding.show', $onboarding->id) }}>
        browse
    </a>
</div>
</x-layouts.onboarding>