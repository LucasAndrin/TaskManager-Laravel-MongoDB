<?php

namespace App\Traits\Database\Relations\BelongsTo\User;

use App\Models\User;
use App\Traits\Database\Scopes\ScopeUserId;
use MongoDB\Laravel\Relations\BelongsTo;

trait BelongsToUser
{
    use ScopeUserId;

    /**
     * Get the user that owns the BelongsToUser
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
