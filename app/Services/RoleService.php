<?php

namespace App\Services;

use App\Models\Role;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Gate;

class RoleService
{
    /**
     * Checks if user can view roles and
     * list them
     *
     * @param User $user
     * @param Tenant $tenant
     * @return Collection<int, \App\Models\Role>
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(User $user, Tenant $tenant): Collection
    {
        Gate::forUser($user)->authorize('view', Role::class);

        return $tenant->roles;
    }

    /**
     * Checks if user can create a role and
     * create it
     *
     * @param User $user
     * @param Tenant $tenant
     * @return Role Created role
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(User $user, Tenant $tenant, array $roleData): Role
    {
        Gate::forUser($user)->authorize('store', Role::class);

        return $tenant->roles()->create($roleData);
    }

    /**
     * Check if user can view a role and
     * show it
     *
     * @param User $user
     * @param Tenant $tenant
     * @param string $roleId
     * @return Role
     */
    public function show(User $user, Tenant $tenant, string $roleId): Role
    {
        Gate::forUser($user)->authorize('view', Role::class);

        return $tenant->roles()->findOrFail($roleId);
    }

    /**
     * Check if user can update a role and
     * update it
     *
     * @param User $user
     * @param Tenant $tenant
     * @param array $roleData
     * @param string $roleId
     * @return boolean
     */
    public function update(User $user, Tenant $tenant, array $roleData, string $roleId): bool
    {
        Gate::forUser($user)->authorize('update', Role::class);

        /**
         * @var Role
         */
        $role = $tenant->roles()->findOrFail($roleId);

        return $role->update($roleData);
    }

    /**
     * Check if user can destroy a role and
     * destroy it
     *
     * @param User $user
     * @param Tenant $tenant
     * @param string $roleId
     * @return boolean
     */
    public function destroy(User $user, Tenant $tenant, string $roleId): bool
    {
        Gate::forUser($user)->authorize('destroy', Role::class);

        return $tenant->roles()->destroy($roleId);
    }

    /**
     * Check if user can assign a role to users,
     * attach the role to related users and
     * dettach the it to non related users
     *
     * @param User $user
     * @param Tenant $tenant
     * @param array $userIds
     * @param string $roleId
     * @return array
     */
    public function assign(User $user, Tenant $tenant, array $userIds, string $roleId): array
    {
        Gate::forUser($user)->authorize('assign', Role::class);

        /**
         * @var Role
         */
        $role = $tenant->roles()->findOrFail($roleId);

        return $role->users()->sync($userIds);
    }

    /**
     * Check if user can allow permissions to a role,
     * attach related permissions to the role and
     * dettach non related permissions to it
     *
     * @param User $user
     * @param Tenant $tenant
     * @param array $permissionIds
     * @param string $roleId
     * @return array
     */
    public function allow(User $user, Tenant $tenant, array $permissionIds, string $roleId): array
    {
        Gate::forUser($user)->authorize('allow', Role::class);

        /**
         * @var Role
         */
        $role = $tenant->roles()->findOrFail($roleId);

        return $role->permissions()->sync($permissionIds);
    }
}
