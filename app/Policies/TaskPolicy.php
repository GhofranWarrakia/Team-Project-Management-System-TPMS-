<?php

namespace App\Policies;

use App\Models\User;

class TaskPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
  // مدير المشروع يمكنه إضافة وتعديل المهام
  public function createAndEdit(User $user, Task $task)
  {
      return $user->projects()->wherePivot('role', 'manager')->exists();
  }

  // المطور يمكنه تعديل حالة المهام فقط
  public function updateStatus(User $user, Task $task)
  {
      return $user->projects()->wherePivot('role', 'developer')->exists();
  }

  // المختبر يمكنه إضافة ملاحظات حول المهام
  public function addNotes(User $user, Task $task)
  {
      return $user->projects()->wherePivot('role', 'tester')->exists();
  }

}
