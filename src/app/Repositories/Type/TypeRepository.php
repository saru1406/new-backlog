<?php

declare(strict_types=1);

namespace App\Repositories\Type;

use App\Models\Type;
use Illuminate\Support\Collection;

class TypeRepository implements TypeRepositoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function fetchTypeByProjectId(string $projectId, $columns = ['*']): Collection
    {
        return Type::where('project_id', $projectId)->select($columns)->get();
    }
}
