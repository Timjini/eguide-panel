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
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $stillOnboarding = $user->currentOnboardingStep()->first();
        info('calls to onboard ' . json_encode($stillOnboarding));

        if ($stillOnboarding !== null && !$request->routeIs('onboarding.*')) {
            return redirect()->route('onboarding.show');
        }

        return $next($request);
    }
}
