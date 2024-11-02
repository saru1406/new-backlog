<?php

declare(strict_types=1);

namespace App\Repositories\Type;

use Illuminate\Support\Collection;

interface TypeRepositoryInterface
{
    /**
     * プロジェクトIDによる種別を取得
     *
     * @param string $projectId
     * @param array $columns
     * @return Collection
     */
    public function fetchTypeByProjectId(string $projectId, $columns = ['*']): Collection;
}
