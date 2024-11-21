<?php

declare(strict_types=1);

namespace App\Repositories\State;

use App\Models\State;
use Illuminate\Support\Collection;

class StateRepository implements StateRepositoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function fetchStateByProjectId(string $projectId, array $columns = ['*']): Collection
    {
        return State::where('project_id', $projectId)->select($columns)->get();
    }

    /**
     * {@inheritDoc}
     */
    public function bulkInsertStates(array $data): void
    {
        State::insert($data);
    }
}
