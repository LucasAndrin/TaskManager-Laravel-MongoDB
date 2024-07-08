<?php

namespace App\Models;

use App\Traits\Database\Relations\BelongsToManyPermission;
use App\Traits\Database\Relations\BelongsToManyTenantUser;
use App\Traits\Database\Relations\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Builder;
use MongoDB\Laravel\Eloquent\Model;

/**
 * @property-read string $id
 * @property string $tenant_id
 * @property string $name
 * @property string $alias
 * @property string $description
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
class Role extends Model
{
    use HasFactory;
    use BelongsToTenant;
    use BelongsToManyTenantUser;
    use BelongsToManyPermission;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tenant_id',
        'name',
        'alias',
        'description',
    ];

    /**
     * Filter role by its alias
     *
     * @param Builder $query
     * @param string $alias
     * @return void
     */
    public function scopeAlias(Builder $query, string $alias): void
    {
        $query->where('alias', $alias);
    }

    public function scopePermissionAlias(Builder $query, string $alias): void
    {
        $query->whereHas('permissions', fn (Builder $q) => $q->alias($alias));
    }
}
