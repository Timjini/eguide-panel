<?php

namespace App\Listeners;

use App\Events\NewCompanyCreated;
use App\Models\Onboarding;
use App\Models\OnboardingStep;
use App\Service\OnboardingStepsService;

class OnboardingCreateCompanyStepApprove
{

    public function __construct(
        public OnboardingStepsService $service,
    )
    {
        $this->service = $service;
    }

    public function handle(NewCompanyCreated $event)
    {
        $user = $event->user;
        $this->service->nextStep($user);
    }
}
