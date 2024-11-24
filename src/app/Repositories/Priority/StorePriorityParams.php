<?php

declare(strict_types=1);

namespace App\Repositories\Priority;

class StorePriorityParams
{
    /**
     * プロジェクトID
     *
     * @var string
     */
    public readonly string $projectId;

    /**
     * 優先度名
     *
     * @var string
     */
    public readonly string $priorityName;

    public function __construct(string $projectId, string $priorityName)
    {
        $this->projectId = $projectId;
        $this->priorityName = $priorityName;
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
            'priority_name' => $this->priorityName,
        ];
    }
}
