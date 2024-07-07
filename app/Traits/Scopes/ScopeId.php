<?php

namespace App\Traits\Scopes;

use MongoDB\Laravel\Eloquent\Builder;

trait ScopeId
{
    /**
     * Filter related Model by id
     *
     * @param Builder $query
     * @param string $id
     * @return void
     */
    public function scopeId(Builder $query, string $id): void
    {
        $query->where('_id', $id);
    }
}
