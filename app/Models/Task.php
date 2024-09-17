<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Project; // Adjusted import for Project model

/**
 * Class Task
 *
 * Represents a task in the application.
 *
 * @package App\Models
 */
class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'status', 'priority', 'due_date'];

    /**
     * Get the project that owns the task.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Get the users assigned to the task through the project.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function assignedUsers()
    {
        return $this->hasManyThrough(User::class, Project::class, 'project_id', 'id', 'id', 'user_id');
    }
}
