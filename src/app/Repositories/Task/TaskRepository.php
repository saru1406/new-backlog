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
    public function fetchTaskByProjectIdWithPagination(string $projectId, array $with = [], array $columns = ['*'], ?int $page = null): LengthAwarePaginator
    {
        return Task::where('project_id', $projectId)
            ->select($columns)
            ->with($with)
            ->orderBy('id', 'desc')
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

    /**
     * {@inheritDoc}
     */
    public function fetchTaskBoarByProjectId(FetchTaskBoardParams $params, array $with = [], array $columns = ['*'], ?int $perPage = null): LengthAwarePaginator
    {
        $query = Task::query();
        $query->where('project_id', $params->project_id);

        if ($params->state_id) {
            $query->where('state_id', $params->state_id);
        }
        if ($params->version_id) {
            $query->where('version_id', $params->version_id);
        }
        if ($params->priority_id) {
            $query->where('priority_id', $params->priority_id);
        }
        if ($params->type_id) {
            $query->where('type_id', $params->type_id);
        }
        if ($params->manager_id) {
            $query->where('manager_id', $params->manager_id);
        }

        return $query
            ->select($columns)
            ->with($with)
            ->paginate($perPage);
    }
}
