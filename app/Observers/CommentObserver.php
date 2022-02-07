<?php

namespace App\Observers;

use App\Models\Comment;

class CommentObserver
{
    public function created(Comment $comment)
    {
        $comment->parseMentions();
    }

    public function updated(Comment $comment)
    {
        $comment->parseMentions();
    }

    public function deleted(Comment $comment)
    {
        $comment->mentionedUsers()->detach();
    }
}
