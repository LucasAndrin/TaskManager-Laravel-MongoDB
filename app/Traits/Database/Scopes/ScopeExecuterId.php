<?php

namespace App\Traits\Database\Scopes;

use MongoDB\Laravel\Eloquent\Builder;

/**
 * @property string $executer_id
 * @method Builder executerId(string $executerId)
 * @method Builder executerIds(array $executerIds)
 */
trait ScopeExecuterId
{
    /**
     * Filter by executer id
     *
     * @param Builder $query
     * @param string $executerId
     * @return void
     */
    public function scopeExecuterId(Builder $query, string $executerId): void
    {
        $query->where('executer_id', $executerId);
    }

    /**
     * Filter executers by executer ids
     *
     * @param Builder $query
     * @param array<int, string> $executerIds
     * @return void
     */
    public function scopeExecuterIds(Builder $query, array $executerIds): void
    {
        $query->whereIn('executer_id', $executerIds);
    }
}
