<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;
    private $post;

    public function setUp(): void
    {
        parent::setUp();
        $user = $this->authUser();
        $post = $this->post = $this->createPost([
            'content' => 'my first post',
            'author_id' => $user->id,
        ]);
        $this->comment = $this->createComment([
            'content' => 'my first comment',
            'author_id' => $user->id,
            'post_id' => $post->id
        ]);
    }


    public function test_comments_by_post()
    {
        $response = $this->getJson("/api/posts/{$this->post->id}/comments")
            ->assertOk()
            ->json('data');
        $this->assertEquals($response[0]['content'], $this->comment->content);
    }

    public function test_comment_create()
    {
        $data = [
            'content' => $this->faker->text,
        ];

        $this->postJson("/api/posts/{$this->post->id}/comments", $data)
            ->assertCreated();
    }

    public function test_comment_delete()
    {
        $this->deleteJson("/api/comments/{$this->comment->id}")
            ->assertNoContent();

        $this->assertDatabaseMissing('comments', ['content' => $this->comment->content]);
    }

    public function test_comment_update()
    {
        $this->putJson("/api/comments/{$this->comment->id}", ['content' => 'updated content'])
            ->assertOk();

        $this->assertDatabaseHas('comments', ['id' => $this->comment->id, 'content' => 'updated content']);
    }
}
