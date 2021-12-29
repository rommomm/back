<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'author_id' => $this->faker->randomDigit() + 1,
            'post_id' => $this->faker->randomDigit() + 1,
            'comment' => $this->faker->realText(100)
        ];
    }
}
