<?php

namespace App\Service;

use App\Models\Onboarding;
use App\Models\OnboardingStep;
use Illuminate\Contracts\Auth\Authenticatable;

class OnboardingStepsService
{
    public function nextStep(Authenticatable $user, int $stepOrder): string
    {
        $currentOnboarding = Onboarding::where('sort_order', $stepOrder)->firstOrFail();

        $currentStep = OnboardingStep::where('user_id', $user->id)
            ->where('onboarding_id', $currentOnboarding->id)
            ->firstOrFail();

        $currentStep->is_completed = true;
        $currentStep->save();

        $nextOnboarding = Onboarding::where('sort_order', $stepOrder + 1)->first();

        OnboardingStep::create([
            'onboarding_id' => $nextOnboarding->id,
            'user_id' => $user->id
        ]);

        if (! $nextOnboarding) {
            abort(404, 'No next onboarding step.');
        }

        return $nextOnboarding->slug;
    }
}
