<?php

namespace App\Traits\Database\Relations\BelongsTo\TenantUser;

use App\Models\TenantUser;
use App\Traits\Database\Scopes\ScopeExecuterId;
use MongoDB\Laravel\Relations\BelongsTo;

/**
 * @property ?string $executer_id
 */
trait BelongsToTenantExecuter
{
    use ScopeExecuterId;

    /**
     * Get the executer of the Task
     *
     * @return BelongsTo
     */
    public function executer(): BelongsTo
    {
        return $this->belongsTo(TenantUser::class, 'executer_id');
    }
}
