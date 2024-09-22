<?php

declare(strict_types=1);

namespace App\Repositories\Task;

use App\Models\Task;
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
    public function fetchTaskByProjectId(string $projectId, array $params = [], array $columns = ['*']): Collection
    {
        return Task::where('project_id', $projectId)
            ->select($columns)
            ->with($params)
            ->get();
    }
}
