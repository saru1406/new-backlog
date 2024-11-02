<?php

declare(strict_types=1);

namespace App\Usecase\Task;

use App\Repositories\Task\FetchTaskBoardParams;
use App\Repositories\Task\TaskRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class FetchTaskBoardUsecase implements FetchTaskBoardUsecaseInterface
{
    public function __construct(private readonly TaskRepositoryInterface $taskRepository)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function execute(FetchTaskBoardParams $params): LengthAwarePaginator
    {
        return $this->taskRepository->fetchTaskBoarByProjectId(
            $params,
            ['manager'],
            ['id', 'user_id', 'project_id', 'type_id', 'state_id', 'priority_id', 'version_id', 'title', 'body', 'start_date', 'end_date'],
            10
        );
    }
}
