<?php

namespace App\Observers;

use App\Models\Onboarding;
use App\Models\OnboardingStep;
use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        info("UserObserver: ===========================================");

        $onboarding = Onboarding::OrderBy('sort_order', 'ASC')->first();

        info("UserObserver: Onboarding fetched" . json_encode($onboarding));

        if (! $onboarding) {
            info("observer failed");
            return;
        }

        info("OnboardingStep created ===================== EXIT");
        // create onboardingstep
        OnboardingStep::create([
            'user_id' => $user->id,
            'onboarding_id' => $onboarding->id,
        ]);
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
