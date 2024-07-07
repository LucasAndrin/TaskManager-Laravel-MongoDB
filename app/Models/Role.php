<?php

namespace App\Models;

use App\Traits\Database\Relations\BelongsToManyPermission;
use App\Traits\Database\Relations\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

/**
 * @property-read int $id
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
}
