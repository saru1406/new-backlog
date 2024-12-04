<?php

declare(strict_types=1);

namespace App\Repositories\ProjectUser;

use App\Models\ProjectUser;

interface ProjectUserRepositoryInterface
{
    /**
     * プロジェクトにユーザーを追加
     *
     * @param array $params
     * @return void
     */
    public function storeProjectUser(array $params): void;

    /**
     * プロジェクトのユーザを削除
     *
     * @param int $projectUserId
     * @return void
     */
    public function deleteProjectUser(int $projectUserId): void;

    /**
     * プロジェクトのユーザを取得
     *
     * @param string $projectId
     * @param string $userId
     * @return ProjectUser
     */
    public function findProjectUser(string $projectId, string $userId): ProjectUser;
}
