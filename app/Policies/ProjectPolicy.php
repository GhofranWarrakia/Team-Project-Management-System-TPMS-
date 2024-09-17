<?php

namespace App\Policies;

use App\Models\User;

class ProjectPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
  // صلاحيات مدير المشروع
  public function manageProject(User $user, Project $project)
  {
      return $user->projects()->wherePivot('role', 'manager')->exists();
  }

  // صلاحيات المطور
  public function manageTasks(User $user, Project $project)
  {
      return $user->projects()->wherePivot('role', 'developer')->exists();
  }

  // صلاحيات المختبر
  public function addTaskNotes(User $user, Project $project)
  {
      return $user->projects()->wherePivot('role', 'tester')->exists();
  }

}
