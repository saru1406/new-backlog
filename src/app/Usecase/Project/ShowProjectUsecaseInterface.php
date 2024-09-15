<?php

declare(strict_types=1);

namespace App\Usecase\Project;

use App\Models\Project;

interface ShowProjectUsecaseInterface
{
    /**
     *プロジェクトのshowビューで使用
     *
     * @return Project
     */
    public function execute(string $projectId): Project;
}
