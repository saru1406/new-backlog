<?php

declare(strict_types=1);

namespace App\Usecase\Task;

use Illuminate\Support\Collection;

interface ShowTaskUsecaseInterface
{
    /**
     *タスクの詳細画面
     *
     * @param int $taskId
     * @param string $projectId
     * @return Collection<string, Collection<\App\Models\Project>|\App\Models\Task|Collection<\App\Models\Priority>|Collection<\App\Models\State>|Collection<\App\Models\Type>>
     */
    public function execute(int $taskId, string $projectId): Collection;
}
