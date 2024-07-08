<?php

namespace App\Providers;

use App\Models\Role;
use App\Policies\RolePolicy;
use Illuminate\Support\ServiceProvider;

class AuthTenantServiceProvider extends ServiceProvider
{
    /**
     * Policies
     */
    protected $policies = [
        Role::class => RolePolicy::class
    ];

}
