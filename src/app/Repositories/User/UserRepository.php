<?php

namespace App\Repositories\User;

use App\Models\Company;
use App\Models\User;
use Auth;

class UserRepository implements UserRepositoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function updateUserCompanyId(Company $company, string $userId): void
    {
        User::findOrFail($userId)->update(['company_id' => $company->id]);
    }
}
