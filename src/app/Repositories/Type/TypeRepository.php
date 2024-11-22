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

    /**
     * {@inheritDoc}
     */
    public function storeType(array $params): void
    {
        Type::create($params);
    }

    /**
     * {@inheritDoc}
     */
    public function existsType(int $typeId): bool
    {
        return Type::where('id', $typeId)->exists();
    }

    /**
     * {@inheritDoc}
     */
    public function deleteType(int $typeId): void
    {
        Type::destroy($typeId);
    }
}
