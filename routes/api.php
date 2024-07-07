<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TenantController;
use App\Http\Middleware\TenantMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::middleware(TenantMiddleware::class)->group(function () {

    });

    Route::apiResource('tenants', TenantController::class);
});

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login')->name('auth.login');
    Route::post('register', 'register')->name('auth.register');
});
