<?php

declare(strict_types=1);

namespace App\Usecase\Task;

use App\Repositories\Task\FetchTaskBoardParams;
use Illuminate\Pagination\LengthAwarePaginator;

interface FetchTaskBoardUsecaseInterface
{
    /**
     * タスク取得
     *
     * @param FetchTaskBoardParams $params
     * @return LengthAwarePaginator
     */
    public function execute(FetchTaskBoardParams $params): LengthAwarePaginator;
}
