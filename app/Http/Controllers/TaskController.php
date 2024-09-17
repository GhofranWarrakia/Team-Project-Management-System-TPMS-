<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Services\TaskService;

class TaskController extends Controller
{
    /**
     * The TaskService instance to handle task-related business logic.
     *
     * @var \App\Services\TaskService
     */
    protected $taskService;

    /**
     * Constructor to initialize TaskService.
     *
     * @param  \App\Services\TaskService  $taskService
     */
    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * Display a listing of the tasks filtered by status and priority.
     *
     * This method retrieves tasks belonging to the authenticated user
     * and allows filtering by status and priority if provided.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        // Retrieve tasks related to the authenticated user's projects, filtered by status and priority.
        $tasks = Task::whereRelation('project', 'user_id', auth()->id())
            ->when($request->status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->when($request->priority, function ($query, $priority) {
                $query->where('priority', $priority);
            })
            ->get();

        // Return the tasks in JSON format.
        return response()->json($tasks);
    }

    /**
     * Store a newly created task.
     *
     * This method allows the creation of a new task by an authorized user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Authorize the task creation.
        $this->authorize('createAndEdit', Task::class);

        // Create a new task using TaskService.
        $task = $this->taskService->createTask($request->all());

        // Return the created task with a 201 status code.
        return response()->json($task, 201);
    }

    /**
     * Display the specified task.
     *
     * @param  int  $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function show($id)
    {
        // Find the task by ID or fail with a 404 response.
        return Task::findOrFail($id);
    }

    /**
     * Update the specified task.
     *
     * This method allows an authorized user to update the task details.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        // Find the task by ID or fail.
        $task = Task::findOrFail($id);

        // Authorize the task update.
        $this->authorize('createAndEdit', $task);

        // Update the task using TaskService.
        $updatedTask = $this->taskService->updateTask($task, $request->all());

        // Return the updated task.
        return response()->json($updatedTask);
    }

    /**
     * Update the status of the specified task.
     *
     * This method allows an authorized user to update the task's status.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus(Request $request, $id)
    {
        // Find the task by ID or fail.
        $task = Task::findOrFail($id);

        // Authorize the status update.
        $this->authorize('updateStatus', $task);

        // Update the task status using TaskService.
        $updatedTask = $this->taskService->updateTaskStatus($task, $request->status);

        // Return the updated task.
        return response()->json($updatedTask);
    }

    /**
     * Add notes to the specified task.
     *
     * This method allows an authorized user to add notes to the task.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function addNotes(Request $request, $id)
    {
        // Find the task by ID or fail.
        $task = Task::findOrFail($id);

        // Authorize the addition of notes.
        $this->authorize('addNotes', $task);

        // Add notes to the task using TaskService.
        $updatedTask = $this->taskService->addNotesToTask($task, $request->notes);

        // Return the updated task with notes.
        return response()->json($updatedTask);
    }

    /**
     * Remove the specified task from storage.
     *
     * This method deletes a task by its ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        // Delete the task by ID.
        Task::destroy($id);

        // Return a 204 No Content response.
        return response()->json(null, 204);
    }
}
