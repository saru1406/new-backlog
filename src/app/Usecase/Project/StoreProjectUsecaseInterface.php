<?php

declare(strict_types=1);

namespace App\Usecase\Project;

use Illuminate\Support\Collection;

interface StoreProjectUsecaseInterface
{
    /**
     * プロジェクトを保存
     *
     * @param string $projectName
     * @return Collection
     */
    public function execute(string $projectName): Collection;
}
