<?php

namespace App\Traits;

use App\Models\Tenant;

trait TenantRequestTrait
{
    /**
     * Get tenant id from request
     *
     * @return null|string
     */
    public function tenantId(): null|string
    {
        return $this->header('X-Tenant-ID');
    }

    /**
     * Get tenant from request
     *
     * @return Tenant
     */
    public function tenant(): Tenant
    {
        return $this->input('tenant');
    }
}
