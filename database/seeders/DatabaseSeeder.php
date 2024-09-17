<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Project;
use App\Models\Task;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // إنشاء مستخدمين
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Developer One',
            'email' => 'devone@example.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Tester One',
            'email' => 'testerone@example.com',
            'password' => Hash::make('password'),
        ]);

        // إنشاء مشاريع
        $project1 = Project::create([
            'name' => 'Project Alpha',
            'description' => 'Description for Project Alpha',
        ]);

        $project2 = Project::create([
            'name' => 'Project Beta',
            'description' => 'Description for Project Beta',
        ]);

        // إضافة مهام إلى المشاريع
        Task::create([
            'title' => 'Task 1 for Alpha',
            'description' => 'Description for Task 1',
            'status' => 'new',
            'priority' => 'high',
            'due_date' => now()->addDays(10),
            'project_id' => $project1->id,
        ]);

        Task::create([
            'title' => 'Task 2 for Alpha',
            'description' => 'Description for Task 2',
            'status' => 'in_progress',
            'priority' => 'medium',
            'due_date' => now()->addDays(20),
            'project_id' => $project1->id,
        ]);

        Task::create([
            'title' => 'Task 1 for Beta',
            'description' => 'Description for Task 1',
            'status' => 'completed',
            'priority' => 'low',
            'due_date' => now()->addDays(30),
            'project_id' => $project2->id,
        ]);

        // ربط المستخدمين بالمشاريع مع أدوار
        $project1->users()->attach(User::where('email', 'admin@example.com')->first()->id, [
            'role' => 'manager',
            'contribution_hours' => 10,
            'last_activity' => now(),
        ]);

        $project1->users()->attach(User::where('email', 'devone@example.com')->first()->id, [
            'role' => 'developer',
            'contribution_hours' => 20,
            'last_activity' => now(),
        ]);

        $project2->users()->attach(User::where('email', 'testerone@example.com')->first()->id, [
            'role' => 'tester',
            'contribution_hours' => 5,
            'last_activity' => now(),
        ]);
    }
}
