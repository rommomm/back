<?php

namespace App\Models;

use App\Http\Traits\HasMentions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory, HasMentions;

    protected $fillable = ['content'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    public function author()
    {
        return $this->belongsTo(User::class);
    }
}
