<?php

namespace App\Traits\Database\Relations\BelongsToMany\Permission;

use App\Models\Permission;
use MongoDB\Laravel\Eloquent\Builder;
use MongoDB\Laravel\Relations\BelongsToMany;

/**
 * @method Builder permissionAlias(string $alias)
 */
trait BelongsToManyPermission
{
    /**
     * The permissions that belong to the Role
     *
     * @return BelongsToMany
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * Filter model by its permission alias
     *
     * @param Builder $query
     * @param string $alias
     * @return void
     */
    public function scopePermissionAlias(Builder $query, string $alias): void
    {
        $query->whereHas('permissions', fn (Builder $q) => $q->alias($alias));
    }
}
