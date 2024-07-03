<?php

namespace App\Services;

use App\Models\Tenant;
use App\Models\User;
use App\Repositories\TenantRepositoryInterface;

class TenantService
{
    public function __construct(
        protected TenantRepositoryInterface $tenants
    ) { }

    public function store(User $user, array $tenantData): Tenant
    {
        $tenant = $this->tenants->create($tenantData);

        $tenant->tenantUsers()->create([
            'user_id' => $user->id
        ]);

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
