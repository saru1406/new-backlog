<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $type_names = ['タスク', '課題', 'TODO'];
        $projects = Project::all();
        $projects->each(function ($project) use ($type_names) {
            foreach ($type_names as $type_name) {
                Type::create([
                    'project_id' => $project->id,
                    'type_name' => $type_name,
                ]);
            }
        });
    }
}
