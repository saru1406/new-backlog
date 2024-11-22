<?php

declare(strict_types=1);

namespace App\Repositories\Priority;

use App\Models\Priority;
use Illuminate\Support\Collection;

class PriorityRepository implements PriorityRepositoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function fetchPriorityByProjectId(string $projectId, array $columns = ['*']): Collection
    {
        return Priority::where('project_id', $projectId)->select($columns)->get();
    }

    /**
     * {@inheritDoc}
     */
    public function bulkInsertPriorities(array $data): void
    {
        Priority::insert($data);
    }

    /**
     * {@inheritDoc}
     */
    public function storePriority(array $params): void
    {
        Priority::create($params);
    }

    /**
     * {@inheritDoc}
     */
    public function existsPriority(int $priorityId): bool
    {
        return Priority::where('id', $priorityId)->exists();
    }

    /**
     * {@inheritDoc}
     */
    public function deletePriority(int $priorityId): void
    {
        Priority::destroy($priorityId);
    }
}
