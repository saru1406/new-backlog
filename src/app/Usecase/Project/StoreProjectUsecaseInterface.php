<?php

declare(strict_types=1);

namespace App\Usecase\Project;

interface StoreProjectUsecaseInterface
{
    /**
     * プロジェクトを保存
     *
     * @param string $projectName
     * @return void
     */
    public function execute(string $projectName): void;
}
