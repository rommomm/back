<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\User;
use App\Models\Post;
use App\Models\Profile;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory()->has(Profile::factory())->count(2)->create();
        $users->each(function ($user){
            $posts = $user->posts()->saveMany(Post::factory()->count(2)->make());
            $posts->each(function ($post) use($user){
                $post->comments()->saveMany(Comment::factory(['author_id'=> $user->id])->count(2)->make());
            });
        });
    }
}
