<?php

namespace App\Traits\Database\Scopes;

use MongoDB\Laravel\Eloquent\Builder;

/**
 * @property string $user_id
 * @method Builder userId(string $userId)
 * @method Builder userIds(array $userIds)
 */
trait ScopeUserId
{
    /**
     * Filter by user id
     *
     * @param Builder $query
     * @param string $userId
     * @return void
     */
    public function scopeUserId(Builder $query, string $userId): void
    {
        $query->where('user_id', $userId);
    }

    /**
     * Filter users by user ids
     *
     * @param Builder $query
     * @param array<int, string> $userIds
     * @return void
     */
    public function scopeUserIds(Builder $query, array $userIds): void
    {
        $query->whereIn('user_id', $userIds);
    }
}
