<?php

namespace Database\Seeders;

use App\Models\Project;
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
        User::all()->each(function (User $user) {
            Project::all()->each(function (Project $project) use ($user) {
                if ($project->company_id === $user->company_id) {
                    $company = $user->company;
                    for ($i = 0; $i < 100; $i++) {
                        Task::factory()->create([
                            'project_id' => $project->id,
                            'user_id' => $user->id,
                            'company_id' => $user->company_id,
                            'manager_id' => $company->users->random()->id,
                            'state_id' => $project->states->random()->id,
                            'type_id' => $project->types->random()->id,
                            'priority_id' => $project->priorities->random()->id,
                        ]);
                    }
                }
            });
        });
    }
}
