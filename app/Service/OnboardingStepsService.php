<?php

namespace App\Service;

use App\Models\Onboarding;
use App\Models\OnboardingStep;
use Illuminate\Support\Facades\Auth;

class OnboardingStepsService
{

    public function __construct() {}

    public function nextStep(int $stepOrder): string
    {
        $onboarding = Onboarding::where('sort_order',  $stepOrder)->first();

        if (! $onboarding) {
            info("observer failed");
            abort(403);
        }

        OnboardingStep::findOrFail([
            'user_id' => Auth::user()->id,
            'onboarding_id' => $onboarding->id,
        ]);

        $nextStep = Onboarding::where('sort_order', $stepOrder + 1)->first();

        return $nextStep->slug;
    }
}
