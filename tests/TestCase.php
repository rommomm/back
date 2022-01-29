<?php

namespace Tests;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Sanctum\Sanctum;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
    }

    public function createPost($args = [])
    {
        return Post::factory()->create($args);
    }

    public function createComment($args = [])
    {
        return Comment::factory()->create($args);
    }

    public function createUser($args = [])
    {
        return User::factory()->create($args);
    }

    public function createProfile($args = [])
    {
        return Profile::factory()->create($args);
    }

    public function authUser()
    {
        $user = $this->createUser();
        Sanctum::actingAs($user);
        return $user;
    }

}
