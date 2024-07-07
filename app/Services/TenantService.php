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
        return $this->tenants->getFromUserId($user->id);
    }

    public function store(User $user, array $tenantData): Tenant
    {
        $tenant = $this->tenants->create($tenantData);

        $role = $this->tenants->createRole($tenant, [
            'name' => 'Admin',
            'alias' => 'admin'
        ]);

        $this->tenants->createPivotUser($tenant, [
            'user_id' => $user->id,
            'role_ids' => [$role->id]
        ]);

        return $tenant;
    }

    public function show(User $user, string $tenantId): Tenant
    {
        return $this->tenants->findFromUserId(
            $tenantId,
            $user->id
        );
    }

    public function update(User $user, string $tenantId, array $tenantData): int
    {
        return $this->tenants->updateFromUserId(
            $tenantId,
            $user->id,
            $tenantData
        );
    }

    public function destroy(User $user, string $tenantId): int
    {
        return $this->tenants->deleteFromUserId(
            $tenantId,
            $user->id
        );
    }
}
