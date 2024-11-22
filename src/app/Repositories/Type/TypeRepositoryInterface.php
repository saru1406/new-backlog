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

    /**
     * プロジェクトごとの種別を保存
     *
     * @param array $params
     * @return void
     */
    public function storeType(array $params): void;

    /**
     * 種別ID存在確認
     *
     * @param int $typeId
     * @return bool
     */
    public function existsType(int $typeId): bool;

    /**
     * 種別削除
     *
     * @param int $typeId
     * @return void
     */
    public function deleteType(int $typeId): void;
}
