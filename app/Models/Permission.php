<?php

namespace App\Models;

use App\Traits\Database\BelongsToManyRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

/**
 * @property-read int $id
 * @property string $name
 * @property string $alias
 * @property string $description
 */
class Permission extends Model
{
    use HasFactory;
    use BelongsToManyRole;

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
}
