<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Target;
use App\Models\TargetsType;
use App\Models\User;
use Tests\TestCase;

class TargetTest extends TestCase
{
    use RefreshDatabase;
    private $user_id;

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
        $this->user_id = $user->id;
        
        // Target作成
        Target::factory()->create([
            'users_id' => $user->id
        ]);
        for ($i = 0; $i < 4; $i++) {
            $target = Target::factory()->create([
                'users_id' => $user->id,
                'type' => 1
            ]);
            TargetsType::factory()->create([
                'targets_id' => $target->id
            ]);
        }
        $this->assertDatabaseCount('targets', 5);
        $this->assertDatabaseCount('targets_types', 4);
    }

    public function test_request_to_index()
    {
        $response = $this->get('/targets');
        $response->assertOk();
    }

    public function test_request_to_edit()
    {
        $type = Target::where('users_id', $this->user_id)
            ->where('type', 1)->first()
            ->types()->first();
        $response = $this->get('/targets'.'/'.$type->id);
        $response->assertOk();
    }

    public function test_requset_to_update()
    {
        $target = Target::where('users_id', $this->user_id)
            ->where('type', 1)->first();
        $response = $this->post('/targets'.'/'.$target->targets_id, [
            'title' => 'This is updated',
            'contents' => 'This is updated'
        ]);
        $response->assertRedirect('/targets');
        $this->assertDatabaseHas('targets_types', [
            'title' => 'This is updated',
            'contents' => 'This is updated'
        ]);
    }

    public function test_validate_to_update()
    {
        $target = Target::where('users_id', $this->user_id)
            ->where('type', 1)->first();
        $response = $this->post('/targets'.'/'.$target->targets_id, [
            'title' => '',
            'contents' => '1234567890' * 300 . '1'
        ]);
        $response->assertRedirect('/targets'.'/'.$target->targets_id);
        $this->assertDatabaseMissing('targets_types', [
            'title' => 'This is updated',
            'contents' => 'This is updated'
        ]);
    }

    public function test_request_to_create()
    {
        $response = $this->get('/targets/create');
        $response->assertOk();
    }

    public function test_request_to_store()
    {
        $response = $this->post('/targets/store', [
            'title' => 'This is new title.',
            'contents' => 'This is new contents.'
        ]);
        $response->assertRedirect('/targets');
        $this->assertDatabaseHas('targets_types', [
            'title' => 'This is new title.',
            'contents' => 'This is new contents.'
        ]);
        $this->assertDatabaseCount('targets_types', 5);
        $this->assertDatabaseCount('targets', 6);
    }
    
    public function test_validate_to_store()
    {
        $response = $this->post('/targets/store', [
            'title' => '',
            'contents' => '1234567890' * 300 . '1'
        ]);
        $response->assertRedirect('/targets/create');
        $this->assertDatabaseMissing('targets_types', [
            'title' => 'This is new title.',
            'contents' => 'This is new contents.'
        ]);
        $this->assertDatabaseCount('targets_types', 4);
        $this->assertDatabaseCount('targets', 5);
    }

    public function test_request_to_accomplish()
    {
        $target = Target::where('users_id', $this->user_id)
            ->where('type', 1)->first();
        $response = $this->get('/targets/accomplish/'.$target->targets_id);
        $response->assertRedirect('/targets');
        $this->assertSoftDeleted('targets', [
            'targets_id' => $target->targets_id
        ]);
    }

    public function test_request_to_destroy()
    {
        $target = Target::where('users_id', $this->user_id)
            ->where('type', 1)->first();
        Target::where('targets_id', $target->targets_id)->delete();
            
        $response = $this->get('/targets/accomplish/destroy/'.$target->targets_id);
        $response->assertRedirect('/targets');
        $this->assertDatabaseMissing('targets', [
            'targets_id' => $target->targets_id
        ]);
    }
}
