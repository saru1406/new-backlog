<?php

declare(strict_types=1);

namespace App\Usecase\Project;

use App\Enums\Priority\PriorityEnum;
use App\Enums\State\StateEnum;
use App\Enums\Type\TypeEnum;
use App\Repositories\Priority\PriorityRepositoryInterface;
use App\Repositories\Project\ProjectRepositoryInterface;
use App\Repositories\State\StateRepositoryInterface;
use App\Repositories\Type\TypeRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class StoreProjectUsecase implements StoreProjectUsecaseInterface
{
    public function __construct(
        private readonly ProjectRepositoryInterface $projectRepository,
        private readonly TypeRepositoryInterface $typeRepository,
        private readonly StateRepositoryInterface $stateRepository,
        private readonly PriorityRepositoryInterface $priorityRepository,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function execute(string $projectName): Collection
    {
        $user = Auth::user();

        $project = $this->projectRepository->storeProject(['company_id' => $user->company_id, 'project_name' => $projectName], $user->id);

        $typesData = $this->createTypes($project->id);
        $this->typeRepository->bulkInsertTypes($typesData);

        $statesData = $this->createStates($project->id);
        $this->stateRepository->bulkInsertStates($statesData);

        $prioritiesData = $this->createPriorities($project->id);
        $this->priorityRepository->bulkInsertPriorities($prioritiesData);

        return $this->projectRepository->projectByCompanyId($user->company_id);
    }

    /**
     * 種別初期データ作成
     *
     * @param string $projectId
     * @return array
     */
    private function createTypes(string $projectId): array
    {
        $types = TypeEnum::toArray();

        return array_map(function ($type) use ($projectId) {
            return [
                'type_name' => $type,
                'project_id' => $projectId,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }, $types);
    }

    /**
     * 状態初期データ作成
     *
     * @param string $projectId
     * @return array
     */
    private function createStates(string $projectId): array
    {
        $states = StateEnum::toArray();

        return array_map(function ($state) use ($projectId) {
            return [
                'state_name' => $state,
                'project_id' => $projectId,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }, $states);
    }

    /**
     * 優先度初期データ作成
     *
     * @param string $projectId
     * @return array
     */
    private function createPriorities(string $projectId): array
    {
        $priorities = PriorityEnum::toArray();

        return array_map(function ($priority) use ($projectId) {
            return [
                'priority_name' => $priority,
                'project_id' => $projectId,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }, $priorities);
    }
}
