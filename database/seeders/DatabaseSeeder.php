<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\User;
use App\Models\Post;
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
        User::factory([
            'email' => 'email@example.com',
            'password' => 'qweasdzxc',
        ])->create();

        $users = User::factory()->count(10)->create();
        $users->each(function ($user){
            $posts = $user->posts()->saveMany(Post::factory()->count(10)->make());
            $posts->each(function ($post) use($user){
                $post->comments()->saveMany(Comment::factory(['author_id'=> $user->id])->count(10)->make());
            });
        });
    }
}


