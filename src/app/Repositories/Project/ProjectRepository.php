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
    public function storeProject(array $param, string $userId): Project
    {
        $project = Project::create($param);
        $project->users()->syncWithoutDetaching([$userId]);

        return $project;
    }

    /**
     * {@inheritDoc}
     */
    public function findProject(string $projectId, $columns = ['*'], array $with = []): Project
    {
        return Project::with($with)->select($columns)->findOrFail($projectId);
    }
}
