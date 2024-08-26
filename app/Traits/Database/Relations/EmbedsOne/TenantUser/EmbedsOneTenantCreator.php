<?php

namespace App\Traits\Database\Relations\EmbedsOne\TenantUser;

use App\Models\TenantUser;
use App\Traits\Database\Relations\BelongsTo\TenantUser\BelongsToTenantCreator;
use MongoDB\Laravel\Relations\EmbedsOne;

trait EmbedsOneTenantCreator
{
    use BelongsToTenantCreator;

    /**
     * Get the embed creator of the Task
     *
     * @return EmbedsOne
     */
    public function embedCreator(): EmbedsOne
    {
        return $this->embedsOne(TenantUser::class, 'embed_creator');
    }
}
