<?php

namespace App\Traits\Database\Relations\BelongsTo\TenantUser;

use App\Models\TenantUser;
use App\Traits\Database\Scopes\ScopeAssignerId;
use MongoDB\Laravel\Relations\BelongsTo;

/**
 * @property ?string $assigner_id
 */
trait BelongsToTenantAssigner
{
    use ScopeAssignerId;

    /**
     * Get the assigner of the Task
     *
     * @return BelongsTo
     */
    public function assigner(): BelongsTo
    {
        return $this->belongsTo(TenantUser::class, 'assigner_id');
    }
}
