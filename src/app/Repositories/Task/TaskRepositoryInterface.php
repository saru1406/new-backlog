<?php

declare(strict_types=1);

namespace App\Repositories\Task;

use App\Models\Company;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

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

    /**
     * プロジェクトIDからタスクを取得
     *
     * @param string $projectId
     * @param array $params
     * @param array $columns
     * @param ?int $page
     * @return LengthAwarePaginator
     */
    public function fetchTaskByProjectId(string $projectId, array $params = [], array $columns = ['*'], ?int $page = null): LengthAwarePaginator;

    /**
     * プロジェクトIDからタスクIDの最大値を取得
     * @param string $projectId
     * @return int
     */
    public function fetchTaskMaxIdByProjectId(string $projectId): int;
}
