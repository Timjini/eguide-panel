<?php

namespace App\Http\Controllers;

use App\Events\CheckoutCancelled;
use App\Events\CheckoutSucceeded;
use App\Models\Subscription;
use App\Service\OnboardingStepsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Stripe;

final class CheckoutController extends Controller
{

    public function __construct(
        public OnboardingStepsService $service
    )
    {
        $this->service = $service;
    }

    public function success(Request $request)
    {
        $sessionId = $request->get('session_id');

        if (!$sessionId) {
            return redirect()->route('onboarding.show')
                ->with('error', 'Missing checkout session.');
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        $session = StripeSession::retrieve($sessionId);

        info("Stripe session: " . $session);

        // this is what the event will do 
        $user = Auth::user();
        $this->service->nextStep($user);

        $subcription = Subscription::create([
            'user_id' => $user->id,
            'company_id' => $user->company_id,
            'type' => 'standard',
            'stripe_id' => $session->subscription,
            'stripe_status' => 'active',
            'stripe_price' => $session->amount_total[0],
            'stripe_session' => json_encode($session->toArray()),
            // 'trial_ends_at' => date('Y-m-d H:i:s', $session->subscription->current_period_end),
        ]);

        // event(new CheckoutSucceeded($session));

        return redirect()->route('dashboard')
            ->with('success', 'Subscription completed!');
    }

    public function cancel()
    {
        event(new CheckoutCancelled());

        return redirect()->route('onboarding.show')
            ->with('error', 'Checkout cancelled.');
    }
}

