<?php

namespace App\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // User custom PersonalAccessToken for MongoDB
        AliasLoader::getInstance()->alias(
            \Laravel\Sanctum\PersonalAccessToken::class,
            \App\Models\Sanctum\PersonalAccessToken::class,
        );
    }
}
