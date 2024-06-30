<?php

namespace App\Repositories\Eloquent;

use App\Models\Tenant;
use App\Repositories\TenantRepositoryInterface;

class TenantRepository implements TenantRepositoryInterface
{
    public function __construct(
        protected Tenant $model
    ) { }

    public function find(int $id): ?Tenant
    {
        return $this->model->find($id);
    }

    public function create(array $data): ?Tenant
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): int
    {
        return $this->model->where('id', $id)->update($data);
    }

    public function delete(int $id): int
    {
        return $this->model->where('id', $id)->delete();
    }
}
