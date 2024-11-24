<?php

namespace Database\Seeders;

use App\Enums\State\StateEnum;
use App\Enums\Type\TypeEnum;
use App\Models\Priority;
use App\Models\Project;
use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stateNames = StateEnum::toArray();
        $projects = Project::all();
        $projects->each(function ($project) use ($stateNames) {
            foreach ($stateNames as $stateName) {
                State::create([
                    'project_id' => $project->id,
                    'state_name' => $stateName,
                ]);
            }
        });
    }
}
