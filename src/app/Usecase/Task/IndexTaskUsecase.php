<?php

declare(strict_types=1);

namespace App\Usecase\Task;

use App\Models\User;
use App\Repositories\Project\ProjectRepositoryInterface;
use App\Repositories\Task\StoreTaskParams;
use App\Repositories\Task\TaskRepositoryInterface;
use App\Services\Task\TaskServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class IndexTaskUsecase implements IndexTaskUsecaseInterface
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
    public function execute(string $projectId): LengthAwarePaginator
    {
        return $this->taskRepository->fetchTaskByProjectId(projectId: $projectId, params: ['manager'], page: 50);
    }
}
