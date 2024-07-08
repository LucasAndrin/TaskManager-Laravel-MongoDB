<?php

namespace App\Traits\Database\Relations;

use App\Models\Role;
use MongoDB\Laravel\Eloquent\Builder;
use MongoDB\Laravel\Relations\BelongsToMany;

/**
 * @property array<int, string> $role_ids
 * @method Builder roleIds(array $roleIds)
 * @method Builder roleAlias(array $alias)
 */
trait BelongsToManyRole
{
    /**
     * The roles that belong to the model
     *
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Filter the model by role ids
     *
     * @param Builder $query
     * @param array<int, int|string> $roleIds
     * @return void
     */
    public function scopeRoleIds(Builder $query, array $roleIds): void
    {
        $query->where('role_ids', $roleIds);
    }

    /**
     * Filter the model by role alias
     *
     * @param Builder $query
     * @param string $alias
     * @return void
     */
    public function scopeRoleAlias(Builder $query, string $alias): void
    {
        $query->whereRelation('roles', 'alias', $alias);
    }
}
