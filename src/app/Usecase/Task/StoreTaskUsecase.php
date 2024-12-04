<?php

declare(strict_types=1);

namespace App\Usecase\Task;

use App\Models\User;
use App\Repositories\Project\ProjectRepositoryInterface;
use App\Repositories\Task\StoreTaskParams;
use App\Repositories\Task\TaskRepositoryInterface;
use App\Services\Task\TaskServiceInterface;
use Illuminate\Support\Facades\Auth;

class StoreTaskUsecase implements StoreTaskUsecaseInterface
{
    public function __construct(
        private readonly ProjectRepositoryInterface $projectRepository,
        private readonly TaskRepositoryInterface $taskRepository,
        private readonly TaskServiceInterface $taskService,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function execute(StoreTaskParams $params): void
    {
        $user = Auth::user();
        $this->taskService->checkEndDate($params);
        $arrayParams = $this->addParamsArray($params, $user);
        $this->taskRepository->store($arrayParams);
    }

    /**
     * Paramsに情報を追加
     *
     * @param StoreTaskParams $params
     * @param User $user
     * @return array
     */
    private function addParamsArray(StoreTaskParams $params, User $user): array
    {
        $paramsArray = $params->toArray();
        $paramsArray['user_id'] = $user->id;
        $paramsArray['company_id'] = $user->company_id;

        return $paramsArray;
    }
}
