<?php

namespace App\Observers;

use App\Models\Post;

class PostObserver
{
    public function created(Post $post)
    {
        $post->parseMentions();
    }

    public function updated(Post $post)
    {
        $post->parseMentions();
    }

    public function deleted(Post $post)
    {
        $post->mentionedUsers()->detach();
    }
}
