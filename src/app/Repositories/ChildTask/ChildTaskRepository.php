<?php

declare(strict_types=1);

namespace App\Repositories\ChildTask;

use App\Models\ChildTask;
use App\Models\Task;
use Illuminate\Support\Collection;

class ChildTaskRepository implements ChildTaskRepositoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function store(array $params): void
    {
        ChildTask::create($params);
    }

    /**
     * {@inheritDoc}
     */
    public function fetchByTask(int $taskId, array $with = []): Collection
    {
        return ChildTask::with($with)->where('task_id', $taskId)->get();
    }
}
