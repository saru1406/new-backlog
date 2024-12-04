<?php

declare(strict_types=1);

namespace App\Usecase\ProjectUser;

use App\Repositories\ProjectUser\StoreProjectUserParams;

interface StoreProjectUserUsecaseInterface
{
    /**
     * ユーザーをプロジェクトに追加・保存
     *
     * @param StoreProjectUserParams $params
     * @return void
     */
    public function execute(StoreProjectUserParams $params): void;
}
