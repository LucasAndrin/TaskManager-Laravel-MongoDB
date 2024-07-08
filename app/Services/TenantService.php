<?php

namespace App\Services;

use App\Models\Permission;
use App\Models\Role;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class TenantService
{
    /**
     * List all tenants of related user
     *
     * @param User $user
     * @return Collection
     */
    public function index(User $user): Collection
    {
        return Tenant::userId($user->id)->get();
    }

    /**
     * Store tenant of related user
     *
     * @param User $user
     * @param array $tenantData
     * @return Tenant
     */
    public function store(User $user, array $tenantData): Tenant
    {
        /**
         * @var Tenant
         */
        $tenant = Tenant::create($tenantData);

        /**
         * @var Role
         */
        $role = $tenant->roles()->create([
            'name' => 'Admin',
            'alias' => 'admin'
        ]);

        $role->permissions()->sync(
            Permission::pluck('_id')->toArray()
        );

        /**
         * @var TenantUser
         */
        $pivotUser = $tenant->pivotUsers()->create([
            'user_id' => $user->id,
        ]);

        $pivotUser->roles()->attach($role);

        return $tenant;
    }

    /**
     * Show tenant of related user
     *
     * @param User $user
     * @param string $tenantId
     * @return Tenant
     */
    public function show(User $user, string $tenantId): Tenant
    {
        return Tenant::userId($user->id)->findOrFail($tenantId);
    }

    /**
     * Update tenant of related user
     *
     * @param User $user
     * @param string $password
     * @param array $tenantData
     * @param string $tenantId
     * @return boolean
     */
    public function update(User $user, string $password, array $tenantData, string $tenantId): bool
    {
        $tenant = $this->show($user, $tenantId);

        Gate::forUser($user)->authorize('update', $tenant);

        $this->checkPassword($tenant, $password);

        return $tenant->update($tenantData);
    }

    public function destroy(User $user, string $password, string $tenantId): bool
    {
        $tenant = $this->show($user, $tenantId);

        Gate::forUser($user)->authorize('destroy', $tenant);

        $this->checkPassword($tenant, $password);

        $tenant->roles()->delete();
        $tenant->pivotUsers()->forceDelete();

        return $tenant->delete();
    }

    public function checkPassword(Tenant $tenant, string $password)
    {
        if (! Hash::check($password, $tenant->password)) {
            throw ValidationException::withMessages([
                'message' => 'The provided credentials are incorrect',
            ]);
        }
    }
}
