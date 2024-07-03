<?php

namespace App\Models;

use App\Traits\Database\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\HasMany;

class Tenant extends Model
{
    use HasFactory;
    use BelongsToTenant;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    /**
     * Get all of the tenantUsers for the Tenant
     *
     * @return \MongoDB\Laravel\Relations\HasMany
     */
    public function tenantUsers(): HasMany
    {
        return $this->hasMany(TenantUser::class);
    }
}
