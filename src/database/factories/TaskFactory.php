<?php

namespace Database\Factories;

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
            'type_id' => $this->faker->randomNumber(1,100),
            'state_id' => $this->faker->randomNumber(1,100),
            'priority_id' => $this->faker->randomNumber(1,100),
            'version_id' => $this->faker->randomNumber(1,100),
            'title' => $this->faker->realText(20),
            'body' => $this->faker->text(),
            'start_date' => $this->faker->date(max: '2025-12-31'),
            'end_date' => $this->faker->date(max: '2025-12-31')
        ];
    }
}
