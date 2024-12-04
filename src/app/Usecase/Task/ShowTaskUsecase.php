<?php

declare(strict_types=1);

namespace App\Usecase\Task;

use App\Repositories\ChildTask\ChildTaskRepositoryInterface;
use App\Repositories\Priority\PriorityRepositoryInterface;
use App\Repositories\State\StateRepositoryInterface;
use App\Repositories\Task\TaskRepositoryInterface;
use App\Repositories\Type\TypeRepositoryInterface;
use App\Services\Project\ProjectServiceInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class ShowTaskUsecase implements ShowTaskUsecaseInterface
{
    public function __construct(
        private readonly TaskRepositoryInterface $taskRepository,
        private readonly ProjectServiceInterface $projectService,
        private readonly StateRepositoryInterface $stateRepository,
        private readonly TypeRepositoryInterface $typeRepository,
        private readonly PriorityRepositoryInterface $priorityRepository,
        private readonly ChildTaskRepositoryInterface $childTaskRepository,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function execute(int $taskId, string $projectId): Collection
    {
        $user = Auth::user();
        $project = $this->projectService->fetchProject($user, $projectId);
        $task = $this->taskRepository->find($taskId, ['state', 'type', 'priority', 'manager', 'user']);
        $states = $this->stateRepository->fetchStateByProjectId($projectId);
        $types = $this->typeRepository->fetchTypeByProjectId($projectId);
        $priorities = $this->priorityRepository->fetchPriorityByProjectId($projectId);
        $childTasks = $this->childTaskRepository->fetchByTask($taskId, ['state', 'type', 'priority', 'manager', 'user']);

        return collect(['project' => $project, 'task' => $task, 'states' => $states, 'types' => $types, 'priorities' => $priorities, 'child_tasks' => $childTasks]);
    }
}
