<?php

namespace App\Services;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Collection;

class PermissionService
{
    /**
     * List Permissions
     *
     * @return Collection<int, Permission>
     */
    public function index(): Collection
    {
        return Permission::all();
    }
}
