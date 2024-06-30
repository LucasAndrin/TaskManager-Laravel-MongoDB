<?php

namespace App\Repositories;

use App\Models\Tenant;

interface TenantRepositoryInterface
{
    public function find(int $id): ?Tenant;
    public function create(array $data): ?Tenant;
    public function update(int $id, array $data): int;
    public function delete(int $id): int;
}
