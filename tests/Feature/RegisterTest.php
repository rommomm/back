<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_register()
    {
        $data = [
            "first_name" => 'Bublic',
            "last_name" => 'Bublic',
            "user_name" => 'Bublic',
            "email" => 'bublic@a.a',
            "password" => 'qweasdzxc',
            "password_confirmation" => 'qweasdzxc'
        ];

        $this->postJson('api/register', $data)
            ->assertCreated();
        $this->assertDatabaseHas('users',['user_name' => 'Bublic']);
    }
}
