<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;
    

    public function test_user_can_login()
    {
        $user = $this->createUser(['password' => 'password']);

        $data = [
            'login' => $user->email,
            'password' => 'password'
        ];
        $response = $this->postJson('api/login', $data)
        ->assertCreated()->json();
        $this->assertArrayHasKey('token',$response);
        
    }
}
