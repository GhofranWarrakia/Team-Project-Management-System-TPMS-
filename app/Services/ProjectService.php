<?php

namespace App\Services;

use App\Models\Project;

/**
 * Class ProjectService
 *
 * Provides functionality to manage projects, including retrieving tasks.
 *
 * @package App\Services
 */
class ProjectService
{
    /**
     * Get the latest task for a given project.
     *
     * @param  int  $projectId  The ID of the project to retrieve the latest task from.
     * @return \App\Models\Task|null
     */
    public function getLatestTask($projectId)
    {
        // Find the project by ID and retrieve the latest task.
        return Project::find($projectId)
            ->tasks() // Get tasks related to the project.
            ->latestOfMany() // Get the most recent task.
            ->first(); // Retrieve the first result.
    }

    /**
     * Get the oldest task for a given project.
     *
     * @param  int  $projectId  The ID of the project to retrieve the oldest task from.
     * @return \App\Models\Task|null
     */
    public function getOldestTask($projectId)
    {
        // Find the project by ID and retrieve the oldest task.
        return Project::find($projectId)
            ->tasks() // Get tasks related to the project.
            ->oldestOfMany() // Get the earliest task.
            ->first(); // Retrieve the first result.
    }
}
