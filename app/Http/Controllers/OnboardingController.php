<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Onboarding;
use App\Models\Plan;
use App\Service\OnboardingStepsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
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

    public function show()
    {
        $user = Auth::user();

        if (! $user) {
            abort(403);
        }
        $currentStep = $user
            ->currentOnboardingStep()
            ->first();

        if (! $currentStep) {
            abort(404);
        }
        $onboarding = Onboarding::findOrFail($currentStep->onboarding_id);

         if (! $onboarding) {
            abort(404);
        }

        $plans = Plan::all();
        $company = Auth::user()->company;


        return Blade::render(
            $onboarding->htmlContent,
            [
                'onboarding' => $onboarding,
                'plans' => $plans,
                'stepOrder' => $onboarding->sort_order,
                'company' => $company,
            ]
        );
    }

    public function step(Request $request)
    {
        if($this->checkIfInvited($request))
        {
            info("it runs inside checkIfInvited");
            return redirect()->route('onboarding.join-company');
        }
        info("it runs after checkIfInvited");
        $this->service->nextStep(
            Auth::user(),
        );

        return redirect()->route('onboarding.show');
    }

    public function checkIfInvited(Request $request)
    {
        if($request->onboarding_type === 'invited') {
            info("invited");
            return true;
        } else {
            info("not invited");
            return false;
        }
    }

    public function joinCompany(): View
    {
        return view('onboarding.join-company');
    }
}
