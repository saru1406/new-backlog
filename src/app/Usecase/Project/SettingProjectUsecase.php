<?php

declare(strict_types=1);

namespace App\Usecase\Project;

use App\Repositories\Priority\PriorityRepositoryInterface;
use App\Repositories\State\StateRepositoryInterface;
use App\Repositories\Task\TaskRepositoryInterface;
use App\Repositories\Type\TypeRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
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
        private readonly UserRepositoryInterface $userRepository
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
        $companyUsers = $this->userRepository->fetchUserByCompanyId($user->company_id, ['id', 'name']);
        $companyUsersDiff = $this->userDiff($project->users, $companyUsers);

        return Collect(['project' => $project, 'states' => $states, 'types' => $types, 'priorities' => $priorities, 'company_user' => $companyUsersDiff]);
    }

    /**
     * 企業のユーザとプロジェクトのユーザを比較し重複排除
     *
     * @param \Illuminate\Support\Collection $users
     * @param \Illuminate\Support\Collection $companyUsers
     * @return \Illuminate\Support\Collection
     */
    private function userDiff(Collection $users, Collection $companyUsers): Collection
    {
        return $companyUsers->diff($users);
    }
}
