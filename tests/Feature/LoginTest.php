<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    // public function test_a_user_can_login_with_email_and_password()
    // {
    //     $user = $this->createUser();

    //     $data = [
    //         'login' => $user->email,
    //         'password' => 'password'
    //     ];

    //     $response = $this->postJson('api/login', $data)
    //     ->assertOk();

    //     $this->assertArrayHasKey('token',$response->json());
    // }

    // public function test_if_user_email_is_not_available_then_it_return_error()
    // {
    //     $data = [
    //         'login' => 'Sarthak@bitfumes.com',
    //         'password' => 'password'
    //     ];

    //     $this->postJson('api/login', $data)
    //     ->assertUnauthorized();
    // }

    // public function test_it_raise_error_if_password_is_incorrect()
    // {
    //     $user = $this->createUser();

    //     $data = [
    //         'login' => $user->email,
    //         'password' => 'random'
    //     ];

    //     $this->postJson('api/login', $data)
    //     ->assertUnauthorized();
    // }
}
