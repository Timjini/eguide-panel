<?php

namespace App\Service;

use App\Models\Onboarding;
use App\Models\OnboardingStep;
use App\Models\User;

class OnboardingStepsService
{
    public function nextStep(User $user): string
    {

        // update onboarding step as completed
        $currentOnboardingStep = $user->currentOnboardingStep()->first();

          if (!$currentOnboardingStep)
        {
            return 'All onboarding steps completed.';
        }
        $currentOnboardingStep->is_completed = true;
        $currentOnboardingStep->save();

        // find next Onboarding
        $currentStep = Onboarding::findOrFail($currentOnboardingStep->onboarding_id);
        $nextOnboarding = Onboarding::where('sort_order', $currentStep->sort_order + 1)->first();

        if (!$nextOnboarding)
        {
            return 'All onboarding steps completed.';
        }
        // create new OnboardingStep for user
        $nextOnboardingStep = OnboardingStep::create([
            'onboarding_id' => $nextOnboarding->id,
            'user_id' => $user->id
        ]);

        if (! $nextOnboarding) {
            abort(404, 'No next onboarding step.');
        }

        return $nextOnboardingStep;
    }
}
