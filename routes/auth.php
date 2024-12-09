<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::resource('login', AuthenticatedSessionController::class)->only(['index', 'store']);
    Route::resource('register', RegisterController::class)->only(['store']);
});

Route::middleware('auth')->group(function () {
    Route::post('reset-password', ForgotPasswordController::class)->name('password.change');
    Route::delete('auth', [AuthenticatedSessionController::class, 'destroy'])->name('auth.destroy');
});
