<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Builder;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\HasMany;

class Tenant extends Model
{
    use HasFactory;

    /** @inheritdoc */
    protected $fillable = [
        'name',
        'domain',
        'password',
    ];

    /** @inheritdoc */
    protected $hidden = [
        'password',
    ];

    /** @inheritdoc */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    /**
     * Get all of the tenantUsers for the Tenant
     *
     * @return HasMany
     */
    public function pivotUsers(): HasMany
    {
        return $this->hasMany(TenantUser::class);
    }

    /**
     * Get all of the roles for the Tenant
     *
     * @return HasMany
     */
    public function roles(): HasMany
    {
        return $this->hasMany(Role::class);
    }

    /**
     * Get all of the roles for the Tenant, except admin
     *
     * @return HasMany
     */
    public function secureRoles(): HasMany
    {
        return $this->roles()->whereNot('alias', 'admin');
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
