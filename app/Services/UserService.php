<?php

namespace App\Services;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;
use MongoDB\Laravel\Eloquent\Builder;

class UserService
{
    /**
     * List tenant users
     *
     * @param User $user
     * @param Tenant $tenant
     * @return Collection<int, User>
     */
    public function index(User $user): Collection
    {
        return User::with('pivotTenants')
            ->whereNot('_id', $user->id)
            ->get();
    }

    /**
     * Add user by id to related tenant
     *
     * @param User $user
     * @param Tenant $tenant
     * @param string $userId
     * @return boolean
     */
    public function add(User $user, Tenant $tenant, string $userId): bool
    {
        Gate::forUser($user)->authorize('add', User::class);

        /**
         * @var User
         */
        $user = User::whereDoesntHave('pivotTenants', function (Builder $query) use ($tenant) {
            $query->whereNot('tenant_id', $tenant->id);
        })->findOrFail($userId);

        $tenant->pivotUsers()->create([
            'user_id' => $user->id
        ]);

        return true;
    }

    /**
     * Remove user by id from related tenant
     *
     * @param User $user
     * @param Tenant $tenant
     * @param string $userId
     * @return boolean|null
     */
    public function remove(User $user, Tenant $tenant, string $userId): ?bool
    {
        Gate::forUser($user)->authorize('remove', User::class);

        /**
         * @var \App\Models\TenantUser
         */
        $pivotUser = $tenant->pivotUsers()->findOrfail($userId);

        return $pivotUser->delete();
    }
}
