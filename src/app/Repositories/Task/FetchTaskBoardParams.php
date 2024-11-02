<?php

declare(strict_types=1);

namespace App\Repositories\Task;

class FetchTaskBoardParams
{
    /**
     * プロジェクトID
     *
     * @var string
     */
    public readonly string $project_id;

    /**
     * 種別ID
     *
     * @var int|null
     */
    public readonly ?int $type_id;

    /**
     * 状態ID
     *
     * @var int|null
     */
    public readonly ?int $state_id;

    /**
     * 担当者ID
     *
     * @var string|null
     */
    public readonly ?string $manager;

    /**
     * 優先度ID
     *
     * @var int|null
     */
    public readonly ?int $priority_id;

    /**
     * バージョンID
     *
     * @var int|null
     */
    public readonly ?int $version_id;

    /**
     * __construct
     *
     * @param string $project_id
     * @param ?int $type_id
     * @param ?int $state_id
     * @param ?string $manager
     * @param ?int $priority_id
     * @param ?int $version_id
     */
    public function __construct(
        string $project_id,
        ?int $type_id,
        ?int $state_id,
        ?string $manager,
        ?int $priority_id,
        ?int $version_id,
    ) {
        $this->project_id = $project_id;
        $this->type_id = $type_id;
        $this->state_id = $state_id;
        $this->manager = $manager;
        $this->priority_id = $priority_id;
        $this->version_id = $version_id;
    }

    /**
     * 配列に変換
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'project_id' => $this->project_id,
            'type_id' => $this->type_id,
            'state_id' => $this->state_id,
            'manager' => $this->manager,
            'priority_id' => $this->priority_id,
            'version_id' => $this->version_id,
        ];
    }
}
