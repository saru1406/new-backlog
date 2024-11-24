<?php

use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\Priority\PriorityController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Project\ProjectController;
use App\Http\Controllers\ProjectUser\ProjectUserController;
use App\Http\Controllers\Task\TaskController;
use App\Http\Controllers\Type\TypeController;
use App\Http\Controllers\User\UserController;
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

        // User
        Route::post('/users', [ProjectUserController::class, 'store'])->name('project_users.store');

        // Task
        Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
        Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
        Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');

        //Board
        Route::get('/tasks/board', [TaskController::class, 'board'])->name('tasks.board');

        //Gantt
        Route::get('/tasks/gantt', [TaskController::class, 'gantt'])->name('tasks.gantt');
    });
});

require __DIR__.'/auth.php';
