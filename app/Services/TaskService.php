<?php

namespace App\Services;

use App\Models\Task;

/**
 * Class TaskService
 *
 * Provides functionality to manage tasks, including creating, updating, and modifying task status and notes.
 *
 * @package App\Services
 */
class TaskService
{
    /**
     * Create a new task.
     *
     * @param  array  $data  The attributes for the new task.
     * @return \App\Models\Task
     */
    public function createTask(array $data)
    {
        // Create a new task with the provided data and return it.
        return Task::create($data);
    }

    /**
     * Update an existing task.
     *
     * @param  \App\Models\Task  $task  The task to update.
     * @param  array  $data  The attributes to update on the task.
     * @return \App\Models\Task
     */
    public function updateTask(Task $task, array $data)
    {
        // Update the task with the provided data and return the updated task.
        $task->update($data);
        return $task;
    }

    /**
     * Update the status of a task.
     *
     * @param  \App\Models\Task  $task  The task to update.
     * @param  string  $status  The new status for the task.
     * @return \App\Models\Task
     */
    public function updateTaskStatus(Task $task, string $status)
    {
        // Update the status of the task and return the updated task.
        $task->update(['status' => $status]);
        return $task;
    }

    /**
     * Add or update notes on a task.
     *
     * @param  \App\Models\Task  $task  The task to update.
     * @param  string  $notes  The notes to add to the task.
     * @return \App\Models\Task
     */
    public function addNotesToTask(Task $task, string $notes)
    {
        // Update the notes on the task and return the updated task.
        $task->update(['notes' => $notes]);
        return $task;
    }
}
