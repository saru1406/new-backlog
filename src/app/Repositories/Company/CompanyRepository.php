<?php

namespace App\Repositories\Company;

use App\Models\Company;

class CompanyRepository implements CompanyRepositoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function storeCompany(array $param): Company
    {
        return Company::create($param);
    }

    /**
     * {@inheritDoc}
     */
    public function existsByDomain(string $domain): bool
    {
        return Company::where('domain', $domain)->exists();
    }
}
