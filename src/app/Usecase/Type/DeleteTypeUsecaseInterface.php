<?php

declare(strict_types=1);

namespace App\Usecase\Type;

interface DeleteTypeUsecaseInterface
{
    /**
     * 種別を追加・保存
     *
     * @param string $projectId
     * @param int $typeId
     * @return void
     */
    public function execute(string $projectId, int $typeId): void;
}
