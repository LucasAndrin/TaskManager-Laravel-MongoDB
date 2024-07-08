<?php

namespace App\Traits\Database\Relations;

use App\Models\User;
use MongoDB\Laravel\Eloquent\Builder;
use MongoDB\Laravel\Relations\BelongsToMany;

/**
 * @property array<int, string> $tenant_user_ids
 * @method \MongoDB\Laravel\Eloquent\Builder tenatUserIds(array $userIds)
 */
trait BelongsToManyTenantUser
{
    /**
     * The users that belong to the model
     *
     * @return \MongoDB\Laravel\Relations\BelongsToMany
     */
    public function tenantUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Filter the model by user ids
     *
     * @param Builder $query
     * @param array $userIds
     * @return void
     */
    public function scopeTenantUserIds(Builder $query, array $userIds): void
    {
        $query->where('user_ids', $userIds);
    }
}
