<?php

namespace App\Traits\Database\Relations;

use App\Models\User;
use MongoDB\Laravel\Eloquent\Builder;
use MongoDB\Laravel\Relations\BelongsTo;

/**
 * @property string $user_id
 * @method \MongoDB\Laravel\Eloquent\Builder userId(string $userId)
 * @method \MongoDB\Laravel\Eloquent\Builder userIds(array $userIds)
 */
trait BelongsToUser
{
    /**
     * Get the user that owns the BelongsToUser
     *
     * @return \MongoDB\Laravel\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Filter tenant users by user id
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
     * Filter tenant users by user ids
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
