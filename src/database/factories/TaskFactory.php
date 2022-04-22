<?php

namespace Database\Factories;

use App\Models\Task;

use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'contents' => $this->faker->realText,
            'timer' => rand(1, 300),
            'priority' => rand(0, 2),
        ];
    }
}
