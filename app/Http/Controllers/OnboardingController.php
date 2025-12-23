<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Onboarding;
use App\Models\Plan;
use App\Service\OnboardingStepsService;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OnboardingController
{
    public function __construct(
        protected OnboardingStepsService $service
    ) {}

    public function index(): View
    {
        $currentStep = Auth::user()
            ->currentOnboardingStep()
            ->first();

        if (! $currentStep) {
            return view('dashboard');
        }

        $onboarding = Onboarding::findOrFail($currentStep->onboarding_id);
        $plans = Plan::all();

        $company = Auth::user()->company;

        return view(
            'onboarding.' . $onboarding->slug,
            [
                'plans' => $plans,
                'stepOrder' => $onboarding->sort_order,
                'company' => $company
            ]
        );
    }

    public function show(string $onboardingId): View
    {
        $onboarding = Onboarding::findOrFail($onboardingId);
        $plans = Plan::all();
        $company = Auth::user()->company;

        return view(
            'onboarding.' . $onboarding->slug,
            [
                'plans' => $plans,
                'stepOrder' => $onboarding->sort_order,
                'company' => $company,
            ]
        );
    }

    public function step(int $stepOrder): View
    {
        $nextStepSlug = $this->service->nextStep(
            Auth::user(),
            $stepOrder
        );

        return view('onboarding.' . $nextStepSlug);
    }
}
