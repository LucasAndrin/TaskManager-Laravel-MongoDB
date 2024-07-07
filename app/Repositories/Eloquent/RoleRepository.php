<?php

namespace App\Repositories\Eloquent;

use App\Models\Role;
use App\Repositories\RoleRepositoryInterface;

class RoleRepository implements RoleRepositoryInterface
{
    /**
     * UserRepository constructor.
     *
     * @param Role $model
     */
    public function __construct(
        protected Role $model
    ) { }

    public function create(array $data): Role
    {
        return $this->model->create($data);
    }
}
