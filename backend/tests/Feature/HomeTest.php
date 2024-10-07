<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Task;
use App\Models\Priority;
use App\Models\Target;
use App\Models\User;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use RefreshDatabase;
    private $tasks_id;

    public function setUp(): void
    {
        parent::setUp();

        // User作成と認証
        $user = User::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();
        
        // Target作成
        $targets_id = Target::factory()->create([
            'users_id' => $user->id
        ]);
        Target::factory(4)->create([
            'users_id' => $user->id,
            'type' => 1
        ]);

        // Priority作成
        Priority::upsert([
            ['priorities_id' => 0, 'name' => '検討中'],
            ['priorities_id' => 1, 'name' => '実行中'],
            ['priorities_id' => 2, 'name' => '完了'],
        ], ['priorities_id']);

        // Task作成
        $task = Task::factory()->create([
            'targets_id' => $targets_id
        ]);
        $this->tasks_id = $task->id;
    }

    public function test_request_to_index()
    {
        $response = $this->get('/home');
        $response->assertOk();
    }

    public function test_request_to_setTimer()
    {
        $response = $this->get('/home'.'/'.$this->tasks_id);
        $response->assertOk();
        $response->assertJson([
            'tasks_id' => $this->tasks_id
        ]);
    }

    public function test_request_to_incrementNExec()
    {
        $task = Task::where('tasks_id', $this->tasks_id)->first();
        $response = $this->get('/home/incrementNExec/'.$this->tasks_id);
        $response->assertRedirect('/home');
        $task_updated = Task::where('tasks_id', $this->tasks_id)->first();
    
        $this->assertEquals($task->n_exec + 1, $task_updated->n_exec);
    }
}
