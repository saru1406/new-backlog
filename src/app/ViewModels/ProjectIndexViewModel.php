<?php

declare(strict_types=1);

namespace App\ViewModels;

use App\Models\Project;
use Illuminate\Support\Collection;

class ProjectIndexViewModel
{
    private Collection $project;

    public function __construct(Collection $project)
    {
        $this->project = $project;
    }

    /**
     * プロジェクトIndexに渡す値を設定
     *
     * @return Collection
     */
    public function render(): Collection
    {
        return $this->project->map(function (Project $project) {
            return [
                'id' => $project->id,
                'project_name' => $project->project_name,
                'created_at' => $project->created_at->format('Y-m-d H:i'),
            ];
        });
    }
}
