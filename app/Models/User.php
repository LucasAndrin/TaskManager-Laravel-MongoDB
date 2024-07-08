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

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
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
     * @return \MongoDB\Laravel\Relations\HasMany
     */
    public function pivotTenants(): HasMany
    {
        return $this->hasMany(TenantUser::class);
    }

    /**
     * Check if auth user has permission by it alias
     *
     * @param string $alias permission alias
     * @param null|integer|string|null $tenantId
     * @return boolean
     */
    public function hasPermission(string $alias, null|int|string $tenantId = null)
    {
        if (! $tenantId) {
            $tenantId = request()->header('X-Tenant-ID');
        }

        return $this->pivotTenants()
            ->permissionAlias($alias)
            ->tenantId($tenantId)
            ->exists();
    }
}
