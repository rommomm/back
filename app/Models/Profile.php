<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Profile extends Model
{
  protected static function booted()
    {
        static::created(function ($profile) {
            $profile->update(['profile_photo' => ('http://localhost:8000/uploads/roba/images/avatar/avatar.png'), 
            'profile_background' => ('http://localhost:8000/uploads/roba/images/avatar/avatar.png')]);
        });
    }

    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'profile_photo',
        'profile_background',
        'user_location',
    ];

    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
