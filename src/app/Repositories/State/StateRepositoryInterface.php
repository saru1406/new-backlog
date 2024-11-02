<?php

declare(strict_types=1);

namespace App\Repositories\State;

use Illuminate\Support\Collection;

interface StateRepositoryInterface
{
    /**
     * プロジェクトIDによる状態を取得
     *
     * @param string $projectId
     * @param array $columns
     * @return Collection
     */
    public function fetchStateByProjectId(string $projectId, $columns = ['*']): Collection;
}
