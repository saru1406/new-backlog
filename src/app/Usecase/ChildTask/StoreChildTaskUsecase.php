<?php

declare(strict_types=1);

namespace App\Usecase\ChildTask;

use App\Models\User;
use App\Repositories\ChildTask\ChildTaskRepositoryInterface;
use App\Repositories\ChildTask\StoreChildTaskParams;
use App\Services\ChildTask\ChildTaskServiceInterface;
use Illuminate\Support\Facades\Auth;

class StoreChildTaskUsecase implements StoreChildTaskUsecaseInterface
{
    public function __construct(
        private readonly ChildTaskRepositoryInterface $childTaskRepository,
        private readonly ChildTaskServiceInterface $childTaskService,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function execute(StoreChildTaskParams $params): void
    {
        $user = Auth::user();
        $this->childTaskService->checkEndDate($params);
        $arrayParams = $this->addParamsArray($params, $user);
        $this->childTaskRepository->store($arrayParams);
    }

    /**
     * Paramsに情報を追加
     *
     * @param StoreChildTaskParams $params
     * @param User $user
     * @return array
     */
    private function addParamsArray(StoreChildTaskParams $params, User $user): array
    {
        $paramsArray = $params->toArray();
        $paramsArray['user_id'] = $user->id;
        $paramsArray['company_id'] = $user->company_id;

        return $paramsArray;
    }
}
