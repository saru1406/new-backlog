<?php

declare(strict_types=1);

namespace App\Services\Task;

use App\Exceptions\InvalidDateException;
use App\Repositories\Task\StoreTaskParams;

interface TaskServiceInterface
{
    /**
     * 期限日が開始日より後日に設定されているか確認
     *
     * @param StoreTaskParams $params
     *
     * @throws InvalidDateException
     *
     * @return void
     */
    public function checkEndDate(StoreTaskParams $params): void;
}
