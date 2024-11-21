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
    public function fetchTypeByProjectId(string $projectId, array $columns = ['*']): Collection
    {
        return Type::where('project_id', $projectId)->select($columns)->get();
    }

    /**
     * {@inheritDoc}
     */
    public function bulkInsertTypes(array $data): void
    {
        Type::insert($data);
    }
}
