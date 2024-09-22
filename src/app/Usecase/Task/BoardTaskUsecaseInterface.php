<?php

declare(strict_types=1);

namespace App\Usecase\Task;

use Illuminate\Support\Collection;

interface BoardTaskUsecaseInterface
{
    /**
     * ボードに表示するTaskを取得
     *
     * @param string $projectId
     * @return Collection
     */
    public function execute(string $projectId): Collection;
}
