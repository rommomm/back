<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    use HasFactory;
    protected $fillable = [
        'profile_photo',
        'profile_background',
        'user_location',
    ];

    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
