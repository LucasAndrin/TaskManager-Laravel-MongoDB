<?php

namespace App\Models;

use App\Traits\Database\Relations\BelongsToMany\Role\BelongsToManyRole;
use App\Traits\Database\Relations\BelongsToMany\Permission\BelongsToManyPermission;
use App\Traits\Database\Relations\BelongsTo\User\BelongsToUser;
use App\Traits\Database\Relations\BelongsTo\Tenant\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Builder;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Eloquent\SoftDeletes;

/**
 * @property-read string $id
 * @method Builder permissionAlias(string $alias)
 */
class TenantUser extends Model
{
    use HasFactory, SoftDeletes;
    use BelongsToUser;
    use BelongsToTenant;
    use BelongsToManyRole;
    use BelongsToManyPermission;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'tenant_id',
    ];

    public function scopePermissionAlias(Builder $query, string $alias): void
    {
        $query->where(function (Builder $query) use ($alias) {
            $query->whereHas('permissions', fn ($q) => $q->alias($alias))
                ->orWhereHas('roles', fn ($q) => $q->permissionAlias($alias));
        });
    }
}
