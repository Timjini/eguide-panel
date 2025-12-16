<x-layouts.app.sidebar :title="$title ?? null">
    <flux:main>
        <div class="flex flex-col gap-8">
            <h1 class="text-2xl font-semibold">
                {{ __('Plans') }}
            </h1>

            <div class="flex flex-row flex-wrap gap-6 mt-6">
                @foreach ($plans as $plan)
                    <div class="flex flex-col justify-between rounded-2xl border bg-white p-6 shadow-sm">
                        {{-- Header --}}
                        <div class="flex flex-col gap-2">
                            <h2 class="text-lg font-semibold">
                                {{ $plan->name }}
                            </h2>

                            @if ($plan->description)
                                <p class="text-sm text-gray-600">
                                    {{ $plan->description }}
                                </p>
                            @endif
                        </div>

                        {{-- Price --}}
                        <div class="my-6">
                            <span class="text-3xl font-bold">
                                {{ number_format($plan->price, 2) }}
                            </span>
                            <span class="text-sm text-gray-500">
                                {{ strtoupper($plan->currency) }}
                                / {{ $plan->interval }}
                            </span>

                            @if ($plan->trial_days > 0)
                                <p class="mt-2 text-sm text-green-600">
                                    {{ $plan->trial_days }}-day free trial
                                </p>
                            @endif
                        </div>

                        {{-- Features --}}
                        @if (!empty($plan->features))
                            <ul class="mb-6 space-y-2 text-sm text-gray-700">
                                @foreach ($plan->features as $feature)
                                    <li class="flex items-center gap-2">
                                        <span class="text-green-500">✓</span>
                                        <span>{{ $feature }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                        {{-- Limits --}}
                        @if (!empty($plan->limits))
                            <div class="mb-6 text-sm text-gray-600">
                                @foreach ($plan->limits as $key => $value)
                                    <div class="flex justify-between">
                                        <span>{{ ucfirst(str_replace('_', ' ', $key)) }}</span>
                                        <span class="font-medium">{{ $value }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        {{-- Action --}}
                        <form method="POST" action="{{ route('companies.subscribe', $company->id) }}">
                            @csrf
                            <input type="hidden" name="plan_code" value="{{ $plan->slug }}">

                            <flux:button type="submit" class="w-full">
                                {{ __('Subscribe') }}
                            </flux:button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </flux:main>
</x-layouts.app.sidebar>
