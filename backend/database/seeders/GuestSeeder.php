<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Target;
use App\Models\TargetsType;

class GuestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'guest',
            'email' => 'guest@email.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password1234'),
            'role' => 1
        ]);
        
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
    }
}
