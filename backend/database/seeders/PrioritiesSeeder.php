<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Priority;

class PrioritiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Priority::create([
            'priorities_id' => 0,
            'name' => '検討中',
        ]);

        Priority::create([
            'priorities_id' => 1,
            'name' => '実行中',
        ]);

        Priority::create([
            'priorities_id' => 2,
            'name' => '完了',
        ]);
    }
}
