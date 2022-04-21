<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Target;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create();
        Target::create([
            'users_id' => $user->id
        ]);
        $this->call(GuestSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(PrioritiesSeeder::class);
    }
}
