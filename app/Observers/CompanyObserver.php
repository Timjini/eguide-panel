<?php

namespace App\Observers;

use App\Models\Company;
use App\Models\Onboarding;
use App\Models\OnboardingStep;
use Illuminate\Support\Facades\Auth;

class CompanyObserver
{
    /**
     * Handle the Company "created" event.
     */
    public function created(Company $company): void
    {
        // Update user company_id
        $user = Auth::user();
        $user->company_id = $company->id;
        $user->save();

        $onboarding = Onboarding::OrderBy('sort_order', 'DESC')->first();

        if (! $onboarding) {
            info("observer failed");
            return;
        }

        // create onboardingstep
        OnboardingStep::create([
            'user_id' => $user->id,
            'onboarding_id' => $onboarding->id,
        ]);
    }

    /**
     * Handle the Company "updated" event.
     */
    public function updated(Company $company): void
    {
        //
    }

    /**
     * Handle the Company "deleted" event.
     */
    public function deleted(Company $company): void
    {
        //
    }

    /**
     * Handle the Company "restored" event.
     */
    public function restored(Company $company): void
    {
        //
    }

    /**
     * Handle the Company "force deleted" event.
     */
    public function forceDeleted(Company $company): void
    {
        //
    }
}
