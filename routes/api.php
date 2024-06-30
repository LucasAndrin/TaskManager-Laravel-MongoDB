<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login')->name('auth.login');
    Route::post('register', 'register')->name('auth.register');
});

Route::middleware(['auth:sanctum'])->group(function () {

});
