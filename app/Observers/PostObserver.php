<?php

namespace App\Observers;

use App\Models\Post;

class PostObserver
{
    public function created(Post $post)
    {
        $post->parsed();
    }

    public function updated(Post $post)
    {
        $post->parsed();
    }

    public function deleted(Post $post)
    {
        $post->mentioned()->detach();
    }
}
