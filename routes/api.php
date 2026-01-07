<?php

use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\Channel\ChannelController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::prefix('channels')->group(function () {
        Route::post('/get', [ChannelController::class, 'getChannelByCode'])
            ->name('channel.by-code');
        Route::post('/join', [ChannelController::class, 'joinChannel'])
            ->name('channel.joinChannel');
    });
});

Route::get('/status', function () {
    return response()->json('Hello');
});

Route::post('/login', [AuthController::class, 'login'])
    ->name('auth.login');
