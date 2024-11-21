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
     * プロジェクトIDからタスクをページネーションで取得
     *
     * @param string $projectId
     * @param array $with
     * @param array $columns
     * @param ?int $page
     * @return LengthAwarePaginator
     */
    public function fetchTaskByProjectIdWithPagination(string $projectId, array $with = [], array $columns = ['*'], ?int $page = null): LengthAwarePaginator;

    /**
     * プロジェクトIDからタスクIDの最大値を取得
     *
     * @param string $projectId
     * @return int
     */
    public function fetchTaskMaxIdByProjectId(string $projectId): int;

    /**
     * プロジェクトIDからタスクを取得
     *
     * @param string $projectId
     * @param array $params
     * @param array $columns
     * @return Collection
     */
    public function fetchTaskByProjectId(string $projectId, array $params = [], array $columns = ['*']): Collection;

    /**
     * プロジェクトIDからタスクボードを取得
     *
     * @param FetchTaskBoardParams $params
     * @param array $with
     * @param array $columns
     * @param ?int $page
     * @return LengthAwarePaginator
     */
    public function fetchTaskBoarByProjectId(FetchTaskBoardParams $params, array $with = [], array $columns = ['*'], ?int $perPage = null): LengthAwarePaginator;
}
