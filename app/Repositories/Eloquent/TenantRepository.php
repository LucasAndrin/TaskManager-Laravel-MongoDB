<?php

namespace App\Repositories\Eloquent;

use App\Models\Role;
use App\Models\Tenant;
use App\Models\TenantUser;
use App\Repositories\TenantRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class TenantRepository implements TenantRepositoryInterface
{
    public function __construct(
        protected Tenant $model
    ) { }

    public function getByUserId(string $userId): Collection
    {
        return $this->model->userId($userId)->get();
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
        return $this->model->where('id', $tenantId)->update($data);
    }

    public function delete(string $tenantId): int
    {
        return $this->model->where('id', $tenantId)->delete();
    }

    public function createRole(Tenant $tenant, array $data): Role
    {
        return $tenant->roles()->create($data);
    }

    public function createPivotUser(Tenant $tenant, array $data): TenantUser
    {
        return $tenant->pivotUsers()->create($data);
    }
}
