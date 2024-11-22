<?php

declare(strict_types=1);

namespace App\Usecase\Priority;

interface DeletePriorityUsecaseInterface
{
    /**
     * 優先度を追加・保存
     *
     * @param string $projectId
     * @param int $priorityId
     * @return void
     */
    public function execute(string $projectId, int $priorityId): void;
}
