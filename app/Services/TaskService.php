<?php

namespace App\Services;

use App\Enums\TaskStatus;
use App\Models\Task;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Gate;
use MongoDB\Laravel\Eloquent\Builder;

class TaskService
{
    /**
     * List tasks of the tenant
     *
     * @param User $user
     * @return Collection<int, Task>
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(User $user, Tenant $tenant): Collection
    {
        if (Gate::forUser($user)->allows('view', Task::class)) {
            return $tenant->tasks()->get();
        }

        return $tenant->tasks()->where(function (Builder $query) use ($user) {
            $query->creatorId($user->pivotTenant->id)
                ->orWhere(function (Builder $query) use ($user) {
                    $query->assinerId($user->pivotTenant->id);
                })->orWhere(function (Builder $query) use ($user) {
                    $query->executerId($user->pivotTenant->id);
                });
        });
    }

    /**
     * Check if user can create a task and create it
     *
     * @param User $user
     * @param Tenant $tenant
     * @param array $taskData
     * @return Task Created task
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(User $user, Tenant $tenant, array $taskData): Task
    {
        Gate::forUser($user)->authorize('store', Task::class);

        $taskData['status'] = TaskStatus::Pending;

        /** @var Task */
        $task = $tenant->tasks()->make($taskData);

        $task->creator()->associate($user->pivotTenant);

        /**
         * If has a task executer, save it and associate $user as assigner of the task
         */
        if (Arr::has($taskData, 'executer_id')) {
            /** @var TenantUser */
            $executer = $tenant->pivotUsers()->findOrFail($taskData['executer_id']);

            $task->assigner()->associate($user->pivotTenant);
            $task->executer()->associate($executer);
        }

        $task->save();

        return $task;
    }

    /**
     * Check if user can view a task and
     * show it
     *
     * @param User $user
     * @param Tenant $tenant
     * @param string $taskId
     * @return Task
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(User $user, Tenant $tenant, string $taskId): Task
    {
        /** @var Task */
        $task = $tenant->tasks()->findOrFail($taskId);

        Gate::forUser($user)->authorize('view', $task);

        return $task;
    }

    /**
     * Check if user can update a task and update it
     *
     * @param User $user
     * @param Tenant $tenant
     * @param array $taskData
     * @param string $taskId
     * @return boolean
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(User $user, Tenant $tenant, array $taskData, string $taskId): bool
    {
        /** @var Task */
        $task = $tenant->tasks()->findOrFail($taskId);

        Gate::forUser($user)->authorize('update', $task);

        return $task->update($taskData);
    }


    public function assign(User $user, Tenant $tenant, string $taskId, string $executerId): bool
    {
        /** @var Task */
        $task = $tenant->tasks()->findOrFail($taskId);

        Gate::forUser($user)->authorize('assign', $task);

        /** @var TenantUser */
        $executer = $tenant->pivotUsers()->findOrFail($executerId);

        $task->assigner()->associate($user->pivotTenant);
        $task->executer()->associate($executer);

        return $task->save();
    }

    /**
     * Check if user can destroy a task and destroy it
     *
     * @param User $user
     * @param Tenant $tenant
     * @param string $taskId
     * @return boolean
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(User $user, Tenant $tenant, string $taskId): bool
    {
        /** @var Task */
        $task = $tenant->tasks()->findOrFail($taskId);

        Gate::forUser($user)->authorize('destroy', $task);

        return $tenant->tasks()->destroy($taskId);
    }
}
