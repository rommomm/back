<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'profile_avatar' => 'default/' . $this->faker->
            image('storage/app/public/default', 600, 400, 'AVATAR', false),
            'profile_background' => 'default/' . $this->faker->
            image('storage/app/public/default', 600, 400, 'AVATAR', false),
            'user_location' => $this->faker->streetAddress(),
        ];
    }

}
