<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use App\Models\User;
use App\Models\Post;
use Tests\TestCase;

class UserTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    private $list;

    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function setUp(): void
    {
        parent::setUp();
        $user = $this->authUser();
    }

    public function test_fetch_all_posts()
    {
        $this->json('get', 'api/posts')
        ->assertStatus(200);
    }

    public function testSuccessfulRegistration()
    {
        $userData = [
            "first_name" => $this->faker->firstName,
            "last_name" => $this->faker->lastName,
            "user_name" => $this->faker->userName,
            "email" => $this->faker->email,
            "password" => 'qweasdzxc',
            "password_confirmation" => 'qweasdzxc'
        ];

        $response = $this->json('POST', 'api/register', $userData)
            ->assertStatus(201);
    }

    public function testSuccessfulLogin()
    {
        $data = [
            'content' => 'contentcontentcontentcontent',
        ];

        $this->json('POST', 'api/posts', $data)
            ->assertStatus(201);
    }


}
