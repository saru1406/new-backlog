<?php

declare(strict_types=1);

namespace App\Services\Company;

interface CompanyServiceInterface
{
    /**
     * メールアドレスからドメインを取得
     *
     * @param string $email
     * @return string
     */
    public function getDomainByEmail(string $email): string;
}
