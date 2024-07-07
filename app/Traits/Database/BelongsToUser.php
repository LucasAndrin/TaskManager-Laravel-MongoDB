<?php

namespace App\Traits\Database;

use App\Models\User;
use MongoDB\Laravel\Relations\BelongsTo;

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
}
