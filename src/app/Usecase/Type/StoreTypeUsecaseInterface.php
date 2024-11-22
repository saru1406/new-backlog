<?php

declare(strict_types=1);

namespace App\Usecase\Type;

use App\Repositories\Type\StoreTypeParams;

interface StoreTypeUsecaseInterface
{
    /**
     * 種別を追加・保存
     *
     * @param StoreTypeParams $params
     * @return void
     */
    public function execute(StoreTypeParams $params): void;
}
