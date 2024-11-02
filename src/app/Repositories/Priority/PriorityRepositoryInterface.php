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
     * @return Collection
     */
    public function fetchPriorityByProjectId(string $projectId, $columns = ['*']): Collection;
}
