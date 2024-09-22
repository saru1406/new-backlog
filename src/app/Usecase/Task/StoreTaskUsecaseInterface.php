<?php

declare(strict_types=1);

namespace App\Usecase\Task;

use App\Repositories\Task\StoreTaskParams;

interface StoreTaskUsecaseInterface
{
    /**
     *タスクの保存
     *
     * @param StoreTaskParams $params
     * @return void
     */
    public function execute(StoreTaskParams $params): void;
}
