<?php

namespace App\Traits\Database\Scopes;

use MongoDB\Laravel\Eloquent\Builder;

/**
 * @property string $creator_id
 * @method Builder creatorId(string $creatorId)
 * @method Builder creatorIds(array $creatorIds)
 */
trait ScopeCreatorId
{
    /**
     * Filter by creator id
     *
     * @param Builder $query
     * @param string $creatorId
     * @return void
     */
    public function scopeCreatorId(Builder $query, string $creatorId): void
    {
        $query->where('creator_id', $creatorId);
    }

    /**
     * Filter creators by creator ids
     *
     * @param Builder $query
     * @param array<int, string> $creatorIds
     * @return void
     */
    public function scopeCreatorIds(Builder $query, array $creatorIds): void
    {
        $query->whereIn('creator_id', $creatorIds);
    }
}
