<?php

namespace App\Traits\Database\Relations;

use App\Models\Tenant;
use MongoDB\Laravel\Eloquent\Builder;
use MongoDB\Laravel\Relations\BelongsTo;

/**
 * @property string $tenant_id
 * @method Builder tenantId(string $tenantId)
 */
trait BelongsToTenant
{
    /**
     * Get the tenant that owns the BelongsToTenant
     *
     * @return BelongsTo
     */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    /**
     * Filter tenant users by tenant id
     *
     * @param Builder $query
     * @param string $tenantId
     * @return void
     */
    public function scopeTenantId(Builder $query, string $tenantId): void
    {
        $query->where('tenant_id', $tenantId);
    }
}
