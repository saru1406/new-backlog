<?php

declare(strict_types=1);

namespace App\Usecase\Project;

use App\Repositories\Priority\PriorityRepositoryInterface;
use App\Repositories\State\StateRepositoryInterface;
use App\Repositories\Task\TaskRepositoryInterface;
use App\Repositories\Type\TypeRepositoryInterface;
use App\Services\Project\ProjectServiceInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class SettingProjectUsecase implements SettingProjectUsecaseInterface
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

        // return Collect(['project' => $project, 'states' => $states, 'types' => $types, 'priorities' => $priorities, 'managers' => $managers]);
        return Collect(['project' => $project, 'states' => $states, 'types' => $types, 'priorities' => $priorities]);
    }
}
