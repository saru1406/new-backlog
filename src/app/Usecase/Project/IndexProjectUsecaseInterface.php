<?php

declare(strict_types=1);

namespace App\Usecase\Project;

use Illuminate\Database\Eloquent\Collection;

interface IndexProjectUsecaseInterface
{
    /**
     * プロジェクトのIndexビューで使用
     *
     * @return Collection
     */
    public function execute(): Collection;
}
