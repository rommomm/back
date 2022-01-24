<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function update(User $author, Comment $comment)
    {
        return $author->id === $comment->author_id;
    }

    public function delete(User $author, Comment $comment)
    {
        return $author->id === $comment->author_id;
    }
}
