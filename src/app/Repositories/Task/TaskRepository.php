<?php

declare(strict_types=1);

namespace App\Repositories\Task;

use App\Models\Task;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class TaskRepository implements TaskRepositoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function store(array $params): void
    {
        Task::create($params);
    }

    /**
     * {@inheritDoc}
     */
    public function fetchTaskByProjectId(string $projectId, array $params = [], array $columns = ['*'], ?int $page = null): LengthAwarePaginator
    {
        return Task::where('project_id', $projectId)
            ->select($columns)
            ->with($params)
            ->paginate($page);
    }

    /**
     * {@inheritDoc}
     */
    public function fetchTaskMaxIdByProjectId(string $projectId): int
    {
        $maxTaskId = Task::where('project_id', $projectId)->max('id');
        if ($maxTaskId) {
            return $maxTaskId;
        }
        return 0;
    }
}
