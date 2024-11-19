<?php

declare(strict_types=1);

namespace App\Usecase\Task;

use App\Repositories\Priority\PriorityRepositoryInterface;
use App\Repositories\State\StateRepositoryInterface;
use App\Repositories\Task\TaskRepositoryInterface;
use App\Repositories\Type\TypeRepositoryInterface;
use App\Services\Project\ProjectServiceInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class IndexTaskUsecase implements IndexTaskUsecaseInterface
{
    public function __construct(
        private readonly TaskRepositoryInterface $taskRepository,
        private readonly ProjectServiceInterface $projectService,
        private readonly StateRepositoryInterface $stateRepository,
        private readonly TypeRepositoryInterface $typeRepository,
        private readonly PriorityRepositoryInterface $priorityRepository,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function execute(string $projectId): Collection
    {
        $user = Auth::user();
        $project = $this->projectService->fetchProject($user, $projectId);
        $states = $this->stateRepository->fetchStateByProjectId($projectId);
        $types = $this->typeRepository->fetchTypeByProjectId($projectId);
        $priorities = $this->priorityRepository->fetchPriorityByProjectId($projectId);
        $tasks = $this->taskRepository->fetchTaskByProjectIdWithPagination(
            projectId: $projectId,
            params: ['state', 'type', 'priority', 'manager'],
            columns: ['id', 'title', 'state_id', 'type_id', 'priority_id', 'manager_id', 'version_id', 'start_date', 'end_date'],
            page: 50
        );

        return Collect(['project' => $project, 'tasks' => $tasks, 'states' => $states, 'types' => $types, 'priorities' => $priorities]);
    }
}
