<?php

namespace App\Repositories\User;

use App\Models\Company;

interface UserRepositoryInterface
{
    /**
     * ユーザーのCompanyIdを追加
     *
     * @param Company $company
     * @param string $userId
     * @return void
     */
    public function updateUserCompanyId(Company $company, string $userId): void;
}
