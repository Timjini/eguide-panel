<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Jobs\SubscribeCompanyToPlan;
use App\Models\Company;
use App\Models\Plan;
use Illuminate\Http\Request;

final class CompanySubscriptionController extends Controller
{
    public function subscribe(string $billableId, string $planId)
    {

        $plan = Plan::find($planId);

        if (!$plan) {
            return redirect()->route('onboarding.show')
                ->with('error', 'Customer created successfully.');
        }
        $company = Company::find($billableId);

        // TODO: I guess this should be done differently
        $checkoutSession = $company->newSubscription('default', $plan->stripe_price_id)
            ->trialDays($plan->trial_days)
            ->withMetadata([
                'company_id' => $company->id,
                'plan_id' => $plan->id,
                'plan_name' => $plan->name,
            ])
            ->checkout([
                'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('checkout.cancel'),
            ]);

        return redirect($checkoutSession->url);
    }
}
