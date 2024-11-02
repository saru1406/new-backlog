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
    public function fetchStateByProjectId(string $projectId, $columns = ['*']): Collection
    {
        return State::where('project_id', $projectId)->select($columns)->get();
    }
}
