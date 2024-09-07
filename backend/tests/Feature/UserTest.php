<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    private $user_id;

    public function setUp(): void
    {
        parent::setUp();
        $user = User::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $this->user_id = $user->id;
        $this->assertAuthenticated();
    }

    public function test_request_to_index()
    {
        $response = $this->get('/mypage');
        $response->assertOK();
    }

    public function test_request_to_edit()
    {
        $response = $this->get('/mypage/edit');
        $response->assertOK();
    }

    public function test_request_to_update()
    {
        $response = $this->post('/mypage/update', [
            'user_name' => 'testman',
            'email' => 'testman@email.com',
            'password' => 'passwordchange'
        ]);
        $response->assertRedirect('/mypage');
        $this->assertDatabaseHas('users',[
            'name' => 'testman',
            'email' => 'testman@email.com'
        ]);
    }

    public function test_validate_to_update()
    {
        $response = $this->post('/mypage/update', [
            'user_name' => 'emptyman',
            'email' => '',
            'password' => ''
        ]);
        
        $this->assertDatabaseMissing('users', [
            'name' => 'emptyman',
            'email' => '',
        ]);
    }
}
