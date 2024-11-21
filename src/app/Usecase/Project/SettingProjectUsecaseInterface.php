<?php

declare(strict_types=1);

namespace App\Usecase\Project;

use Illuminate\Support\Collection;

interface SettingProjectUsecaseInterface
{
    /**
     * プロジェクトの設定画面
     *
     * @param string $projectId
     * @return Collection<string, Collection<\App\Models\Priority>|Collection<\App\Models\State>|Collection<\App\Models\Type>|Collection<\App\Models\User>>
     */
    public function execute(string $projectId): Collection;
}
