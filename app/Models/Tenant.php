<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Builder;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\HasMany;

class Tenant extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'domain',
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
    public function pivotUsers(): HasMany
    {
        return $this->hasMany(TenantUser::class);
    }

    /**
     * Get all of the roles for the Tenant
     *
     * @return \MongoDB\Laravel\Relations\HasMany
     */
    public function roles(): HasMany
    {
        return $this->hasMany(Role::class);
    }

    /**
     * Filter user tenants
     *
     * @param Builder $query
     * @param integer $userId
     * @return void
     */
    public function scopeUserId(Builder $query, string $userId): void
    {
        $query->whereRelation('pivotUsers', 'user_id', $userId);
    }
}
