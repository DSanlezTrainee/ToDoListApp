<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }
    public function create(User $user): bool
    {
        return true;
    }
    /**
     * Determine if the given task can be viewed by the user.
     */
    public function view(User $user, Task $task)
    {
        return $user->id === $task->user_id;
    }

    /**
     * Determine if the given task can be updated by the user.
     */
    public function update(User $user, Task $task)
    {
        return $user->id === $task->user_id;
    }

    /**
     * Determine if the given task can be deleted by the user.
     */
    public function delete(User $user, Task $task)
    {
        return $user->id === $task->user_id;
    }
}
