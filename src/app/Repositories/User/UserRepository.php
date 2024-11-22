<?php

declare(strict_types=1);

namespace App\Repositories\User;

use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Collection;

class UserRepository implements UserRepositoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function updateUserCompanyId(Company $company, string $userId): void
    {
        User::findOrFail($userId)->update(['company_id' => $company->id]);
    }

    /**
     * {@inheritDoc}
     */
    public function fetchUserByProjectId(string $projectId, array $columns = ['*']): Collection
    {
        return User::where('project_id', $projectId)->select($columns)->get();
    }

    /**
     * {@inheritDoc}
     */
    public function fetchUserByCompanyId(string $companyId, array $columns = ['*']): Collection
    {
        return User::where('company_id', $companyId)->select($columns)->get();
    }

    /**
     * {@inheritDoc}
     */
    public function storeUser(array $params): void
    {
        User::create($params);
    }
}
