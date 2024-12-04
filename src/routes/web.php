<?php

use App\Http\Controllers\ChildTask\ChildTaskController;
use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\Priority\PriorityController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Project\ProjectController;
use App\Http\Controllers\ProjectUser\ProjectUserController;
use App\Http\Controllers\Task\TaskController;
use App\Http\Controllers\Type\TypeController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // プロフィール
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Company
    Route::get('/company/create', [CompanyController::class, 'create'])->name('companies.create');
    Route::post('/companies', [CompanyController::class, 'store'])->name('companies.store');

    // Project
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{projectId}', [ProjectController::class, 'show'])->name('projects.show');

    Route::group(['prefix' => '/projects/{projectId}'], function () {
        // Project設定
        Route::get('/setting', [ProjectController::class, 'setting'])->name('projects.setting');

        // Type
        Route::post('/types', [TypeController::class, 'store'])->name('types.store');
        Route::delete('/types/{typeId}', [TypeController::class, 'destroy'])->name('types.destroy');

        // Priority
        Route::post('/priorities', [PriorityController::class, 'store'])->name('priorities.store');
        Route::delete('/priorities/{priorityId}', [PriorityController::class, 'destroy'])->name('priorities.destroy');

        // ProjectUser
        Route::post('/users', [ProjectUserController::class, 'store'])->name('project_users.store');
        Route::delete('/users/{userId}', [ProjectUserController::class, 'destroy'])->name('project_users.destroy');

        Route::group(['prefix' => '/tasks'], function () {
            //Board
            Route::get('/board', [TaskController::class, 'board'])->name('tasks.board');

            //Gantt
            Route::get('/gantt', [TaskController::class, 'gantt'])->name('tasks.gantt');

            // Task
            Route::get('/create', [TaskController::class, 'create'])->name('tasks.create');
            Route::post('/', [TaskController::class, 'store'])->name('tasks.store');
            Route::get('/', [TaskController::class, 'index'])->name('tasks.index');
            Route::get('/{taskId}', [TaskController::class, 'show'])->name('tasks.show');

            Route::group(['prefix' => '{taskId}'], function () {
                // ChildTask
                Route::post('/child-tasks', [ChildTaskController::class, 'store'])->name('child_tasks.store');
            });
        });
    });
});

require __DIR__.'/auth.php';
