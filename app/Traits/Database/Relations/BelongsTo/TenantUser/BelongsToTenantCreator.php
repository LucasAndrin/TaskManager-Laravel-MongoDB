<?php

namespace App\Traits\Database\Relations\BelongsTo\TenantUser;

use App\Models\TenantUser;
use App\Traits\Database\Scopes\ScopeCreatorId;
use MongoDB\Laravel\Relations\BelongsTo;

/**
 * @property ?string $creator_id
 */
trait BelongsToTenantCreator
{
    use ScopeCreatorId;

    /**
     * Get the creator of the Task
     *
     * @return BelongsTo
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(TenantUser::class, 'creator_id');
    }
}
