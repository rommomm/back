<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Profile extends Model
{

    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'user_location',
        'profile_avatar',
        'profile_background',
        'user_location',
    ];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function uploadAvatar($image)
    {
      
      Storage::disk('public')->delete($this->profile_avatar);
      return $this->update(['profile_avatar' => $image->store("{$this->user->user_name}/avatar", 'public')]);
    }

    public function uploadBackground($image)
    {
      Storage::disk('public')->delete($this->profile_background);
      return $this->update(['profile_background' => $image->store("{$this->user->user_name}/background", 'public')]);
    }

    public function removeAvatar()
    {
      Storage::deleteDirectory("/public/{$this->user->user_name}/avatar");
      return $this->update(['profile_avatar' => null]);
    }

    public function removeBackground()
    {
      Storage::deleteDirectory("/public/{$this->user->user_name}/background");
      return $this->update(['profile_background' => null]);
    }

}
