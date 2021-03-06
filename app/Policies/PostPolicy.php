<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function update(User $author, Post $post)
    {
        return $author->id === $post->author_id;
    }

    public function delete(User $author, Post $post)
    {
        return $author->id === $post->author_id;
    }
}
