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
        $this->post = $this->createPost([
            'content' => 'my list',
            'author_id' => $user->id
        ]);
    }

    public function test_get_all_posts()
    {
        $this->createPost();
        $response = $this->getJson('api/posts')->json('data');

        $this->assertEquals(1, count($response));
        $this->assertEquals('my list', $response[0]['content']);
    }

    public function test_get_single_post()
    {
        $response = $this->getJson(`api/posts` , $this->post->id)
            ->assertOk()
            ->json('data');

        $this->assertEquals($response['content'], $this->post->content);
    }

    public function test_create_post()
    {
        $data = [
            'content' => $this->faker->text,
        ];

        $this->postJson('api/posts', $data)
            ->assertCreated();
    }

    public function test_delete_post()
    {
        $this->deleteJson(`api/posts` , $this->post->id)
            ->assertNoContent();

        $this->assertDatabaseMissing('posts', ['content' => $this->post->content]);
    }

    public function test_update_post()
    {
        $this->patchJson('api/posts', $this->post->id, ['content' => 'updated content'])
            ->assertOk();

        $this->assertDatabaseHas('posts', ['id' => $this->post->id, 'content' => 'updated content']);
    }
}
