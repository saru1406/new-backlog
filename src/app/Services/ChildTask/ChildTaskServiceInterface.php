<?php

declare(strict_types=1);

namespace App\Services\ChildTask;

use App\Exceptions\InvalidDateException;
use App\Repositories\ChildTask\StoreChildTaskParams;

interface ChildTaskServiceInterface
{
    /**
     * 期限日が開始日より後日に設定されているか確認
     *
     * @param StoreChildTaskParams $params
     *
     * @throws InvalidDateException
     *
     * @return void
     */
    public function checkEndDate(StoreChildTaskParams $params): void;
}
