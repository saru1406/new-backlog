<?php

namespace Database\Seeders;

use App\Enums\Type\TypeEnum;
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
        $typeNames = TypeEnum::toArray();
        $projects = Project::all();
        $projects->each(function ($project) use ($typeNames) {
            foreach ($typeNames as $typeName) {
                Type::create([
                    'project_id' => $project->id,
                    'type_name' => $typeName,
                ]);
            }
        });
    }
}
