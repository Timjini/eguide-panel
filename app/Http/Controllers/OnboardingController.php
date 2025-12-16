<?php

namespace App\Http\Controllers;

use App\Models\Onboarding;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\View\View;

class OnboardingController
{
    public function index(): View
    {
        $userSteps = Auth::user()->currentOnboardingStep()->get();
        $onboarding = Onboarding::find($userSteps[0]['onboarding_id']);
        return view('onboarding.index', ['onboarding' => $onboarding]);
    }

    public function show(string $onboardingId): View
    {
        $onboarding = Onboarding::find($onboardingId);

        return view('onboarding.' . $onboarding->slug);
    }
}
