<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TenantMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::middleware(TenantMiddleware::class)->group(function () {
        Route::controller(PermissionController::class)->prefix('permissions')->group(function () {
            Route::get('', 'index')->name('permissions.index');
        });

        Route::controller(RoleController::class)->prefix('roles')->group(function () {
            Route::get('', 'index')->name('roles.index');
            Route::post('', 'store')->name('roles.store');

            Route::prefix('{roleId}')->group(function () {
                Route::get('', 'show')->name('roles.show');
                Route::patch('', 'update')->name('roles.update');
                Route::delete('', 'destroy')->name('roles.destroy');

                Route::post('allow', 'allow')->name('roles.allow');
                Route::post('assign', 'assign')->name('roles.assign');
            });
        });

        Route::controller(UserController::class)->prefix('users/{userId}')->group(function () {
            Route::post('', 'add')->name('users.add');
            Route::delete('', 'remove')->name('users.remove');
        });
    });

    Route::controller(UserController::class)->prefix('users')->group(function () {
        Route::get('', 'index')->name('users.index');
    });

    Route::apiResource('tenants', TenantController::class);
});

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login')->name('auth.login');
    Route::post('register', 'register')->name('auth.register');
});
