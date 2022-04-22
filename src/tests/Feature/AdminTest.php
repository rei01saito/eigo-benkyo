<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\User;
use Tests\TestCase;


class AdminTest extends TestCase
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
    }
    
    public function test_unable_to_request_index()
    {
        $response = $this->get('/dashboard');
        $response->assertForbidden();
    }

}
