<?php

namespace App\Models;

use App\Enums\TaskStatus;
use App\Traits\Database\Relations\BelongsTo\Tenant\BelongsToTenant;
use App\Traits\Database\Relations\EmbedsOne\TenantUser\EmbedsOneTenantCreator;
use App\Traits\Database\Relations\EmbedsOne\TenantUser\EmbedsOneTenantAssigner;
use App\Traits\Database\Relations\EmbedsOne\TenantUser\EmbedsOneTenantExecuter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Eloquent\SoftDeletes;

/**
 * @property-read string $id
 * @property string $name
 * @property TaskStatus $status
 * @property string $description
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon $deleted_at
 */
class Task extends Model
{
    use HasFactory, SoftDeletes;
    use BelongsToTenant;
    use EmbedsOneTenantCreator;
    use EmbedsOneTenantAssigner;
    use EmbedsOneTenantExecuter;

    /** @inheritDoc */
    protected $fillable = [
        'tenant_id',
        'creator_id',
        'executer_id',
        'assigner_id',
        'name',
        'status',
        'creator',
        'executer',
        'assigner',
        'description',
    ];

    /** @inheritDoc */
    protected function casts(): array
    {
        return [
            'status' => TaskStatus::class
        ];
    }

    public function isChanger(User $user): bool
    {
        return $this->creator()->is($user)
            || $this->executer()->is($user)
            || $this->assigner()->is($user);
    }
}
