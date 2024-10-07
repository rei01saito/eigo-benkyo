<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['roles_id' => 0, 'roles_name' => 'general'],
            ['roles_id' => 1, 'roles_name' => 'guest'],
            ['roles_id' => 2, 'roles_name' => 'admin'],
        ];
        Role::upsert($data, 'roles_id');
    }
}
