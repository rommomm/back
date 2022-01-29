<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;
    private $post;

    public function setUp(): void
    {
        parent::setUp();
        $user = $this->authUser();
        $this->profile = $this->createProfile([
            'user_id' => $user->id
        ]);
        $this->post = $this->createPost([
            'content' => 'my first post my first post',
            'author_id' => $user->id
        ]);
    }

    public function test_posts_all()
    {
        $this->getJson('api/posts')->assertStatus(200);
    }

    public function test_post_single()
    {
        $response = $this->getJson("/api/posts/{$this->post->id}")
            ->assertOk()
            ->json('data');
        $this->assertEquals($response['content'], $this->post->content);
    }

    public function test_post_create()
    {
        $data = [
            'content' => $this->faker->text,
        ];

        $this->postJson('api/posts', $data)
            ->assertCreated();
    }

    public function test_post_delete()
    {
        $this->deleteJson("/api/posts/{$this->post->id}")
            ->assertNoContent();

        $this->assertDatabaseMissing('posts', ['content' => $this->post->content]);
    }

    public function test_post_update()
    {
        $this->putJson("/api/posts/{$this->post->id}", ['content' => 'updated content'])
            ->assertOk();

        $this->assertDatabaseHas('posts', ['id' => $this->post->id, 'content' => 'updated content']);
    }
}
