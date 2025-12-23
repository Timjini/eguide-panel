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
            return redirect()->route('onboarding.index')
                ->with('error', 'Customer created successfully.');
        }
        $company = Company::find($billableId);

        // TODO: I guess this should be done differently
        $checkoutSession = $company->newSubscription('default', $plan->stripe_price_id)
            ->checkout([
                'success_url' => route('dashboard') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('onboarding.index'),
            ]);

        return redirect($checkoutSession->url);

        return response()->json(['status' => 'subscribed'], 201);
    }
}
