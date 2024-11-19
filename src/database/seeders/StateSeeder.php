<?php

namespace Database\Seeders;

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
        $state_names = ['未対応', '処理中', '処理済み'];
        $projects = Project::all();
        $projects->each(function ($project) use ($state_names) {
            foreach ($state_names as $state_name) {
                State::create([
                    'project_id' => $project->id,
                    'state_name' => $state_name,
                ]);
            }
        });
    }
}
