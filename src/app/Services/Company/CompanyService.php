<?php

declare(strict_types=1);

namespace App\Services\Company;

class CompanyService implements CompanyServiceInterface
{
    public function __construct()
    {
    }

    /**
     * {@inheritDoc}
     */
    public function getDomainByEmail(string $email): string
    {
        $parts = explode('@', $email);

        return $parts[1];
    }
}
