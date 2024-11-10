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
}
