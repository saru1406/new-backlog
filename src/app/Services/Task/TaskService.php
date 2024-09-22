<?php

declare(strict_types=1);

namespace App\Services\Task;

use App\Exceptions\InvalidDateException;
use App\Repositories\Task\StoreTaskParams;

class TaskService implements TaskServiceInterface
{
    public function __construct()
    {
    }

    /**
     * {@inheritDoc}
     */
    public function checkEndDate(StoreTaskParams $params): void
    {
        if ($params->start_date && $params->end_date) {
            if ($params->start_date > $params->end_date) {
                throw new InvalidDateException('期限日は開始日より後日を設定してください');
            }
        }
    }
}
