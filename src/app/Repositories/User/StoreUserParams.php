<?php

declare(strict_types=1);

namespace App\Repositories\user;

class StoreUserParams
{
    /**
     * プロジェクトID
     *
     * @var string
     */
    public readonly string $projectId;

    /**
     * ユーザーID
     *
     * @var string
     */
    public readonly string $userId;

    public function __construct(string $projectId, string $userId)
    {
        $this->projectId = $projectId;
        $this->userId = $userId;
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
            'user_id' => $this->userId,
        ];
    }
}
