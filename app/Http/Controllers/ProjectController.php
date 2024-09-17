<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Services\ProjectService;

class ProjectController extends Controller
{
    /**
     * The ProjectService instance to handle project-related logic.
     *
     * @var \App\Services\ProjectService
     */
    protected $projectService;

    /**
     * Constructor to initialize ProjectService.
     *
     * @param  \App\Services\ProjectService  $projectService
     */
    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    /**
     * Retrieve the latest task for a given project.
     *
     * @param  int  $projectId
     * @return \Illuminate\Http\JsonResponse
     */
    public function latestTask($projectId)
    {
        // Fetch the latest task using ProjectService.
        $latestTask = $this->projectService->getLatestTask($projectId);

        // Return the latest task or an error message if no tasks are found.
        if ($latestTask) {
            return response()->json($latestTask);
        } else {
            return response()->json(['message' => 'No tasks found for this project'], 404);
        }
    }

    /**
     * Retrieve the oldest task for a given project.
     *
     * @param  int  $projectId
     * @return \Illuminate\Http\JsonResponse
     */
    public function oldestTask($projectId)
    {
        // Fetch the oldest task using ProjectService.
        $oldestTask = $this->projectService->getOldestTask($projectId);

        // Return the oldest task or an error message if no tasks are found.
        if ($oldestTask) {
            return response()->json($oldestTask);
        } else {
            return response()->json(['message' => 'No tasks found for this project'], 404);
        }
    }

    /**
     * Retrieve a list of all projects along with their users and tasks.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        // Fetch all projects along with their users and tasks.
        return Project::with('users', 'tasks')->get();
    }

    /**
     * Store a new project in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Create a new project with the provided request data.
        $project = Project::create($request->all());

        // Return the newly created project with a 201 status code.
        return response()->json($project, 201);
    }

    /**
     * Display the specified project with its users and tasks.
     *
     * @param  int  $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function show($id)
    {
        // Fetch the project by ID, including users and tasks.
        return Project::with('users', 'tasks')->findOrFail($id);
    }

    /**
     * Update the specified project in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        // Find the project by ID.
        $project = Project::findOrFail($id);

        // Update the project with the provided request data.
        $project->update($request->all());

        // Return the updated project.
        return response()->json($project);
    }

    /**
     * Remove the specified project from the database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        // Delete the project by ID.
        Project::destroy($id);

        // Return a 204 No Content response.
        return response()->json(null, 204);
    }

    /**
     * Add a user to the specified project with additional pivot data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $projectId
     * @return \Illuminate\Http\JsonResponse
     */
    public function addUserToProject(Request $request, $projectId)
    {
        // Find the project by ID.
        $project = Project::findOrFail($projectId);

        // Attach a user to the project with additional pivot data.
        $project->users()->attach($request->user_id, [
            'role' => $request->role,
            'contribution_hours' => $request->contribution_hours,
            'last_activity' => now(),
        ]);

        // Return a success message.
        return response()->json(['message' => 'User added to project successfully']);
    }

    /**
     * Update a user's pivot data for the specified project.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $projectId
     * @param  int  $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateUserInProject(Request $request, $projectId, $userId)
    {
        // Find the project by ID.
        $project = Project::findOrFail($projectId);

        // Update the user's pivot data for the project.
        $project->users()->updateExistingPivot($userId, [
            'role' => $request->role,
            'contribution_hours' => $request->contribution_hours,
            'last_activity' => now(),
        ]);

        // Return a success message.
        return response()->json(['message' => 'User updated in project successfully']);
    }
}
