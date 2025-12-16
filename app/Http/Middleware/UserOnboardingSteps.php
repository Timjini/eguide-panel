<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserOnboardingSteps
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userSteps = Auth::user()->currentOnboardingStep()->get();

        $user = Auth::user();

        if (! $user) {
            return redirect()->route('login');
        }

        // Adjust this condition to your logic
        $hasFinishedOnboarding = $user->currentOnboardingStep()->get();
        // or: $user->currentOnboardingStep() === null

        $isOnboardingRoute = $request->routeIs('onboarding.*');

        // User NOT finished → force onboarding
        if ($hasFinishedOnboarding->isEmpty() && ! $isOnboardingRoute) {
            return redirect()->route('onboarding.index');
        }

        // User finished → block onboarding pages
        if ($hasFinishedOnboarding && $isOnboardingRoute) {
            return redirect()->route('dashboard');
        }
        return $next($request);
    }
}
