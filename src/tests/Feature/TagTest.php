<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Tag;
use App\Models\User;
use Tests\TestCase;

class TagTest extends TestCase
{
    use RefreshDatabase;
    private $user;

    public function setUp(): void
    {
        parent::setUp();
        $user = User::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $this->assertAuthenticated();
        $this->user = $user;
    }

    public function test_request_to_tagStore()
    {
        $array = [
            'tag' => [
                'PHP TEST',
                'RUBY TEST',
                'PYTHON TEST',
            ]
        ];
        $response = $this->post('/mypage/tag/store', $array);
        $response->assertRedirect('/mypage');
        $tags = Tag::where('user_id', $this->user->id)->get();
        foreach ($tags as $t) {
            $this->assertDatabaseHas('tags', [
                'tags_name' => $t->tags_name
            ]);
        }
    }

    public function test_validate_to_count_tagStore()
    {
        $tags = [];
        for ($i = 0; $i < 11; $i++) {
            array_push($tags, 'tagTest_'.$i);
        }
        $response = $this->post('/mypage/tag/store', [
            'tag' => $tags
        ]);
        $response->assertRedirect('/mypage');
        $this->assertDatabaseCount('tags', 0);
    }

    public function test_validate_to_tagStore()
    {
        $array = [
            'tag' => [
                '',
                '0123456789' * 3 . '0',
                '',
            ]
        ];
        $response = $this->post('/mypage/tag/store', $array);
        $response->assertRedirect('/mypage');
        $this->assertDatabaseCount('tags', 0);
    }

    public function test_request_to_tagDelete()
    {
        Tag::factory()->create([
            'user_id' => $this->user->id
        ]);
        $this->assertDatabaseCount('tags', 1);
        $response = $this->get('/mypage/tag/delete');
        $response->assertRedirect('/mypage');
        $this->assertDatabaseCount('tags', 0);
    }
}
