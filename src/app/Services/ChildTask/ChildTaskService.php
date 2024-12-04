<?php

declare(strict_types=1);

namespace App\Services\ChildTask;

use App\Exceptions\InvalidDateException;
use App\Repositories\ChildTask\StoreChildTaskParams;

class ChildTaskService implements ChildTaskServiceInterface
{
    public function __construct()
    {
    }

    /**
     * {@inheritDoc}
     */
    public function checkEndDate(StoreChildTaskParams $params): void
    {
        if ($params->start_date && $params->end_date) {
            if ($params->start_date > $params->end_date) {
                throw new InvalidDateException('期限日は開始日より後日を設定してください');
            }
        }
    }
}
