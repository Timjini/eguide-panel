<?php

use App\Http\Controllers\Billing\PlanController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\Company\CompanySubscriptionController;
use App\Http\Controllers\OnboardingController;
use Illuminate\Http\Request;

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


    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::prefix('onboarding')->group(function () {
        Route::get('/', [OnboardingController::class, 'index'])->name('onboarding.index');
        Route::post('/', [OnboardingController::class, 'step'])->name('onboarding.step');
        Route::get('/', [OnboardingController::class, 'show'])->name('onboarding.show');
    });

    Route::prefix('companies')->group(function () {
        Route::get('/', [CompanyController::class, 'index'])->name('companies.index');
        Route::get(
            '/{company}/plans',
            [PlanController::class, 'index']
        );
    });
});

Route::prefix('companies')->group(function () {
    Route::get('/create', [CompanyController::class, 'create'])->name('companies.create');
    Route::post('/{stepOrder?}', [CompanyController::class, 'store'])->name('companies.store');
    Route::post(
        '/subscribe/{billableId}/{planId}',
        [CompanySubscriptionController::class, 'subscribe']
    )->name('companies.subscribe');
});


Route::get('/checkout/success', [CheckoutController::class, 'success'])
    ->name('checkout.success');

Route::get('/checkout/cancel', [CheckoutController::class, 'cancel'])
    ->name('checkout.cancel');
