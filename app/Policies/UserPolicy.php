<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Check if user can add users in tenant
     *
     * @param User $user
     * @return boolean
     */
    public function add(User $user): bool
    {
        return $user->hasPermission('users.add');
    }

    /**
     * Check if user can remove users from tenant
     *
     * @param User $user
     * @return boolean
     */
    public function remove(User $user): bool
    {
        return $user->hasPermission('users.remove');
    }
}
