<?php

namespace App\Listeners;

use App\Domain\Company\Events\CompanyCreated;
use App\Models\Onboarding;
use App\Models\OnboardingStep;

class OnboardingCreateCompanyStepApprove
{

    public function handle(CompanyCreated $event)
    {
        info('company created event =======', [
            'event_ingo' => $event,
        ]);
    }
}
