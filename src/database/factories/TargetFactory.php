<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Target;

class TargetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users_id = 0;

        return [
            'users_id' => $users_id,
            'type' => 0
        ];
    }
}
