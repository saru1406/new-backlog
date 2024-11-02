<?php

namespace Database\Seeders;

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
        $priority_names = ['高', '中', '低'];
        $projects = Project::all();
        $projects->each(function ($project) use ($priority_names) {
            foreach ($priority_names as $priority_name) {
                Priority::create([
                    'project_id' => $project->id,
                    'priority_name' => $priority_name,
                ]);
            }
        });
    }
}
