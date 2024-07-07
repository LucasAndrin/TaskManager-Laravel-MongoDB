<?php

namespace App\Repositories\Eloquent;

use App\Models\Role;
use App\Models\Tenant;
use App\Models\TenantUser;
use App\Repositories\TenantRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use MongoDB\Laravel\Eloquent\Builder;

class TenantRepository implements TenantRepositoryInterface
{
    public function __construct(
        protected Tenant $model
    ) { }

    /**
     * Builders
     */
    public function byId(string $tenantId): Builder
    {
        return $this->model->id($tenantId);
    }

    public function byIdFromUserId(string $tenantId, string $userId): Builder
    {
        return $this->byId($tenantId)->userId($userId);
    }


    public function find(string $tenantId): ?Tenant
    {
        return $this->model->find($tenantId);
    }

    public function create(array $data): Tenant
    {
        return $this->model->create($data);
    }

    public function update(string $tenantId, array $data): int
    {
        return $this->byId($tenantId)->update($data);
    }

    public function delete(string $tenantId): int
    {
        return $this->byId($tenantId)->delete();
    }

    /**
     * Scoped by Auth User
     */

    public function getFromUserId(string $userId): Collection
    {
        return $this->model->userId($userId)->get();
    }

    public function findFromUserId(string $tenantId, string $userId): ?Tenant
    {
        return $this->model->userId($userId)->find($tenantId);
    }

    public function updateFromUserId(string $tenantId, string $userId, array $data): int
    {
        return $this->byIdFromUserId($tenantId, $userId)
            ->update($data);
    }

    public function deleteFromUserId(string $tenantId, string $userId): int
    {
        return $this->byIdFromUserId($tenantId, $userId)
            ->delete();
    }


    /**
     * Relations
     */

    public function createRole(Tenant $tenant, array $data): Role
    {
        return $tenant->roles()->create($data);
    }

    public function createPivotUser(Tenant $tenant, array $data): TenantUser
    {
        return $tenant->pivotUsers()->create($data);
    }
}
