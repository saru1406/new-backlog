<?php

declare(strict_types=1);

namespace App\Usecase\Task;

use App\Repositories\Task\TaskRepositoryInterface;
use App\Services\Project\ProjectServiceInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class BoardTaskUsecase implements BoardTaskUsecaseInterface
{
    public function __construct(private readonly TaskRepositoryInterface $taskRepository, private readonly ProjectServiceInterface $projectService)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function execute(string $projectId): Collection
    {
        $user = Auth::user();

        $project = $this->projectService->fetchProject($user, $projectId);

        $tasks = $this->taskRepository->fetchTaskByProjectId($projectId, ['user', 'manager']);

        return collect(['project' => $project, 'tasks' => $tasks]);
    }
}
