<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TasksStatuses;


class TasksStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TasksStatuses::create([
            'tasks_statuses_id' => 0,
            'status' => '検討中',
        ]);

        TasksStatuses::create([
            'tasks_statuses_id' => 1,
            'status' => '実行中',
        ]);

        TasksStatuses::create([
            'tasks_statuses_id' => 2,
            'status' => '完了',
        ]);
    }
}
