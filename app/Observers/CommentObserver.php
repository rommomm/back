<?php

namespace App\Observers;

use App\Models\Comment;

class CommentObserver
{
    public function created(Comment $comment)
    {
        $comment->parsed();
    }

    public function updated(Comment $comment)
    {
        $comment->parsed();
    }

    public function deleted(Comment $comment)
    {
        $comment->mentioned()->detach();
    }
}
