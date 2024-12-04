<?php

declare(strict_types=1);

namespace App\Repositories\ChildTask;

use Carbon\Carbon;

class StoreChildTaskParams
{
    /**
     * プロジェクトID
     *
     * @var string
     */
    public readonly string $project_id;

    /**
     * タスクID
     *
     * @var int
     */
    public readonly int $task_id;

    /**
     * 種別ID
     *
     * @var int
     */
    public readonly int $type_id;

    /**
     * 状態ID
     *
     * @var int
     */
    public readonly int $state_id;

    /**
     * 担当者ID
     *
     * @var string
     */
    public readonly string $manager_id;

    /**
     * 優先度ID
     *
     * @var int
     */
    public readonly int $priority_id;

    /**
     * バージョンID
     *
     * @var int|null
     */
    public readonly ?int $version_id;

    /**
     * 件名
     *
     * @var string
     */
    public readonly string $title;

    /**
     * 詳細
     *
     * @var string|null
     */
    public readonly ?string $body;

    /**
     * 開始日
     *
     * @var string|null
     */
    public readonly ?string $start_date;

    /**
     * 期限日
     *
     * @var string|null
     */
    public readonly ?string $end_date;

    public function __construct(
        string $project_id,
        int $task_id,
        int $type_id,
        int $state_id,
        string $manager_id,
        int $priority_id,
        ?int $version_id,
        string $title,
        ?string $body,
        ?string $start_date,
        ?string $end_date,
    ) {
        $this->project_id = $project_id;
        $this->task_id = $task_id;
        $this->type_id = $type_id;
        $this->state_id = $state_id;
        $this->manager_id = $manager_id;
        $this->priority_id = $priority_id;
        $this->version_id = $version_id;
        $this->title = $title;
        $this->body = $body;
        $this->start_date = $start_date ? Carbon::parse($start_date)->format('Y-m-d') : null;
        $this->end_date = $end_date ? Carbon::parse($end_date)->format('Y-m-d') : null;
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
            'task_id' => $this->task_id,
            'type_id' => $this->type_id,
            'state_id' => $this->state_id,
            'manager_id' => $this->manager_id,
            'priority_id' => $this->priority_id,
            'version_id' => $this->version_id,
            'title' => $this->title,
            'body' => $this->body,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ];
    }
}
