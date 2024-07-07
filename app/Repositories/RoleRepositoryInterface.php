<?php

namespace App\Repositories;

use App\Models\Role;

interface RoleRepositoryInterface
{
    /**
     * Create a User Role for related Tenant
     *
     * @param array<string, mixed> $data
     * @return Role
     */
   public function create(array $data): Role;
}
