<?php

namespace Database\Seeders;

use App\Enums\State\StateEnum;
use App\Enums\Type\TypeEnum;
use App\Models\Priority;
use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\State;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::all()->each(function (Project $project) {
            $users = User::where('company_id', $project->company_id)->inRandomOrder()->take(10)->get();
            $users->each(function($user) use($project) {
                ProjectUser::create([
                    'project_id' => $project->id,
                    'user_id' => $user->id,
                ]);
            });
        });
    }
}
