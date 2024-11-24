<?php

declare(strict_types=1);

namespace App\Repositories\User;

use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Collection;

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

    /**
     * プロジェクトIDによるユーザを取得
     *
     * @param string $projectId
     * @param array $columns
     * @return Collection<User>
     */
    public function fetchUserByProjectId(string $projectId, array $columns = ['*']): Collection;

    /**
     * 企業IDによるユーザを取得
     *
     * @param string $companyId
     * @param array $columns
     * @return Collection<User>
     */
    public function fetchUserByCompanyId(string $companyId, array $columns = ['*']): Collection;

    /**
     * メールアドレスからユーザを取得
     *
     * @param string $email
     * @return User
     */
    public function firstUserByEmail(string $email): User;
}
