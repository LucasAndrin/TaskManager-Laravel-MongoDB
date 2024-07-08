<?php

namespace App\Policies;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TenantPolicy
{
    use HandlesAuthorization;

    /**
     * Check if user can update the tenant
     *
     * @param User $user
     * @return boolean
     */
    public function update(User $user, Tenant $tenant): bool
    {
        return $user->hasRole('admin', $tenant->id);
    }

    /**
     * Check if user can destroy the tenant
     *
     * @param User $user
     * @return boolean
     */
    public function destroy(User $user, Tenant $tenant): bool
    {
        return $user->hasRole('admin', $tenant->id);
    }
}
