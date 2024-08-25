<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use MongoDB\Laravel\Relations\HasMany;

/**
 * @property-read string $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property \Illuminate\Support\Carbon $email_verified_at
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /** @inheritdoc */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /** @inheritDoc */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /** @inheritDoc */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get all of the pivotTenants for the User
     *
     * @return HasMany
     */
    public function pivotTenants(): HasMany
    {
        return $this->hasMany(TenantUser::class);
    }

    /**
     * Check if user has permission by alias
     *
     * @param string $alias permission alias
     * @param null|string $tenantId
     * @return boolean
     */
    public function hasPermission(string $alias, ?string $tenantId = null)
    {
        if (! $tenantId) {
            $tenantId = request()->header('X-Tenant-ID');
        }

        return $this->pivotTenants()
            ->permissionAlias($alias)
            ->tenantId($tenantId)
            ->exists();
    }

    /**
     * Check if user has role by alias
     *
     * @param string $alias
     * @param string|null $tenantId
     * @return boolean
     */
    public function hasRole(string $alias, ?string $tenantId = null)
    {
        if (! $tenantId) {
            $tenantId = request()->header('X-Tenant-ID');
        }

        return $this->pivotTenants()
            ->tenantId($tenantId)
            ->roleAlias($alias)
            ->exists();
    }
}
