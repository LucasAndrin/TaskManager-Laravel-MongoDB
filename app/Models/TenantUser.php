<?php

namespace App\Models;

use App\Traits\Database\Relations\BelongsToManyPermission;
use App\Traits\Database\Relations\BelongsToManyRole;
use App\Traits\Database\Relations\BelongsToUser;
use App\Traits\Database\Relations\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Eloquent\SoftDeletes;

class TenantUser extends Model
{
    use HasFactory, SoftDeletes;
    use BelongsToUser, BelongsToTenant;
    use BelongsToManyRole, BelongsToManyPermission;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tenant_id',
        'user_id',
    ];
}
