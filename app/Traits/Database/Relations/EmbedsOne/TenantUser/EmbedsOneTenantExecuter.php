<?php

namespace App\Traits\Database\Relations\EmbedsOne\TenantUser;

use App\Models\TenantUser;
use App\Traits\Database\Relations\BelongsTo\TenantUser\BelongsToTenantExecuter;
use MongoDB\Laravel\Relations\EmbedsOne;

trait EmbedsOneTenantExecuter
{
    use BelongsToTenantExecuter;

    /**
     * Get the embed executer of the Task
     *
     * @return EmbedsOne
     */
    public function embedExecuter(): EmbedsOne
    {
        return $this->embedsOne(TenantUser::class, 'embed_executer');
    }
}
