<?php

declare(strict_types=1);

namespace App\Repositories\Project;

use App\Models\Project;
use Illuminate\Support\Collection;

class ProjectRepository implements ProjectRepositoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function projectByCompanyId(string $companyId, $columns = ['*']): Collection
    {
        return Project::where('company_id', $companyId)->select($columns)->get();
    }

    /**
     * {@inheritDoc}
     */
    public function storeProject(array $param): void
    {
        Project::create($param);
    }

    /**
     * {@inheritDoc}
     */
    public function findProject(string $projectId, $columns = ['*']): Project
    {
        return Project::select($columns)->findOrFail($projectId);
    }
}
