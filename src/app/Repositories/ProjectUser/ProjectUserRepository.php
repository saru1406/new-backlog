<?php

declare(strict_types=1);

namespace App\Repositories\ProjectUser;

use App\Models\Company;
use App\Models\ProjectUser;
use App\Models\User;

class ProjectUserRepository implements ProjectUserRepositoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function storeProjectUser(array $params): void
    {
        ProjectUser::create($params);
    }

    /**
     * {@inheritDoc}
     */
    public function deleteProjectUser(int $projectUserId): void
    {
        ProjectUser::destroy($projectUserId);
    }

    /**
     * {@inheritDoc}
     */
    public function findProjectUser(string $projectId, string $userId): ProjectUser
    {
        return ProjectUser::where(['project_id' => $projectId, 'user_id' => $userId])->firstOrFail();
    }
}
