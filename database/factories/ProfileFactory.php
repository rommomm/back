<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
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
            'profile_photo' => URL::current().':8000/default/avatar.png',
            'profile_background' => URL::current().':8000/default/background.png',
            'user_location' => $this->faker->streetAddress(),
        ];
    }

}
