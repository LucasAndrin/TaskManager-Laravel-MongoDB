<?php

namespace App\Traits;

use App\Models\Permission;
use MongoDB\Laravel\Relations\BelongsToMany;

trait BelongsToManyPermission
{
    /**
     * The permissions that belong to the Role
     *
     * @return \MongoDB\Laravel\Relations\BelongsToMany
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }
}
