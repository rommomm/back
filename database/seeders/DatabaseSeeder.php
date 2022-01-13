<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\User;
use App\Models\Post;
use App\Models\Profile;
use Database\Factories\ProfileFactory;
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
        User::factory(1)->has(Profile::factory()->count(1))->has(
            Post::factory()->count(10)
                ->has(Comment::factory()->count(10))
        )->create();
    }
}
