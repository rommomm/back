<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $user = $this->authUser();
    }

    public function test_user_can_get_me_info()
    {
        $this->getJson("/api/auth/me")
        ->assertOk();
    }
}
