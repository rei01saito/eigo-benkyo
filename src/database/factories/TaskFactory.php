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
        $titles = ['PHP', 'Ruby', 'Laravel', 'Rails', 'ITパスポート', '基本情報技術者', 'Lpic'];
        $contents = ['コーディング', '暗記', '修正', '設計', '構築', 'テスト', '問題演習', '解答'];
        $priorities = [0, 1, 2];
        $user_id = 13;

        $title = $titles[rand(0, count($titles) - 1)];
        $content = $contents[rand(0, count($contents) - 1)];
        $priority = $priorities[rand(0, count($priorities) - 1)];

        return [
            'title' => $title,
            'contents' => $content,
            'priority' => $priority,
            'user_id' => $user_id
        ];
    }
}
