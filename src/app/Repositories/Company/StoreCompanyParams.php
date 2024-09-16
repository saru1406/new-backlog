<?php

namespace App\Repositories\Company;

class StoreCompanyParams
{
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
