<?php

namespace App\Traits\Database\Relations\EmbedsOne\TenantUser;

use App\Models\TenantUser;
use App\Traits\Database\Relations\BelongsTo\TenantUser\BelongsToTenantAssigner;
use MongoDB\Laravel\Relations\EmbedsOne;

trait EmbedsOneTenantAssigner
{
    use BelongsToTenantAssigner;

    /**
     * Get the embed assigner of the Task
     *
     * @return EmbedsOne
     */
    public function embedAssigner(): EmbedsOne
    {
        return $this->embedsOne(TenantUser::class, 'embed_assigner');
    }
}
