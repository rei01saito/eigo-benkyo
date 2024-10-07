<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TargetsType;

class TargetsTypeFactory extends Factory
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
            'contents' => $this->faker->realText,
            'accomplished' => 0
        ];
    }
}
