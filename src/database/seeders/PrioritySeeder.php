<?php

namespace Database\Seeders;

use App\Enums\Priority\PriorityEnum;
use App\Models\Priority;
use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $priorityNames = PriorityEnum::toArray();
        $projects = Project::all();
        $projects->each(function ($project) use ($priorityNames) {
            foreach ($priorityNames as $priorityName) {
                Priority::create([
                    'project_id' => $project->id,
                    'priority_name' => $priorityName,
                ]);
            }
        });
    }
}
