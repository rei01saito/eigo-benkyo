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
        $targets_id = 0;
        return [
            'targets_id' => $targets_id,
            'title' => $this->faker->word,
            'contents' => 'adgha',
            'timer' => rand(1, 300),
            'priority' => rand(0, 2),
        ];
    }
}
