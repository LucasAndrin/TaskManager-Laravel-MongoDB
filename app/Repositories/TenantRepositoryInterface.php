<?php

namespace App\Repositories;

use App\Models\Role;
use App\Models\Tenant;
use App\Models\TenantUser;
use Illuminate\Database\Eloquent\Collection;

interface TenantRepositoryInterface
{
    public function find(string $tenantId): ?Tenant;
    public function create(array $data): Tenant;
    public function update(string $tenantId, array $data): int;
    public function delete(string $tenantId): int;

    /**
     * Scoped by Auth User methods
     */
    public function getFromUserId(string $userId): Collection;
    public function findFromUserId(string $tenantId, string $userId): ?Tenant;
    public function updateFromUserId(string $tenantId, string $userId, array $data): int;
    public function deleteFromUserId(string $tenantId, string $userId): int;

    /**
     * Relations queries
     */
    public function createRole(Tenant $tenant, array $data): Role;
    public function createPivotUser(Tenant $tenant, array $data): TenantUser;
}
