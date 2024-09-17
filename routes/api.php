<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// دمج كل الـ routes في مجموعة واحدة
Route::middleware(['auth:sanctum'])->group(function () {

    // المسارات الخاصة بالمهام
    Route::resource('tasks', TaskController::class);
    Route::patch('/tasks/{task}/status', [TaskController::class, 'updateStatus']);
    Route::patch('/tasks/{task}/notes', [TaskController::class, 'addNotes']);

    // المسارات الخاصة بالمشاريع
    Route::resource('projects', ProjectController::class);
    Route::get('/projects/{project}/latest-task', [ProjectController::class, 'latestTask']);
    Route::get('/projects/{project}/oldest-task', [ProjectController::class, 'oldestTask']);

    // المسارات الخاصة بالمستخدمين
    Route::resource('users', UserController::class);
});
