<?php

declare(strict_types=1);

namespace App\Repositories\Project;

use App\Models\Project;
use Illuminate\Support\Collection;

interface ProjectRepositoryInterface
{
    /**
     * 企業IDによるプロジェクトを取得
     *
     * @param string $companyId
     * @param array $columns
     * @return Collection
     */
    public function projectByCompanyId(string $companyId, $columns = ['*']): Collection;

    /**
     * プロジェクトを保存
     *
     * @param array $param
     * @param string $userId
     * @return Project
     */
    public function storeProject(array $param, string $userId): Project;

    /**
     * プロジェクトをIDから取得
     *
     * @param string $projectId
     * @param array $columns
     * @param array $with
     * @return Project
     */
    public function findProject(string $projectId, $columns = ['*'], array $with = []): Project;
}
