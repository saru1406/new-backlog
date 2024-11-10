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
}
