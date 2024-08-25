<?php

namespace App\Models;

use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Eloquent\SoftDeletes;
use MongoDB\Laravel\Relations\BelongsTo;
use MongoDB\Laravel\Relations\EmbedsOne;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    /** @inheritDoc */
    protected $fillable = [
        'creator_id',
        'assigner_id',
        'name',
        'status',
        'creator',
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

    /**
     * Get the creator of the Task
     *
     * @return BelongsTo
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(TenantUser::class, 'creator_id');
    }

    /**
     * Get the embed creator of the Task
     *
     * @return BelongsTo
     */
    public function embedCreator(): EmbedsOne
    {
        return $this->embedsOne(TenantUser::class, 'creator');
    }

    /**
     * Get the assigner of the Task
     * @return BelongsTo
     */
    public function assigner(): BelongsTo
    {
        return $this->belongsTo(TenantUser::class, 'assigner_id');
    }

    /**
     * Get the embed assigner of the Task
     *
     * @return BelongsTo
     */
    public function embedAssigner(): EmbedsOne
    {
        return $this->embedsOne(TenantUser::class, 'assigner');
    }

    /**
     * Get the executer of the Task
     *
     * @return BelongsTo
     */
    public function executer(): BelongsTo
    {
        return $this->belongsTo(TenantUser::class, 'tenant_creator_id');
    }

    /**
     * Get the embed executer of the Task
     *
     * @return BelongsTo
     */
    public function embedExecuter(): EmbedsOne
    {
        return $this->embedsOne(TenantUser::class, 'executer');
    }
}
