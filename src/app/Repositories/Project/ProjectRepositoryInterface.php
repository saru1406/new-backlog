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
     * @return Collection
     */
    public function projectByCompanyId(string $companyId): Collection;

    /**
     * プロジェクトを保存
     *
     * @param array $param
     * @return void
     */
    public function storeProject(array $param): void;

    /**
     * プロジェクトをIDから取得
     *
     * @param string $projectId
     * @return Project
     */
    public function findProject(string $projectId): Project;
}
