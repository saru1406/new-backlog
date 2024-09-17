<?php

declare(strict_types=1);

namespace App\Repositories\Task;

use App\Models\Task;

class TaskRepository implements TaskRepositoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function store(array $params): void
    {
        Task::create($params);
    }
}
