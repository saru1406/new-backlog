<?php

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
