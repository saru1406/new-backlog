<?php

declare(strict_types=1);

namespace App\Repositories\ChildTask;

use Illuminate\Support\Collection;

interface ChildTaskRepositoryInterface
{
    /**
     * タスクを保存
     *
     * @param array{
     *   user_id: string,
     *   company_id: string,
     *   project_id: string,
     *   task_id: int,
     *   type: int,
     *   state_id: int,
     *   manager: string,
     *   priority_id: int,
     *   version_id: int,
     *   title: string,
     *   body: string,
     *   start_date: string,
     *   end_date: string,
     * } $params
     * @return void
     */
    public function store(array $params): void;

    /**
     * タスクIDから子タスクを取得
     *
     * @param int $taskId
     * @param array $with
     * @return Collection
     */
    public function fetchByTask(int $taskId, array $with = []): Collection;
}
