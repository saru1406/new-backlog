<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::all()->each(function (Project $project) {
            $projectUsers = ProjectUser::where('project_id', $project->id)->get();
            $projectUsers->each(function ($projectUser) use ($project) {
                for ($i = 0; $i < 100; $i++) {
                    Task::factory()->create([
                        'project_id' => $project->id,
                        'user_id' => $projectUser->user_id,
                        'company_id' => $project->company_id,
                        'manager_id' => $projectUser->user_id,
                        'state_id' => $project->states->random()->id,
                        'type_id' => $project->types->random()->id,
                        'priority_id' => $project->priorities->random()->id,
                    ]);
                }
            });
        });
    }
}
