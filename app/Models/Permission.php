<?php

namespace App\Models;

use App\Traits\Database\Relations\BelognsToMany\Role\BelongsToManyRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Builder;
use MongoDB\Laravel\Eloquent\Model;

/**
 * @property-read string $id
 * @property string $name
 * @property string $alias
 * @property string $description
 */
class Permission extends Model
{
    use HasFactory;
    use BelongsToManyRole;

    protected $hidden = ['role_ids'];

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'alias',
        'description',
    ];

    public function scopeAlias(Builder $query, string $alias): void
    {
        $query->where('alias', $alias);
    }
}
