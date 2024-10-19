<?php

declare(strict_types=1);

namespace App\Usecase\Task;

use App\Repositories\Task\StoreTaskParams;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface IndexTaskUsecaseInterface
{
    /**
     *タスク一覧取得
     *
     * @param string $projectId
     * @return LengthAwarePaginator
     */
    public function execute(string $projectId): LengthAwarePaginator;
}
