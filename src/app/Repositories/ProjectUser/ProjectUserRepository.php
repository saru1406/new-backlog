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
}
