<?php

declare(strict_types=1);

namespace App\Repositories\Type;

class StoreTypeParams
{
    /**
     * プロジェクトID
     *
     * @var string
     */
    public readonly string $projectId;

    /**
     * 種別名
     *
     * @var string
     */
    public readonly string $typeName;

    public function __construct(string $projectId, string $typeName)
    {
        $this->projectId = $projectId;
        $this->typeName = $typeName;
    }

    /**
     * 配列に変換
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'project_id' => $this->projectId,
            'type_name' => $this->typeName,
        ];
    }
}
