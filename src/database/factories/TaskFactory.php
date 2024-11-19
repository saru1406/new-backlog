<?php

namespace Database\Factories;

use App\Models\Priority;
use App\Models\State;
use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->realText(20),
            'body' => $this->faker->text(),
            'start_date' => $this->faker->date(max: '2025-12-31'),
            'end_date' => $this->faker->date(max: '2025-12-31')
        ];
    }
}
