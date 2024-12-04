<?php

namespace App\Http\Controllers\Task;

use App\Exceptions\InvalidDateException;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Usecase\Project\ShowProjectUsecaseInterface;
use App\Usecase\Task\BoardTaskUsecaseInterface;
use App\Usecase\Task\CreateTaskUsecaseInterface;
use App\Usecase\Task\GanttTaskUsecaseInterface;
use App\Usecase\Task\IndexTaskUsecaseInterface;
use App\Usecase\Task\ShowTaskUsecaseInterface;
use App\Usecase\Task\StoreTaskUsecaseInterface;
use Inertia\Inertia;
use Log;

class TaskController extends Controller
{
    public function __construct(
        private readonly ShowProjectUsecaseInterface $showProjectUsecase,
        private readonly StoreTaskUsecaseInterface $storeTaskUsecase,
        private readonly BoardTaskUsecaseInterface $boardTaskUsecase,
        private readonly IndexTaskUsecaseInterface $indexTaskUsecase,
        private readonly GanttTaskUsecaseInterface $ganttTaskUsecase,
        private readonly CreateTaskUsecaseInterface $createTaskUsecase,
        private readonly ShowTaskUsecaseInterface $showTaskUsecase,
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(string $projectId)
    {
        $data = $this->indexTaskUsecase->execute($projectId);

        return Inertia::render('Task/Index', [
            'project' => $data['project'],
            'tasks' => $data['tasks'],
            'states' => $data['states'],
            'types' => $data['types'],
            'priorities' => $data['priorities'],
        ]);
    }

    public function board(string $projectId)
    {
        $data = $this->boardTaskUsecase->execute($projectId);

        return Inertia::render('Task/Board', [
            'project' => $data['project'],
            'states' => $data['states'],
            'types' => $data['types'],
            'priorities' => $data['priorities'],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $projectId)
    {
        $data = $this->createTaskUsecase->execute($projectId);

        return Inertia::render('Task/Create', [
            'project' => $data['project'],
            'users' => $data['project']->users,
            'states' => $data['states'],
            'types' => $data['types'],
            'priorities' => $data['priorities'],
            'error_message' => session('errors') ? session('errors')->get('message') : null,
            'message' => session('message') ? session('message') : null,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        try {
            $this->storeTaskUsecase->execute($request->getParams());

            return back()->with([
                'message' => '正常に作成されました',
            ]);
        } catch (InvalidDateException $e) {
            Log::info($e->getMessage());

            return back()->withErrors([
                'message' => $e->getMessage(),
            ])->withInput();
        }
    }

    public function gantt(string $projectId)
    {
        $data = $this->ganttTaskUsecase->execute($projectId);

        return Inertia::render('Task/Gantt', [
            'project' => $data['project'],
            'states' => $data['states'],
            'types' => $data['types'],
            'priorities' => $data['priorities'],
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $projectId, int $taskId)
    {
        $data = $this->showTaskUsecase->execute($taskId, $projectId);

        return Inertia::render('Task/Show', [
            'project' => $data['project'],
            'users' => $data['project']->users,
            'task' => $data['task'],
            'child_tasks' => $data['child_tasks'],
            'states' => $data['states'],
            'types' => $data['types'],
            'priorities' => $data['priorities'],
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}
