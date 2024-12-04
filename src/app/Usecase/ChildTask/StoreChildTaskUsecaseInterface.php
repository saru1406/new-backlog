<?php

declare(strict_types=1);

namespace App\Usecase\ChildTask;

use App\Repositories\ChildTask\StoreChildTaskParams;

interface StoreChildTaskUsecaseInterface
{
    /**
     *タスクの保存
     *
     * @param StoreChildTaskParams $params
     * @return void
     */
    public function execute(StoreChildTaskParams $params): void;
}
