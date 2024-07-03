<?php

namespace App\Traits\Database;

use App\Models\Tenant;
use MongoDB\Laravel\Relations\BelongsTo;

trait BelongsToTenant
{
    /**
     * Get the tenant that owns the BelongsToTenant
     *
     * @return \MongoDB\Laravel\Relations\BelongsTo
     */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }
}
