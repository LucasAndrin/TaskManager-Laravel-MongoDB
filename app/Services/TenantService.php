<?php

namespace App\Services;

use App\Models\Tenant;
use App\Models\User;
use App\Repositories\TenantRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class TenantService
{
    public function __construct(
        protected TenantRepositoryInterface $tenants
    ) { }

    public function index(User $user): Collection
    {
        return $this->tenants->getByUserId($user->id);
    }

    public function store(User $user, array $tenantData): Tenant
    {
        $tenant = $this->tenants->create($tenantData);

        $role = $this->tenants->createRole($tenant, [
            'name' => 'Admin',
            'alias' => 'admin'
        ]);

        $pivotUser = $this->tenants->createPivotUser($tenant, [
            'user_id' => $user->id
        ]);

        $pivotUser->roles()->attach($role);

        return $tenant;
    }

    public function show(User $user, int $tenantId): Tenant
    {
        return $this->tenants->find($tenantId);
    }

    public function update(User $user, int $tenantId, array $tenantData): int
    {
        return $this->tenants->update($tenantId, $tenantData);
    }

    public function destroy(User $user, int $tenantId): int
    {
        return $this->tenants->delete($tenantId);
    }
}
