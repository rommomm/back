<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

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
            'profile_photo' => URL::asset('/uploads/roba/images/avatar/avatar.png'),
            'profile_background' => URL::asset('/uploads/roba/images/avatar/avatar.png'),
            'user_location' => $this->faker->streetAddress(),
        ];
    }

}
