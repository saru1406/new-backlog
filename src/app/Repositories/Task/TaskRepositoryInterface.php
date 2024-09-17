<?php

declare(strict_types=1);

namespace App\Repositories\Task;

use App\Models\Company;

interface TaskRepositoryInterface
{
    /**
     * タスクを保存
     *
     * @param array{
     *   user_id: string,
     *   company_id: string,
     *   project_id: string,
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
}
