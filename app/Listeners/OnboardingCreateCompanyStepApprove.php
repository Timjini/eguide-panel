<?php

namespace App\Listeners;

use App\Domain\Company\Events\CompanyCreated;
use App\Models\Onboarding;
use App\Models\OnboardingStep;

class OnboardingCreateCompanyStepApprove
{

    public function handle(CompanyCreated $event)
    {
        info('Set Onboarding company_id =======', [
            'company_id' => $event->companyId->value(),
        ]);
        $onboarding = Onboarding::where('slug',  'create-company')->first();

        if (! $onboarding) {
            info("observer failed");
            return;
        }
        info("updating onboarding step");
        // create onboardingstep
        OnboardingStep::where([
            'onboarding_id' => $onboarding->id,
        ])->update(['is_completed' => true]);

        OnboardingStep::create(
            []
        );
    }
}
