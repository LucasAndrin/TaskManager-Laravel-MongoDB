<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Check if user can view tasks
     *
     * @param User $user
     * @return boolean
     */
    public function view(User $user, ?Task $task = null): bool
    {
        return $task?->isChanger($user)
            || $user->hasPermission('tasks.view');
    }

    /**
     * Check if user can create tasks
     *
     * @param User $user
     * @return boolean
     */
    public function store(User $user): bool
    {
        return $user->hasPermission('tasks.store');
    }

    /**
     * Check if user can update tasks
     *
     * @param User $user
     * @return boolean
     */
    public function update(User $user, ?Task $task = null): bool
    {
        return $task?->isChanger($user)
            || $user->hasPermission('tasks.update');
    }

    /**
     * Check if user can destroy tasks
     *
     * @param User $user
     * @return boolean
     */
    public function destroy(User $user, ?Task $task = null): bool
    {
        return $user->hasPermission('tasks.destroy');
    }

    /**
     * Check if user can assign tasks to users
     *
     * @param User $user
     * @return boolean
     */
    public function assign(User $user, ?Task $task = null): bool
    {
        return $user->hasPermission('tasks.assign');
    }

    /**
     * Check if user can execute tasks
     *
     * @param User $user
     * @return boolean
     */
    public function execute(User $user, ?Task $task = null): bool
    {
        return $task?->executer()->is($user)
            || $user->hasPermission('tasks.execute');
    }
}
