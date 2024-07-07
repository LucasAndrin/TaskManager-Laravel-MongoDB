<?php

namespace App\Traits\Database\Relations;

use App\Models\Role;
use MongoDB\Laravel\Relations\BelongsToMany;

trait BelongsToManyRole
{
    /**
     * The roles that belong to the Permission
     *
     * @return \MongoDB\Laravel\Relations\BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }
}
