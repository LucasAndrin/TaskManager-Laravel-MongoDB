<?php

namespace App\Traits;

use App\Models\Tenant;

trait TenantRequestTrait
{
    /**
     * Get tenant id from request
     *
     * @return null|integer|string
     */
    public function tenantId(): null|int|string
    {
        return $this->header('X-Tenant-ID');
    }

    /**
     * Get tenant from request
     *
     * @return Tenant|null
     */
    public function tenant(): ?Tenant
    {
        return $this->input('tenant');
    }
}
