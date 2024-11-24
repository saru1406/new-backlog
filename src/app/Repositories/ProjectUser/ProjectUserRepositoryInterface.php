<?php

declare(strict_types=1);

namespace App\Repositories\ProjectUser;

interface ProjectUserRepositoryInterface
{
    /**
     * プロジェクトにユーザーを追加
     *
     * @param array $params
     * @return void
     */
    public function storeProjectUser(array $params): void;
}
