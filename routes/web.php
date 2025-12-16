<?php

use App\Http\Controllers\Billing\PlanController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\Company\CompanySubscriptionController;
use App\Http\Controllers\OnboardingController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'UserOnboardingSteps'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');


    Route::prefix('companies')->group(function () {
        Route::get('/', [CompanyController::class, 'index'])->name('companies.index');
        Route::get(
            '/{company}/plans',
            [PlanController::class, 'index']
        );
        Route::post('/', [CompanyController::class, 'store'])->name('companies.store');
        Route::post(
            '/subscribe/{billableId}',
            [CompanySubscriptionController::class, 'subscribe']
        )->name('companies.subscribe');
    });
});


Route::prefix('onboarding')->group(function () {
    Route::get('/', [OnboardingController::class, 'index']);
    Route::get('/{onboardingId}', [OnboardingController::class, 'show'])->name('onboarding.show');
});
