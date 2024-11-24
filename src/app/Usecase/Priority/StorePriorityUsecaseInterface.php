<?php

declare(strict_types=1);

namespace App\Usecase\Priority;

use App\Repositories\Priority\StorePriorityParams;

interface StorePriorityUsecaseInterface
{
    /**
     * 優先度を追加・保存
     *
     * @param StorePriorityParams $params
     * @return void
     */
    public function execute(StorePriorityParams $params): void;
}
