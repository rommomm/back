<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $user =  $this->user = $this->authUser();
        $profile = $this->profile = $this->createProfile([
            'user_id' => $user->id
        ]);
    }

    public function test_user_can_edit_first_name()
    {
        $this->putJson("/api/profile/update", ['first_name' => 'My first_name'])
        ->assertOk();
        $this->assertDatabaseHas('profiles', ['user_id' => $this->user->id, 'first_name' => 'My first_name']);
    }

    public function test_user_can_edit_last_name()
    {
        $this->putJson("/api/profile/update", ['last_name' => 'My last_name'])
        ->assertOk();
        $this->assertDatabaseHas('profiles', ['user_id' => $this->user->id, 'last_name' => 'My last_name']);
    }

    public function test_user_can_edit_location()
    {
        $this->putJson("/api/profile/update", ['user_location' => 'My location'])
        ->assertOk();
        $this->assertDatabaseHas('profiles', ['user_id' => $this->user->id, 'user_location' => 'My location']);
    }

    public function test_user_can_upload_avatar()
    {
        Storage::fake('local');
        $response = $this->postJson("/api/profile/avatar", [
            'profile_avatar' =>
            UploadedFile::fake()->create('avatar.png', 250)
        ]);
        $response->assertSuccessful();
    }

    public function test_user_can_remove_avatar()
    {
        $this->deleteJson("/api/profile/avatar")->assertStatus(200)->json('data');
        $this->assertDatabaseHas('profiles', ['user_id' => $this->user->id, 'profile_avatar' => null]);
    }

    public function test_user_can_upload_background()
    {
        Storage::fake('local');
        $response = $this->postJson("/api/profile/background", [
            'profile_background' =>
            UploadedFile::fake()->create('background.png', 250)
        ]);
        $response->assertSuccessful();
    }

    public function test_user_can_remove_background()
    {
        $this->deleteJson("/api/profile/background")->assertStatus(200)->json('data');
        $this->assertDatabaseHas('profiles', ['user_id' => $this->user->id, 'profile_background' => null]);
    }

}
