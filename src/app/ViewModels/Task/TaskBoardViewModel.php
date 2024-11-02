<?php

declare(strict_types=1);

namespace App\ViewModels\Task;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Collection;

class TaskBoardViewModel
{
    public readonly array $project;

    public readonly Collection $tasks;

    public function __construct(Collection $data)
    {
        $this->project = $this->formatProject($data['project']);
        $this->tasks = $this->formatTasks($data['tasks']);
    }

    private function formatProject(Project $project): array
    {
        return [
            'id' => $project->id,
            'project_name' => $project->project_name,
        ];
    }

    private function formatTasks(Collection $tasks): Collection
    {
        return $tasks->map(function (Task $task): array {
            return [
                'id' => $task->id,
                'user' => [
                    'name' => $task->user->name,
                ],
                'type_id' => $task->type_id,
                'state_id' => $task->state_id,
                'manager' => [
                    'name' => $task->manager?->name,
                ],
                'priority_id' => $task->priority_id,
                'version_id' => $task->version_id,
                'title' => $task->title,
                'body' => $task->body,
                'start_date' => $task?->start_date,
                'end_date' => $task?->end_date,
                'created_at' => $task->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $task->updated_at->format('Y-m-d H:i:s'),
            ];
        });
    }
}
