<?php

namespace App\Repositories;

use App\Models\Role;
use App\Models\Tenant;
use App\Models\TenantUser;
use Illuminate\Database\Eloquent\Collection;

interface TenantRepositoryInterface
{
    public function getByUserId(string $userId): Collection;

    public function find(string $tenantId): ?Tenant;
    public function create(array $data): Tenant;
    public function update(string $tenantId, array $data): int;
    public function delete(string $tenantId): int;

    /**
     * Relations queries
     */
    public function createRole(Tenant $tenant, array $data): Role;
    public function createPivotUser(Tenant $tenant, array $data): TenantUser;
}
