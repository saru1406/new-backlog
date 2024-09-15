<?php

declare(strict_types=1);

namespace App\Services\Project;

use App\Models\Project;
use App\Models\User;

interface ProjectServiceInterface
{
    /**
     * プロジェクトの取得
     *
     * @param User $user
     * @param string $projectId
     * @return Project
     */
    public function fetchProject(User $user, string $projectId): Project;
}
