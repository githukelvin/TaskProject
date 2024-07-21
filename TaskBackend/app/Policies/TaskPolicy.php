<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TaskPolicy
{
    public function create(User $user): bool
    {
        return ($user->is_admin === 1);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Task $task): bool
    {
        return ($user->id === $task->assignee_id || $user->is_admin ===1 || $user->id === $task->load('team')->user_id);
    }
}
