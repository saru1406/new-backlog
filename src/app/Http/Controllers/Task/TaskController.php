<?php

namespace App\Http\Controllers\Task;

use App\Exceptions\InvalidDateException;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Usecase\Project\ShowProjectUsecaseInterface;
use App\Usecase\Task\BoardTaskUsecaseInterface;
use App\Usecase\Task\IndexTaskUsecase;
use App\Usecase\Task\StoreTaskUsecaseInterface;
use App\ViewModels\Task\TaskBoardViewModel;
use Inertia\Inertia;
use Log;

class TaskController extends Controller
{
    public function __construct(
        private readonly ShowProjectUsecaseInterface $showProjectUsecase,
        private readonly StoreTaskUsecaseInterface $storeTaskUsecase,
        private readonly BoardTaskUsecaseInterface $boardTaskUsecase,
        private readonly IndexTaskUsecase $indexTaskUsecase,
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(string $projectId)
    {
        $project = $this->showProjectUsecase->execute($projectId);
        $tasks = $this->indexTaskUsecase->execute($projectId);

        return Inertia::render('Task/Index', ['project' => $project, 'tasks' => $tasks]);
    }

    public function board(string $projectId)
    {
        $data = $this->boardTaskUsecase->execute($projectId);
        $viewData = new TaskBoardViewModel($data);
        dd($viewData);

        return Inertia::render('Task/Board', ['project' => $viewData->project, 'tasks' => $viewData->tasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $projectId)
    {
        $project = $this->showProjectUsecase->execute($projectId);

        return Inertia::render('Task/Create', ['project' => $project, 'error_message' => session('error_message')]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        try {
            $this->storeTaskUsecase->execute($request->getParams());
        } catch (InvalidDateException $e) {
            Log::info($e->getMessage());

            // dd($e->getMessage());
            return to_route('tasks.create', ['projectId' => $request->getParams()->project_id])
                ->with('error_message', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
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
