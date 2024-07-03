<?php

namespace App\Models;

use App\Traits\BelongsToManyPermission;
use App\Traits\Database\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    use BelongsToTenant;
    use BelongsToManyPermission;
}
