<?php

declare(strict_types=1);

namespace App\Usecase\Company;

interface StoreCompanyUsecaseInterface
{
    /**
     * 会社情報を保存
     *
     * @param string $name
     * @return void
     */
    public function execute(string $name): void;
}
