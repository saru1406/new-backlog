<?php

declare(strict_types=1);

namespace App\Usecase\User;

use App\Repositories\user\StoreUserParams;

interface StoreUserUsecaseInterface
{
    /**
     * ユーザーを追加・保存
     *
     * @param StoreUserParams $params
     * @return void
     */
    public function execute(StoreUserParams $params): void;
}
