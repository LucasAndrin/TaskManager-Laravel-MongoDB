<?php

namespace App\Traits\Database\Scopes;

use MongoDB\Laravel\Eloquent\Builder;

/**
 * @property string $assigner_id
 * @method Builder assignerId(string $assignerId)
 * @method Builder assignerIds(array $assignerIds)
 */
trait ScopeAssignerId
{
    /**
     * Filter by assigner id
     *
     * @param Builder $query
     * @param string $assignerId
     * @return void
     */
    public function scopeAssignerId(Builder $query, string $assignerId): void
    {
        $query->where('assigner_id', $assignerId);
    }

    /**
     * Filter assigners by assigner ids
     *
     * @param Builder $query
     * @param array<int, string> $assignerIds
     * @return void
     */
    public function scopeAssignerIds(Builder $query, array $assignerIds): void
    {
        $query->whereIn('assigner_id', $assignerIds);
    }
}
