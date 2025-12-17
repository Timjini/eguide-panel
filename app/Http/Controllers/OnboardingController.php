<?php

namespace App\Http\Controllers;

use App\Models\Onboarding;
use App\Models\OnboardingStep;
use App\Models\Plan;
use App\Service\OnboardingStepsService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\View\View;

class OnboardingController
{
    public function __construct(protected OnboardingStepsService $service) {}
    public function index(): View
    {
        $currentStep = Auth::user()->currentOnboardingStep()->get();
        info("issue with steps---->" . json_encode($currentStep));
        if ($currentStep->isEmpty()) {
            return view('dashboard');
        }
        $plans = Plan::all();
        $onboarding = Onboarding::find($currentStep[0]['onboarding_id']);
        return view('onboarding.' . $onboarding->slug, ['plans' => $plans, 'stepOrder' => $onboarding->sort_order]);
    }

    public function show(string $onboardingId): View
    {
        $onboarding = Onboarding::find($onboardingId);
        $plans = Plan::all();

        return view('onboarding.' . $onboarding->slug, ['plans' => $plans, 'stepOrder' => $onboarding->sort_order]);
    }

    public function step(int $stepOrder)
    {
        $nextStep = $this->service->nextStep($stepOrder);

        return view('onboarding.' . $nextStep);
    }
}
