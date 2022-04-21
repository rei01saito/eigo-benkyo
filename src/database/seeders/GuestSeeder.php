<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Target;

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
            'name' => config('guestInfo.name'),
            'email' => config('guestInfo.email'),
            'password' => Hash::make(config('guestInfo.password')),
            'role' => 1
        ]);
        Target::create([
            'users_id' => $user->id
        ]);
    }
}
