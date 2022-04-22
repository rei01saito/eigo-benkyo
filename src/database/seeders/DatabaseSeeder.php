<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Target;
use App\Models\TargetsType;

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
        Target::upsert([
            ['users_id' => $user->id, 'type' => 0],
            ['users_id' => $user->id, 'type' => 1],
            ['users_id' => $user->id, 'type' => 1],
            ['users_id' => $user->id, 'type' => 1],
            ['users_id' => $user->id, 'type' => 1],
        ], ['targets_id']);
        
        $targets = Target::where('users_id', $user->id)
            ->where('type', 1)->get();
        $array = [
            '今日の目標',
            '今週の目標',
            '今月の目標',
            '今年の目標'
        ];
        $i = 0;
        foreach ($targets as $t) {
            TargetsType::create([
                'targets_id' => $t->targets_id,
                'title' => $array[$i]
            ]);
            $i++;
        }
        $this->call(GuestSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(PrioritiesSeeder::class);
    }
}
