<?php

declare(strict_types=1);

namespace App\ViewModels\Project;

use App\Models\Priority;
use App\Models\Project;
use App\Models\State;
use App\Models\Type;
use App\Models\User;
use Illuminate\Support\Collection;

class SettingProjectViewModel
{
    /**
     * プロジェクト
     *
     * @var array
     */
    public readonly array $project;

    /**
     * ステータス
     *
     * @var Collection
     */
    public readonly Collection $states;

    /**
     * 種別
     *
     * @var Collection
     */
    public readonly Collection $types;

    /**
     * 優先度
     *
     * @var Collection
     */
    public readonly Collection $priorities;

    /**
     * 企業のユーザ
     *
     * @var Collection
     */
    public readonly Collection $companyUsers;

    /**
     * ユーザ
     *
     * @var Collection
     */
    public readonly Collection $users;

    public function __construct(Collection $data)
    {
        $this->project = $this->formatProject($data['project']);
        $this->states = $this->formatState($data['states']);
        $this->types = $this->formatType($data['types']);
        $this->priorities = $this->formatPriority($data['priorities']);
        $this->users = $this->formatUser($data['project']->users);
        $this->companyUsers = $this->formatUser($data['company_user']);
    }

    /**
     * プロジェクトデータをフォーマット
     *
     * @param \App\Models\Project $project
     * @return array
     */
    private function formatProject(Project $project): array
    {
        return [
            'id' => $project->id,
            'project_name' => $project->project_name,
        ];
    }

    /**
     * ステータスデータをフォーマット
     *
     * @param \Illuminate\Support\Collection $states
     * @return \Illuminate\Support\Collection
     */
    private function formatState(Collection $states): Collection
    {
        return $states->map(function (State $state): array {
            return [
                'id' => $state->id,
                'state_name' => $state->state_name,
            ];
        });
    }

    /**
     * 種別データをフォーマット
     *
     * @param \Illuminate\Support\Collection $types
     * @return \Illuminate\Support\Collection
     */
    private function formatType(Collection $types): Collection
    {
        return $types->map(function (Type $type): array {
            return [
                'id' => $type->id,
                'type_name' => $type->type_name,
            ];
        });
    }

    /**
     * 優先度データをフォーマット
     *
     * @param \Illuminate\Support\Collection $priorities
     * @return \Illuminate\Support\Collection
     */
    private function formatPriority(Collection $priorities): Collection
    {
        return $priorities->map(function (Priority $priority): array {
            return [
                'id' => $priority->id,
                'priority_name' => $priority->priority_name,
            ];
        });
    }

    /**
     * ユーザデータをフォーマット
     *
     * @param \Illuminate\Support\Collection $users
     * @return \Illuminate\Support\Collection
     */
    private function formatUser(Collection $users): Collection
    {
        return $users->map(function (User $user): array {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email
            ];
        });
    }
}
