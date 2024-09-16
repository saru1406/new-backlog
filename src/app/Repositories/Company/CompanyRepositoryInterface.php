<?php

declare(strict_types=1);

namespace App\Repositories\Company;

use App\Models\Company;

interface CompanyRepositoryInterface
{
    /**
     * 会社情報を保存
     *
     * @param array $param
     * @return Company
     */
    public function storeCompany(array $param): Company;

    /**
     * ドメインの存在を確認
     *
     * @param string $domain
     * @return bool
     */
    public function existsByDomain(string $domain): bool;
}
