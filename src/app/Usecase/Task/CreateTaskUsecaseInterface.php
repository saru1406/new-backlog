<?php

declare(strict_types=1);

namespace App\Usecase\Task;

use Illuminate\Support\Collection;

interface CreateTaskUsecaseInterface
{
    /**
     * タスク作成画面にて使用
     *
     * @param string $projectId
     * @return Collection
     */
    public function execute(string $projectId): Collection;
}
