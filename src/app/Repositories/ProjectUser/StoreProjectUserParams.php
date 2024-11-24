<?php

declare(strict_types=1);

namespace App\Repositories\ProjectUser;

class StoreProjectUserParams
{
    /**
     * プロジェクトID
     *
     * @var string
     */
    public readonly string $projectId;

    /**
     * ユーザメールアドレス
     *
     * @var string
     */
    public readonly string $userEmail;

    public function __construct(string $projectId, string $userEmail)
    {
        $this->projectId = $projectId;
        $this->userEmail = $userEmail;
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
            'user_email' => $this->userEmail,
        ];
    }
}
