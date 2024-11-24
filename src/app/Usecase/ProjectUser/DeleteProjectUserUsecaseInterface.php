<?php

declare(strict_types=1);

namespace App\Usecase\ProjectUser;

interface DeleteProjectUserUsecaseInterface
{
    /**
     * ユーザーをプロジェクトに削除
     *
     * @param string $projectId
     * @param string $userId
     * @return void
     */
    public function execute(string $projectId, string $userId): void;
}
