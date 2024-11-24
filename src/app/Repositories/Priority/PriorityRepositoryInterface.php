<?php

declare(strict_types=1);

namespace App\Repositories\Priority;

use Illuminate\Support\Collection;

interface PriorityRepositoryInterface
{
    /**
     * プロジェクトIDによる優先度を取得
     *
     * @param string $projectId
     * @param array $columns
     * @return Collection<\App\Models\Priority>
     */
    public function fetchPriorityByProjectId(string $projectId, array $columns = ['*']): Collection;

    /**
     * プロジェクトごとの優先度を一括保存
     *
     * @param array $data
     * @return void
     */
    public function bulkInsertPriorities(array $data): void;

    /**
     * プロジェクトごとの優先度を保存
     *
     * @param array $params
     * @return void
     */
    public function storePriority(array $params): void;

    /**
     * 優先度ID存在確認
     *
     * @param int $priorityId
     * @return bool
     */
    public function existsPriority(int $priorityId): bool;

    /**
     * 優先度削除
     *
     * @param int $priorityId
     * @return void
     */
    public function deletePriority(int $priorityId): void;
}
