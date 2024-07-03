<?php

namespace App\Models;

use App\Traits\BelongsToManyRole;
use App\Traits\Database\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    use BelongsToTenant;
    use BelongsToManyRole;
}
