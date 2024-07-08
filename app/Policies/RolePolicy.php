<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Check if user can view roles
     *
     * @param User $user
     * @return boolean
     */
    public function view(User $user): bool
    {
        return $user->hasPermission('roles.view');
    }

    /**
     * Check if user can create roles
     *
     * @param User $user
     * @return boolean
     */
    public function store(User $user): bool
    {
        return $user->hasPermission('roles.store');
    }

    /**
     * Check if user can update roles
     *
     * @param User $user
     * @return boolean
     */
    public function update(User $user): bool
    {
        return $user->hasPermission('roles.update');
    }

    /**
     * Check if user can destroy roles
     *
     * @param User $user
     * @return boolean
     */
    public function destroy(User $user): bool
    {
        return $user->hasPermission('roles.destroy');
    }

    /**
     * Check if user can assign roles to users
     *
     * @param User $user
     * @return boolean
     */
    public function assign(User $user): bool
    {
        return $user->hasPermission('roles.assign');
    }

    /**
     * Check if user can allow permissions to role
     *
     * @param User $user
     * @return boolean
     */
    public function allow(User $user): bool
    {
        return $user->hasPermission('roles.allow');
    }
}
