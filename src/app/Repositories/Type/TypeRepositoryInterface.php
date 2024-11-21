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
     * @return Collection<\App\Models\Type>
     */
    public function fetchTypeByProjectId(string $projectId, array $columns = ['*']): Collection;

    /**
     * プロジェクトごとの種別を一括保存
     *
     * @param array $data
     * @return void
     */
    public function bulkInsertTypes(array $data): void;
}
