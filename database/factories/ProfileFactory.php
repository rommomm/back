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
            'profile_photo' => Storage::url('default/avatar.png'),
            'profile_background' => Storage::url('default/background.png'),
            'user_location' => $this->faker->streetAddress(),
        ];
    }

}
